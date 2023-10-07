<?php

namespace App\Validations\Api\Order;

use Illuminate\Validation\Rule;

class OrderValidation
{
    public function get($request)
    {
        $result = [];
        $result['status'] = false;

        // Check required parameter

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }

    public function getByUserId($request)
    {
        $result = [];
        $result['status'] = false;

        // Check required parameter
        $validate = [
            'user_id' => ['required','exists:users,id'],
        ];

        $request->validate($validate);

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }

    public function find($request)
    {
        $result = [];
        $result['status'] = false;

        // Check required parameter
        $validate = [
            'order_id' => ['required','exists:orders,id'],
        ];

        $request->validate($validate);

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }
    
    public function store($request)
    {
        $result = [];
        $result['status'] = false;

        // Check required parameter
        $validate = [
            'user_id' => ['required','exists:users,id'],
            'payment' => ['required'],
            'expedition' => ['required'],
            'cart_id' => ['required','array'],
            'cart_id.*' => ['exists:carts,id'],
        ];

        $request->validate($validate);

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }
}
