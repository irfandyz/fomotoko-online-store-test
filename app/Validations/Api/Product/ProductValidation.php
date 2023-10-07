<?php

namespace App\Validations\Api\Product;

use Illuminate\Validation\Rule;

class ProductValidation
{
    public function get($request)
    {
        $result = [];
        $result['status'] = false;

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

        $validate = [
            'product_id' => ['required','exists:products,id'],
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
            'name' => ['required'],
            'price' => ['required','integer'],
            'stock' => ['required','integer'],
        ];

        $request->validate($validate);

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }
}
