<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'title',
    'author',
    'description',
    'genre',
    'published_year',
    'isbn',
    'pages',
    'language',
    'publisher',
    'price',
    'cover_image',
    'is_available',
])]
class Book extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'published_year' => 'integer',
            'pages' => 'integer',
            'price' => 'decimal:2',
            'is_available' => 'boolean',
        ];
    }
}
