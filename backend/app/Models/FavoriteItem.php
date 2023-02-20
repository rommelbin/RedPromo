<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteItem extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
    ];

    public static array $createRules = [
        'user_id' => ['int', 'exists:users,id'],
        'item_id' => ['int', 'exists:items,id']
    ];

    public static array $updateRules = [
        'user_id' => ['int', 'exists:users,id'],
        'item_id' => ['int', 'exists:items,id']
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
