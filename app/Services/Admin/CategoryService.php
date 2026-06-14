<?php

namespace App\Services\Admin;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    private const DEFAULT_ICON = 'fas fa-folder';

    public function getAll(): Collection
    {
        return Category::orderBy('name')->get();
    }

    public function getTreeForIndex(?string $search = null): array|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if ($search) {
            return Category::with('parent.parent')
                ->where('name', 'like', '%' . $search . '%')
                ->orderBy('name')
                ->paginate(20);
        }

        // Paginate root categories, mỗi trang 10 root + toàn bộ con của chúng
        $paginator = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->paginate(10);

        // Flatten từng root thành rows nhưng giữ paginator để lấy links()
        $paginator->getCollection()->transform(fn($root) => $root); // giữ nguyên
        return $paginator;
    }

    public function getParentOptions(?Category $excluded = null): array
    {
        $categories = Category::with('parent')->orderBy('name')->get();
        $excludedIds = $excluded ? $this->collectDescendantIds($excluded) : [];

        return $categories
            ->filter(function (Category $category) use ($excludedIds) {
                return !in_array($category->id, $excludedIds, true) && $this->resolveLevel($category) < 3;
            })
            ->sortBy(fn (Category $category) => sprintf('%d-%s', $this->resolveLevel($category), $category->name))
            ->map(function (Category $category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'level' => $this->resolveLevel($category),
                ];
            })
            ->values()
            ->all();
    }

    public function getDefaultIcon(): string
    {
        return self::DEFAULT_ICON;
    }

    public function store(array $data): Category
    {
        return DB::transaction(function () use ($data) {
            $parent = $this->resolveParent($data['parent_id'] ?? null);
            $this->assertValidParent(null, $parent);

            $category = Category::create([
                'name' => $data['name'],
                'slug' => '',
                'description' => $data['description'] ?? null,
                'parent_id' => $parent?->id,
                'icon' => $this->resolveIcon($parent, $data['icon'] ?? null),
            ]);

            $category->update([
                'slug' => $this->generateSlug($category->name, $category->id),
            ]);

            return $category->fresh();
        });
    }

    public function update(Category $category, array $data): Category
    {
        return DB::transaction(function () use ($category, $data) {
            $parent = $this->resolveParent($data['parent_id'] ?? null);
            $this->assertValidParent($category, $parent);

            $category->update([
                'name' => $data['name'],
                'slug' => $this->generateSlug($data['name'], $category->id),
                'description' => $data['description'] ?? null,
                'parent_id' => $parent?->id,
                'icon' => $this->resolveIcon($parent, $data['icon'] ?? null),
            ]);

            return $category->fresh();
        });
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }

    public function resolveLevel(?Category $category): int
    {
        if (!$category) {
            return 0;
        }

        $level = 1;
        $parentId = $category->parent_id;

        while ($parentId) {
            $level++;
            $parentId = Category::whereKey($parentId)->value('parent_id');
        }

        return $level;
    }

    public function isDescendantOf(Category $category, Category $possibleAncestor): bool
    {
        $parentId = $category->parent_id;

        while ($parentId) {
            if ((int) $parentId === (int) $possibleAncestor->id) {
                return true;
            }

            $parentId = Category::whereKey($parentId)->value('parent_id');
        }

        return false;
    }

    private function resolveParent(mixed $parentId): ?Category
    {
        if (!$parentId) {
            return null;
        }

        return Category::findOrFail($parentId);
    }

    private function resolveIcon(?Category $parent, ?string $icon): string
    {
        if ($parent) {
            return self::DEFAULT_ICON;
        }

        $icon = trim((string) $icon);

        return $icon !== '' ? $icon : self::DEFAULT_ICON;
    }

    private function generateSlug(string $name, int $id): string
    {
        return Str::slug($name) . '-' . $id;
    }

    private function assertValidParent(?Category $category, ?Category $parent): void
    {
        if (!$parent) {
            return;
        }

        if ($category && (int) $category->id === (int) $parent->id) {
            throw ValidationException::withMessages([
                'parent_id' => 'Danh mục cha không được trùng với chính nó.',
            ]);
        }

        if ($category && $this->isDescendantOf($parent, $category)) {
            throw ValidationException::withMessages([
                'parent_id' => 'Không thể chọn danh mục con làm danh mục cha.',
            ]);
        }

        if ($this->resolveLevel($parent) >= 3) {
            throw ValidationException::withMessages([
                'parent_id' => 'Danh mục chỉ hỗ trợ tối đa 3 cấp.',
            ]);
        }
    }

    private function flattenTree(iterable $categories, int $level = 1): array
    {
        $items = [];

        foreach ($categories as $category) {
            $items[] = [
                'category' => $category,
                'level' => $level,
            ];

            if ($category->childrenRecursive->isNotEmpty()) {
                $items = array_merge($items, $this->flattenTree($category->childrenRecursive, $level + 1));
            }
        }

        return $items;
    }

    private function collectDescendantIds(Category $category): array
    {
        $ids = [$category->id];
        $children = Category::where('parent_id', $category->id)->get(['id']);

        foreach ($children as $child) {
            $ids = array_merge($ids, $this->collectDescendantIds($child));
        }

        return array_values(array_unique($ids));
    }
}