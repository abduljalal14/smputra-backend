<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderDetailController extends Controller
{
    public function show($id)
    {
        $orderDetail = OrderDetail::find($id);

        return new OrderDetailResource(true, 'Data Order Detail!', $orderDetail);
    }

    public function destroy($id)
    {
        $orderDetail = OrderDetail::find($id);

        $orderDetail->delete();

        return new OrderDetailResource(true, 'Data Order Berhasil dihapus!', $orderDetail);
    }
}
