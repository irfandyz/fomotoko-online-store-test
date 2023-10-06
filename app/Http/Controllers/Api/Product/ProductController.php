<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\Product\ProductService;
use App\Validations\Api\Product\ProductValidation;

class ProductController extends Controller
{
    protected $productValidation;
    protected $productService;

    public function __construct(ProductValidation $productValidation, ProductService $productService)
    {
        $this->ProductValidation = $productValidation;
        $this->ProductService = $productService;
    }

    public function get(Request $request)
    {
        $validation = $this->ProductValidation->get($request);

        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->ProductService->get($request);

        return $this->sendResponse($result);
    }

    public function store(Request $request)
    {
        $validation = $this->ProductValidation->store($request);
        if (!$validation->status) {
            return $this->sendResponse($validation);
        }

        $result = $this->ProductService->store($request);

        return $this->sendResponse($result);
    }

}

