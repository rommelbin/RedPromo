<?php

namespace App\Repositories;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class CategoryRepository extends BaseRepository
{
    public static $model = Category::class;
    public static function getPopularCategories(): array
    {
        $categories = Category::query()
            ->withCount('itemReviews')
            ->get();

        return [
            'data' => $categories->sortBy('item_reviews_count', SORT_REGULAR, true),
            'status' => Response::HTTP_OK
        ];
    }
}
