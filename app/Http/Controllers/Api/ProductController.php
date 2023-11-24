<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        //get all products
        $products = Product::latest()->paginate(8);

        //return collection of products as a resource
        return new ProductResource(true, 'List Data Posts', $products);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
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
            'category_id' => $request->category_id,
            'image'     => $image->hashName(),
            'name'     => $request->name,
            'desc'   => $request->desc,
            'price'   => $request->price,
        ]);

        //return response
        return new ProductResource(true, 'Data Produk Berhasil Ditambahkan!', $product);
    }

    public function show($id)
    {
        //find product by ID
        $product = Product::find($id);

        //return single product as a resource
        return new ProductResource(true, 'Detail Data Product!', $product);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name'     => 'required',
            'desc'   => 'required',
            'price'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find prdouct by ID
        $product = Product::find($id);

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/products-img', $image->hashName());

            //delete old image
            Storage::delete('public/products-img/'.basename($product->image));

            //update product with new image
            $product->update([
                'category_id' => $request->category_id,
                'image'     => $image->hashName(),
                'name'     => $request->name,
                'desc'   => $request->desc,
                'price'   => $request->price,
            ]);

        } else {

            //update product without image
            $product->update([
                'category_id' => $request->category_id,
                'name'     => $request->name,
                'desc'   => $request->desc,
                'price'   => $request->price,
            ]);
        }

        //return response
        return new ProductResource(true, 'Data Produk Berhasil Diubah!', $product);
    }

    public function destroy($id)
    {

        //find product by ID
        $product = Product::find($id);

        //delete image
        Storage::delete('public/products-img/'.basename($product->image));

        //delete product
        $product->delete();

        //return response
        return new ProductResource(true, 'Data Product Berhasil Dihapus!', null);
    }
}
