<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $orders = Order::latest()->paginate(5);

        //return collection of posts as a resource
        return new OrderResource(true, 'List Data Orders', $orders);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'customer_name'=> 'required',
            'customer_phone'=> 'required',
            'customer_address'=> 'required',
            'store_location'=> 'required',
            'shipping_method'=> 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $order = Order::create([
            'customer_name'=> $request->customer_name,
            'customer_phone'=> $request->customer_phone,
            'customer_address'=> $request->customer_address,
            'store_location'=> $request->store_location,
            'shipping_method'=> $request->shipping_method,
        ]);

        //return response
        return new OrderResource(true, 'Data Order Berhasil Ditambahkan!', $order);
    }


}
