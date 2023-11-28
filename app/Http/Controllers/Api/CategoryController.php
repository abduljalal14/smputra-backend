<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function index()
    {
        //get all products
        $categories = Category::latest()->paginate(8);

        //return collection of categories as a resource
        return new CategoryResource(true, 'List Data Categories', $categories);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        //create post
        $category = Category::create([
            'name'     => $request->name,
        ]);

        //return response
        return new CategoryResource(true, 'Data Kategori Berhasil Ditambahkan!', $category);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find prdouct by ID
        $category = Category::find($id);
        
        $category->update([
                'name'     => $request->name,
            ]);

               //return response
        return new CategoryResource(true, 'Data Kategori Berhasil Diubah!', $category);
    }
    public function destroy($id)
    {
        //find product by ID
        $category = Category::find($id);
        //delete product
        $category->delete();
        //return response
        return new CategoryResource(true, 'Data Kategori Berhasil Dihapus!', null);
    }
}
