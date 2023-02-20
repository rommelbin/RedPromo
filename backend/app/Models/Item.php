<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
    ];

    public static array $createRules = [
        'name' => ['string', 'required'],
        'category_id' => ['required', 'exists:categories,id']
    ];

    public static array $updateRules = [
        'name' => ['string', 'required'],
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
