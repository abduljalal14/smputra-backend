<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        //get all posts
        $products = Product::latest()->paginate(8);

        //return collection of posts as a resource
        return new ProductResource(true, 'List Data Posts', $products);
    }
}
