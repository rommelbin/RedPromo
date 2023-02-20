<?php

namespace App\Repositories;

use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ItemRepository extends BaseRepository
{
    public static $model = Item::class;

    public static function search(array $attributes, ?int $id)
    {
        $searchedText = $attributes['text'];

        $unionPart = DB::table('items')
            ->orWhere('items.name', 'LIKE', '%' . $searchedText . '%')
            ->select('id', 'name', DB::raw("'Item' as column_name"));
        $data = DB::table('categories')
            ->orWhere('categories.name', 'LIKE', '%' . $searchedText . '%')
            ->select('id', 'name', DB::raw("'Category' as column_name"))
            ->unionAll($unionPart)
            ->get();

        return [
            'data' => $data->sortBy('name'),
            'status' => Response::HTTP_OK
        ];
    }
}
