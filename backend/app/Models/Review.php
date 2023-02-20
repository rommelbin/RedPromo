<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Review extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
        'item_id'
    ];

    public static array $createRules = [
        'text' => ['required', 'max:200'],
        'user_id' => ['required', 'exists:users,id'],
        'item_id' => ['required', 'exists:items,id']
    ];

    public static array $updateRules = [
        'text' => ['max:200'],
        'user_id' => ['exists:users,id']
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function reviewFiles(): HasMany
    {
        return $this->hasMany(ReviewFile::class);
    }
}
