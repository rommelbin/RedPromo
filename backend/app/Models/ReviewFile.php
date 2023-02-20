<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewFile extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'extension',
        'path'
    ];


    public static array $createRules = [
        'review_id' => ['required', 'exists:reviews,id'],
        'extension' => ['required', 'in:jpg,png,jpeg'],
        'review_count' => ['integer','max:3'],
        'path' => ['required', 'string']
    ];

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }

}
