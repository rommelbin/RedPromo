<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static array $createRules = [
        'name' => ['required', 'string', 'max:200'],
    ];

    public static array $updateRules = [
        'name' => ['required', 'string', 'max:200']
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function itemReviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Item::class);
    }

}
