<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'artist',
        'year',
        'image_url',
        'image',
        'genre_id',
        'user_id',
        'album_is_public', // Add this line to explicitly declare the property
    ];


    public function genre(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
