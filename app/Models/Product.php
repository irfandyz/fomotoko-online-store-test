<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Traits\PaginateData;

class Product extends Model
{
    use HasFactory, PaginateData;
    protected $guarded = [];
}
