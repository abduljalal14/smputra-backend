<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{
    public function index()
    {
        //get all products
        $categories = Category::latest()->paginate(8);

        //return collection of categories as a resource
        return new CategoryResource(true, 'List Data Categories', $categories);
    }

}
