<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    public function index()
    {
        //get all products
        $categories = Category::latest()->paginate(30);

        //return collection of categories as a resource
        return new CategoryResource(true, 'List Data Categories', $categories);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/category-img', $image->hashName());
        
        //create post
        $category = Category::create([
            'name'     => $request->name,
            'image'     =>  $image->hashName()
        ]);

        //return response
        return new CategoryResource(true, 'Data Kategori Berhasil Ditambahkan!', $category);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required', 
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

         //find prdouct by ID
         $category = Category::find($id);
         
        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/category-img', $image->hashName());

            //delete old image
            Storage::delete('public/category-img/'.basename($category->image));

            //update category with new image
            $category->update([
                'image'     => $image->hashName(),
                'name'     => $request->name,
            ]);

        } else {

            //update category without image
            $category->update([
                'name'     => $request->name,
                'image'     => $request->name,
            ]);
        }

               //return response
        return new CategoryResource(true, 'Data Kategori Berhasil Diubah!', $category);
    }
    public function destroy($id)
    {
        //find category by ID
        $category = Category::find($id);

        //delete image
        Storage::delete('public/category-img/'.basename($category->image));
        //delete category
        $category->delete();
        //return response
        return new CategoryResource(true, 'Data Kategori Berhasil Dihapus!', null);
    }
}
