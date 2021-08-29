<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $guarded = [];

    protected $casts=[
        'price'=>'integer'
    ];

    protected $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.description' => 10,
            'products.price' => 10,
            'categories.name' => 10,
        ],
        'joins' => [
            'categories' => ['products.category_id', 'categories.id']
        ],
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
