<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\FilterGroup;
use App\Models\Image;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    public function getAll(array $filters = [])
    {
        return $this->productRepository->getAll($filters);
    }

    public function getById(int $id)
    {
        return $this->productRepository->getById($id);
    }

    public function getFormData(): array
    {
        $categories = Category::with('children')->whereNull('parent_id')->orderBy('name')->get();
        $filterGroups = FilterGroup::with('values')->orderBy('name')->get();
        return compact('categories', 'filterGroups');
    }

    public function store(array $data, array $files): Product
    {
        return DB::transaction(function () use ($data, $files) {
            $product = $this->productRepository->create([
                'name'        => $data['name'],
                'slug'        => '', // temp, akan diupdate setelah dapat ID
                'description' => $data['description'] ?? null,
                'price'       => $this->parsePrice($data['price']),
                'active'      => isset($data['active']) ? (bool) $data['active'] : false,
            ]);

            // Gen slug = name-id
            $slug = Str::slug($data['name']) . '-' . $product->id;
            $product->update(['slug' => $slug]);

            // Sync categories (auto add parents)
            $categoryIds = $this->resolveCategoryIds($data['categories'] ?? []);
            $product->categories()->sync($categoryIds);

            // Sync filter values (1 per group)
            $filterValueIds = array_values(array_filter($data['filter_values'] ?? []));
            $product->filterValues()->sync($filterValueIds);

            // Handle images
            if (!empty($files['images'])) {
                $this->saveImages($product, $files['images']);
            }

            return $product;
        });
    }

    public function update(int $id, array $data, array $files): Product
    {
        return DB::transaction(function () use ($id, $data, $files) {
            $product = $this->productRepository->update($id, [
                'name'        => $data['name'],
                'slug'        => Str::slug($data['name']) . '-' . $id,
                'description' => $data['description'] ?? null,
                'price'       => $this->parsePrice($data['price']),
                'active'      => isset($data['active']) ? (bool) $data['active'] : false,
            ]);

            $categoryIds = $this->resolveCategoryIds($data['categories'] ?? []);
            $product->categories()->sync($categoryIds);

            $filterValueIds = array_values(array_filter($data['filter_values'] ?? []));
            $product->filterValues()->sync($filterValueIds);

            // Delete removed images — only images the user explicitly unchecked
            $keepIds  = array_values(array_filter(array_map('intval', $data['existing_images'] ?? [])));
            $toDelete = $keepIds
                ? $product->images()->whereNotIn('id', $keepIds)->get()
                : collect(); // nothing sent → keep all existing images
            foreach ($toDelete as $img) {
                Storage::disk('public')->delete($img->value);
                $img->delete();
            }

            // Re-index sort of remaining images
            $sortMap = $data['image_sort'] ?? [];
            foreach ($sortMap as $imgId => $sort) {
                Image::where('id', $imgId)->update(['sort' => (int) $sort]);
            }

            // Add new images
            if (!empty($files['images'])) {
                $nextSort = $product->images()->max('sort') + 1;
                $this->saveImages($product, $files['images'], $nextSort);
            }

            return $product->fresh();
        });
    }

    public function delete(int $id): void
    {
        $product = $this->productRepository->getById($id);
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->value);
        }
        $this->productRepository->delete($id);
    }

    private function parsePrice(mixed $value): float
    {
        // Remove thousand separators (dots) and replace decimal comma with dot
        $cleaned = str_replace(['.', ','], ['', '.'], (string) $value);
        return max(0, (float) $cleaned);
    }

    private function resolveCategoryIds(array $selectedIds): array
    {
        if (empty($selectedIds)) {
            return [];
        }
        $all = Category::whereIn('id', $selectedIds)->pluck('parent_id', 'id');
        $ids = array_map('intval', $selectedIds);
        foreach ($all as $catId => $parentId) {
            if ($parentId) {
                $ids[] = (int) $parentId;
            }
        }
        return array_values(array_unique($ids));
    }

    private function saveImages(Product $product, array $uploadedFiles, int $startSort = 0): void
    {
        foreach ($uploadedFiles as $i => $file) {
            /** @var UploadedFile $file */
            $filename = uniqid('product_') . '.webp';
            $path = 'products/' . $filename;

            $webp = $this->convertToWebp($file);
            Storage::disk('public')->put($path, $webp);

            Image::create([
                'value'          => $path,
                'imageable_type' => Product::class,
                'imageable_id'   => $product->id,
                'sort'           => $startSort + $i,
            ]);
        }
    }

    private function convertToWebp(UploadedFile $file): string
    {
        $mime = $file->getMimeType();
        $src  = match (true) {
            str_contains($mime, 'png')  => imagecreatefrompng($file->getRealPath()),
            str_contains($mime, 'gif')  => imagecreatefromgif($file->getRealPath()),
            str_contains($mime, 'webp') => imagecreatefromwebp($file->getRealPath()),
            default                     => imagecreatefromjpeg($file->getRealPath()),
        };

        ob_start();
        imagewebp($src, null, 85);
        $data = ob_get_clean();
        imagedestroy($src);
        return $data;
    }
}

