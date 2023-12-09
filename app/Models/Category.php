<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
    ];
    
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/category-img/' . $image),
        );
    }
    public function products() {
        return $this->hasMany(Product::class);
    }


    
}
