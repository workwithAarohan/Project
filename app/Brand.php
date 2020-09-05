<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use Auth;

class Brand extends Model
{
    protected $fillable = ['name','subcat_id','image'];
}
