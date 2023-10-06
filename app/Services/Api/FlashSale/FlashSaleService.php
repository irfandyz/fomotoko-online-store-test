<?php

namespace App\Services\Api\FlashSale;

use App\Models\FlashSale;
use App\Models\Product;

class FlashSaleService
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
            $paginateData = FlashSale::getPaginatedData(true, $pageNumber, $amountOfData, 'created_at', 'desc');
            if ($request->status) {
                $paginateData = FlashSale::where('status',$request->status)->getPaginatedData(true, $pageNumber, $amountOfData, 'created_at', 'desc');
            }

            $FlashSale = $paginateData->data;
            $paginate = $paginateData->pagination;
        } else {
            $FlashSale = FlashSale::orderBy('created_at', 'desc')->get();
            if ($request->status) {
                $FlashSale = FlashSale::where('status',$request->status)->orderBy('created_at', 'desc')->get();
            }
        }

        $status = true;
        $message = 'Data retrieved successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $FlashSale,
            'pagination' => $paginate,
        ];

        return $result;
    }

    public function store($request)
    {
        $result = [];
        $result['status'] = false;
        $product = Product::find($request->product_id);
        $data = [
            'product_id'=>$request->product_id,
            'price'=>$product->price,
            'type'=>$request->type,
            'amount'=>$request->amount,
            'expired_date'=>$request->expired_date,
            'max_sale'=>$request->max_sale,
        ];

        $FlashSale = FlashSale::create($data);

        $status = true;
        $message = 'Data created successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $FlashSale,
        ];

        return $result;
    }

    public function deactive($request)
    {
        $result = [];
        $result['status'] = false;

        $flashSale = FlashSale::find($request->flash_sale_id)->update([
            'status'=>'deactive'
        ]);
        $flashSale = FlashSale::find($request->flash_sale_id);

        $status = true;
        $message = 'Flash Sale successfully deactivated !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $flashSale,
        ];

        return $result;
    }
}
