<?php

namespace App\Services\Api\Product;

use App\Models\Product;

class ProductService
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

            $paginateData = Product::with('flashSale')->getPaginatedData(true, $pageNumber, $amountOfData, 'name', 'asc');

            $product = $paginateData->data;
            $paginate = $paginateData->pagination;
        } else {
            $product = Product::with('flashSale')->orderBy('name', 'asc')->get();
        }

        $status = true;
        $message = 'Data retrieved successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $product,
            'pagination' => $paginate,
        ];

        return $result;
    }

    public function find($request)
    {
        $product = Product::with('flashSale')->find($request->product_id);

        $status = true;
        $message = 'Data retrieved successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $product,
        ];

        return $result;
    }

    public function store($request)
    {
        $result = [];
        $result['status'] = false;

        $data = [
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock,
        ];
        $product = Product::create($data);

        $status = true;
        $message = 'Data created successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $product,
        ];

        return $result;
    }
}
