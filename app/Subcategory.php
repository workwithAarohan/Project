<?php

namespace App;
use App\Cart;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['title','cat_id','image'];
}
