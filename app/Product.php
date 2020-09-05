<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use Auth;

class Product extends Model
{
    //
    protected $primaryKey = 'product_id';
    protected $fillable = ['name','image','price','brand_id'];
}
