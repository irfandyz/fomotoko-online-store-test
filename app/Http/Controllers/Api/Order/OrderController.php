<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\Order\OrderService;
use App\Validations\Api\Order\OrderValidation;

class OrderController extends Controller
{
    protected $orderValidation;
    protected $orderService;

    public function __construct(OrderValidation $orderValidation, OrderService $orderService)
    {
        $this->OrderValidation = $orderValidation;
        $this->OrderService = $orderService;
    }

    public function get(Request $request)
    {
        $validation = $this->OrderValidation->get($request);

        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->OrderService->get($request);

        return $this->sendResponse($result);
    }

    public function store(Request $request)
    {
        $validation = $this->OrderValidation->store($request);
        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->OrderService->store($request);

        return $this->sendResponse($result);
    }
}
