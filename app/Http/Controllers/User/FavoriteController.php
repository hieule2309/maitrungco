<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\User\ProductService;

class FavoriteController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function index(Request $request)
    {
        $favoriteIds = json_decode($request->cookie('favorites', '[]'), true);

        if (!is_array($favoriteIds)) {
            $favoriteIds = [];
        }

        $products = collect();
        if (!empty($favoriteIds)) {
            $products = $this->productService->getFavoriteProducts($favoriteIds, 20);
        } else {
            // Empty paginator just in case view expects it
            $products = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
        }

        return view('user.favorites', compact('products'));
    }

    public function toggle(Request $request)
    {
        $productId = $request->input('product_id');
        $favorites = json_decode($request->cookie('favorites', '[]'), true);

        if (!is_array($favorites)) {
            $favorites = [];
        }

        if (in_array($productId, $favorites)) {
            $favorites = array_diff($favorites, [$productId]);
            $isFavorite = false;
        } else {
            $favorites[] = $productId;
            $isFavorite = true;
        }

        $favorites = array_values($favorites);

        $cookie = cookie('favorites', json_encode($favorites), 60 * 24 * 30);

        return response()->json([
            'status' => 'success',
            'is_favorite' => $isFavorite,
            'count' => count($favorites)
        ])->cookie($cookie);
    }

    public function clearAll()
    {
        $cookie = cookie('favorites', json_encode([]), 60 * 24 * 30);

        return response()->json([
            'status' => 'success',
            'count' => 0
        ])->cookie($cookie);
    }
}
