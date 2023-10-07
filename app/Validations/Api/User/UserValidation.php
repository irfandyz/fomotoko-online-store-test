<?php

namespace App\Validations\Api\User;

use Illuminate\Validation\Rule;

class UserValidation
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
}
