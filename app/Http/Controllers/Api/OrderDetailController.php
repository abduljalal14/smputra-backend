<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderDetailController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $orders = OrderDetail::latest()->paginate(5);

        //return collection of posts as a resource
        return new OrderDetailResource(true, 'List Data Detail Orders', $orders);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'order_id'=> 'required',
            'product_id'=> 'required',
            'qty'=> 'required',
            'subtotal'=> 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $order = OrderDetail::create([
            'order_id'=> $request->order_id,
            'product_id'=> $request->product_id,
            'qty'=> $request->qty,
            'subtotal'=> $request->subtotal,
        ]);

        //return response
        return new OrderDetailResource(true, 'Data Detail Order Berhasil Ditambahkan!', $order);
    }
}
