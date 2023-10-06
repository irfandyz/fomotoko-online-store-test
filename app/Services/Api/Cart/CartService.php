<?php

namespace App\Services\Api\Cart;

use App\Models\Cart;

class CartService
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

            $paginateData = Cart::getPaginatedData(true, $pageNumber, $amountOfData, 'created_at', 'desc');

            $cart = $paginateData->data;
            $paginate = $paginateData->pagination;
        } else {
            $cart = Cart::with('product')->orderBy('created_at', 'desc')->get();
        }

        $status = true;
        $message = 'Data retrieved successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $cart,
            'pagination' => $paginate,
        ];

        return $result;
    }

    public function store($request)
    {
        $result = [];
        $result['status'] = false;

        $data = [
            'user_id'=>$request->user_id,
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
        ];
        $cart = Cart::create($data);

        $status = true;
        $message = 'Data created successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $cart,
        ];

        return $result;
    }
}
