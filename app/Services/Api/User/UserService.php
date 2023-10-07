<?php

namespace App\Services\Api\User;

use App\Models\User;
use App\Models\Product;

class UserService
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
            $paginateData = User::getPaginatedData(true, $pageNumber, $amountOfData, 'name', 'asc');

            $User = $paginateData->data;
            $paginate = $paginateData->pagination;
        } else {
            $User = User::orderBy('name', 'asc')->get();
        }

        $status = true;
        $message = 'Data retrieved successfully !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $User,
            'pagination' => $paginate,
        ];

        return $result;
    }
}
