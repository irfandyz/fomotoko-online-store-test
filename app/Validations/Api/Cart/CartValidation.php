<?php

namespace App\Validations\Api\Cart;

use Illuminate\Validation\Rule;

class CartValidation
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
    public function update($request)
    {
        $result = [];
        $result['status'] = false;

        // Check required parameter
        $validate = [
            'cart_id' => ['required','exists:carts,id'],
            'quantity' => ['required','integer'],
        ];

        $request->validate($validate);

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }
    public function delete($request)
    {
        $result = [];
        $result['status'] = false;

        // Check required parameter
        $validate = [
            'cart_id' => ['required','exists:carts,id'],
        ];

        $request->validate($validate);

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }
}
