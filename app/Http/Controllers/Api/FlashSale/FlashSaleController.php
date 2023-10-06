<?php

namespace App\Http\Controllers\Api\FlashSale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSale;
use App\Services\Api\FlashSale\FlashSaleService;
use App\Validations\Api\FlashSale\FlashSaleValidation;

class FlashSaleController extends Controller
{
    protected $FlashSaleValidation;
    protected $FlashSaleService;

    public function __construct(FlashSaleValidation $FlashSaleValidation, FlashSaleService $FlashSaleService)
    {
        $this->FlashSaleValidation = $FlashSaleValidation;
        $this->FlashSaleService = $FlashSaleService;
    }

    public function get(Request $request)
    {
        $validation = $this->FlashSaleValidation->get($request);

        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->FlashSaleService->get($request);
        return $this->sendResponse($result);
    }

    public function store(Request $request)
    {
        $validation = $this->FlashSaleValidation->store($request);
        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->FlashSaleService->store($request);

        return $this->sendResponse($result);
    }

    public function deactive(Request $request)
    {
        $validation = $this->FlashSaleValidation->deactive($request);
        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->FlashSaleService->deactive($request);

        return $this->sendResponse($result);
    }

}

