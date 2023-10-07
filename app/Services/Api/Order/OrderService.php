<?php

namespace App\Services\Api\Order;

use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\FlashSale;

class OrderService
{
    public function get($request)
    {
        $paginate = (object) [];

        if ($request->paginate == 'true') {
            $pageNumber = 1;
            $amountOfData = 20;

            if ($request->page_number) {
                $pageNumber = $request->page_number;
            }

            if ($request->amount_of_data) {
                $amountOfData = $request->amount_of_data;
            }

            $paginateData = Order::with('orderDetail.product')->with('orderDetail.flashSale')->getPaginatedData(true, $pageNumber, $amountOfData, 'created_at', 'desc');

            $order = $paginateData->data;
            $paginate = $paginateData->pagination;
        } else {
            $order = Order::with('orderDetail.product')->with('orderDetail.flashSale')->orderBy('created_at', 'desc')->get();
        }

        $status = true;
        $message = 'Data retrieved successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $order,
            'pagination' => $paginate,
        ];

        return $result;
    }

    public function getByUserId($request)
    {
        $paginate = (object) [];

        if ($request->paginate == 'true') {
            $pageNumber = 1;
            $amountOfData = 20;

            if ($request->page_number) {
                $pageNumber = $request->page_number;
            }

            if ($request->amount_of_data) {
                $amountOfData = $request->amount_of_data;
            }

            $paginateData = Order::where('user_id',$request->user_id)->with('orderDetail.product')->with('orderDetail.flashSale')->getPaginatedData(true, $pageNumber, $amountOfData, 'created_at', 'desc');

            $order = $paginateData->data;
            $paginate = $paginateData->pagination;
        } else {
            $order = Order::where('user_id',$request->user_id)->with('orderDetail.product')->with('orderDetail.flashSale')->orderBy('created_at', 'desc')->get();
        }

        $status = true;
        $message = 'Data retrieved successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $order,
            'pagination' => $paginate,
        ];

        return $result;
    }

    public function find($request)
    {
        $order = Order::with('orderDetail.product')->with('orderDetail.flashSale')->orderBy('created_at', 'desc')->find($request->order_id);

        $status = true;
        $message = 'Data retrieved successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $order,
        ];

        return $result;
    }

    public function store($request)
    {
        $result = [];
        $result['status'] = false;

        $cart = Cart::with('product')->whereIn('id',$request->cart_id)->get();
        $product = [];
        $totalPrice = 0;
        foreach ($cart as $value) {
            $flashSale = FlashSale::where('product_id',$value->product_id)->where('status','active')->first();
            if ($flashSale && $flashSale->getTotalSale() < $flashSale->max_sale??0 && $flashSale->checkExpiredDate() == true) {
                if ($flashSale->type == 'percentage') {
                    $discount = $flashSale->price*$flashSale->amount/100;
                }else{
                    $discount = $flashSale->amount;
                }
                $totalPrice = $totalPrice+($value->quantity*($value->product->price-$discount));
            }else{
                $totalPrice = $totalPrice+($value->quantity*$value->product->price);
            }
            $value->flashSale = $flashSale;
            array_push($product,$value);
        }
        $data = [
            'code'=>"FMTK".date('dmYHis'),
            'user_id'=>$request->user_id,
            'expedition'=>$request->expedition,
            'payment'=>$request->payment,
            'total_price'=>$totalPrice,
        ];
        $order = Order::create($data);

        foreach ($product as $value) {
            OrderDetail::create([
                'product_id'=>$value->product_id,
                'order_id'=>$order->id,
                'flash_sale_id'=>$value->flashSale->id??null,
                'quantity'=>$value->quantity,
                'price'=>$value->flashSale->price??$value->product->price,
            ]);
        }
        Cart::whereIn('id',$request->cart_id)->delete();
        $order = Order::with('orderDetail.product')->with('orderDetail.flashSale')->find($order->id);

        $status = true;
        $message = 'Data created successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $order,
        ];

        return $result;
    }
}
