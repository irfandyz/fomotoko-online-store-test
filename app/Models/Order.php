<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\PaginateData;

class Order extends Model
{
    use HasFactory, PaginateData;
    protected $guarded = [];
}
