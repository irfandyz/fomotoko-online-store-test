<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\Cart\CartService;
use App\Validations\Api\Cart\CartValidation;

class CartController extends Controller
{
    protected $cartValidation;
    protected $cartService;

    public function __construct(CartValidation $cartValidation, CartService $cartService)
    {
        $this->CartValidation = $cartValidation;
        $this->CartService = $cartService;
    }

    public function get(Request $request)
    {
        $validation = $this->CartValidation->get($request);

        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->CartService->get($request);

        return $this->sendResponse($result);
    }

    public function store(Request $request)
    {
        $validation = $this->CartValidation->store($request);
        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->CartService->store($request);

        return $this->sendResponse($result);
    }

}

