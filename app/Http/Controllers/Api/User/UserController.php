<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Api\User\UserService;
use App\Validations\Api\User\UserValidation;

class UserController extends Controller
{
    protected $UserValidation;
    protected $UserService;

    public function __construct(UserValidation $UserValidation, UserService $UserService)
    {
        $this->UserValidation = $UserValidation;
        $this->UserService = $UserService;
    }

    public function get(Request $request)
    {
        $validation = $this->UserValidation->get($request);

        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->UserService->get($request);
        return $this->sendResponse($result);
    }
}

