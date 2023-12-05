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
        $orders = Order::with('orderDetails')->latest()->paginate(10);

        //return collection of posts as a resource
        return new OrderResource(true, 'List Data Orders', $orders);
    }

    public function show($id)
    {
        $order = Order::with('orderDetails')->find($id);

        return new OrderResource(true, 'Detail Data Orders', $order);
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

        // Simpan detail pesanan jika ada
        if ($request->has('details')) {
            $order->orderDetails()->createMany($request->details);
        }

        //return response
        return new OrderResource(true, 'Data Order Berhasil Ditambahkan!', $order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return new OrderResource(true, 'Data Order Gagal dihapus!', $order);
        }

        // Hapus detail pesanan terkait
        $order->orderDetails()->delete();

        // Hapus pesanan
        $order->delete();

        return new OrderResource(true, 'Data Order Berhasil dihapus!', $order);
    }


}
