<?php

namespace App\Validations\Api\FlashSale;

use Illuminate\Validation\Rule;
use App\Models\FlashSale;

class FlashSaleValidation
{
    public function get($request)
    {
        $result = [];
        $result['status'] = false;

        // Check required parameter
        $validate = [
            'status' => ['in:active,deactive'],
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
            'product_id' => ['required','exists:products,id'],
            'type' => ['required','in:percentage,amount'],
            'amount' => ['required','integer'],
        ];
        if ($request->expired_date) {
            $validate['expired_date'] = ['required','date_format:Y-m-d'];
        }elseif ($request->max_sale) {
            $validate['max_sale'] = ['required','integer'];
        }else{
            $validate['max_sale'] = ['required','integer'];
            $validate['expired_date'] = ['required','date_format:Y-m-d'];
        }

        $request->validate($validate);
        
        $flashSale = FlashSale::where('product_id',$request->product_id)->orderBy('created_at','desc')->first();
        if ($flashSale) {
            if ($flashSale->getTotalSale() >= $flashSale->max_sale??0 or $flashSale->checkExpiredDate() == true) {
                $result['message'] = 'This product is on Flash Sale !';
                $result = (object) $result;
                return $result;
            }
            if ($flashSale->status() == 'deactive') {
                $result['message'] = 'This flash sale is closed by admin !';
                $result = (object) $result;
                return $result;
            }
        }

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }
    public function deactive($request)
    {
        $result = [];
        $result['status'] = false;

        // Check required parameter
        $validate = [
            'flash_sale_id' => ['required','exists:flash_sales,id'],
        ];

        $request->validate($validate);

        // Validation success
        $result['status'] = true;
        $result['message'] = 'Validation successfully !';

        $result = (object) $result;

        return $result;
    }
}
