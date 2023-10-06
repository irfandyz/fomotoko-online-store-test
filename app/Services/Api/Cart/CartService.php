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

        $status = true;
        $message = 'Data created successfully !';

        // Check to see if this product already exists
        $cart = Cart::where('user_id',$request->user_id)->where('product_id',$request->product_id)->first();
        if ($cart) {
            $cart->update([
                'quantity'=>$cart->quantity+$request->quantity
            ]);
            $cart = Cart::where('user_id',$request->user_id)->where('product_id',$request->product_id)->first();
            $message = 'Data added successfully !';
        }else{
            $cart = Cart::create($data);
        }

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $cart,
        ];

        return $result;
    }
    public function update($request)
    {
        $result = [];
        $result['status'] = false;

        $data = [
            'quantity'=>$request->quantity,
        ];
        $cart = Cart::find($request->cart_id)->update($data);
        $cart = Cart::find($request->cart_id);

        $status = true;
        $message = 'Data updated successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $cart,
        ];

        return $result;
    }
    public function delete($request)
    {
        $result = [];
        $result['status'] = false;

        $cart = Cart::find($request->cart_id)->delete();

        $status = true;
        $message = 'Data deleted successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
