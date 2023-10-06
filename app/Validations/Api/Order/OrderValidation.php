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
        $validate = [
            'user_id' => ['required','exists:products,id'],
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
            'product_id' => ['required','exists:products,id'],
            'quantity' => ['required','integer'],
        ];

        $request->validate($validate);

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }
}
