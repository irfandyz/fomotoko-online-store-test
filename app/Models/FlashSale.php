<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\PaginateData;
use App\Models\OrderDetail;

class FlashSale extends Model
{
    use HasFactory, PaginateData;
    protected $guarded = []; 

    public function getTotalSale(){
        $order = OrderDetail::where('product_id',$this->id)->get()->sum('amount');
        return $order;
    }
    public function checkExpiredDate(){
        $dateExpired = FlashSale::find($this->id)->expired_date;
        $status = false;
        if (date('d-m-Y') >= date('d-m-Y',strtotime($dateExpired))) {
            $status = true;
        }
        return $status;
    }
}
