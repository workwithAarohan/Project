<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Traits\Navbar;
use App\Category;
use App\Subcategory;
use App\Brand;
use App\Product;
use App\Cart;
use View;

class NavController extends Controller
{
    //

    public function dashboard()
    {
        $subcategory = DB::table('subcategories')->select('*')->inRandomOrder()->limit(16)->get();
        
        $product = DB::table('products')->select('*')->inRandomOrder()->limit(15)->get();

        // $cartcount = Navbar::cart();
        $dropdown = Navbar::dropdown();

        return view('dashboard',compact('subcategory','product','cartcount','dropdown'));
    }

    public function search(Request $request)
    {
        $search = INPUT::get('search');
        $cartcount = Navbar::cart();
        $dropdown = Navbar::dropdown();

        if($search != '')
        {
            $product = Product::where('name','LIKE', '%'.$search.'%')->get();

            if(count($product)>0)
            {
                return View::make('test',compact('dropdown','cartcount'))->withDetails($product)->withQuery($search);
            }
            
        }
    }

}
