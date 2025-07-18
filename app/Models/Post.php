<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'website_id',
        'slug'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
