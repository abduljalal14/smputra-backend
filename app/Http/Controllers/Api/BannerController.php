<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Resources\BannerResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class BannerController extends Controller
{
    public function index()
    {
        //get all products
        $banners = Banner::latest()->paginate(30);

        //return collection of banners as a resource
        return new BannerResource(true, 'List Data banners', $banners);
    }

    public function show($id)
    {
        //find product by ID
        $banner = Banner::find($id);

        //return single banner as a resource
        return new BannerResource(true, 'Detail Data banner!', $banner);
    }


    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'link'     => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/banner-img', $image->hashName());
        
        //create post
        $banner = Banner::create([
            'link'     => $request->link,
            'image'     =>  $image->hashName()
        ]);

        //return response
        return new BannerResource(true, 'Data Kategori Berhasil Ditambahkan!', $banner);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'link'     => 'required', 
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

         //find prdouct by ID
         $banner = Banner::find($id);
         
        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/banner-img', $image->hashName());

            //delete old image
            Storage::delete('public/banner-img/'.basename($banner->image));

            //update category with new image
            $banner->update([
                'image'     => $image->hashName(),
                'link'     => $request->link,
            ]);

        } else {

            //update category without image
            $banner->update([
                'link'     => $request->link,
            ]);
        }

               //return response
        return new BannerResource(true, 'Data Kategori Berhasil Diubah!', $banner);
    }
    public function destroy($id)
    {
        //find category by ID
        $banner = Banner::find($id);

        //delete image
        Storage::delete('public/banner-img/'.basename($banner->image));
        //delete banner
        $banner->delete();
        //return response
        return new BannerResource(true, 'Data Kategori Berhasil Dihapus!', null);
    }
}
