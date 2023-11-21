<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index()
    {
        //get all posts
        $products = Product::latest()->paginate(8);

        //return collection of posts as a resource
        return new ProductResource(true, 'List Data Posts', $products);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'     => 'required',
            'desc'   => 'required',
            'price'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products-img', $image->hashName());

        //create post
        $product = Product::create([
            'image'     => $image->hashName(),
            'name'     => $request->name,
            'desc'   => $request->desc,
            'price'   => $request->price,
        ]);

        //return response
        return new ProductResource(true, 'Data Produk Berhasil Ditambahkan!', $product);
    }
}
