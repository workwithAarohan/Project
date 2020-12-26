<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Traits\Navbar;
use App\Cart;
use DB;
use App\User;
use Auth;
use View;
use Redirect;

class CounterController extends Controller
{
    //
    public function index($id)
    {
        $user = User::find($id);
        $counter = DB::table('carts')->join('products','carts.product_id','=','products.product_id')
            ->select('carts.*','products.*')->where('user_id',$id)->get();
        $counter->totalprice = 0;
        foreach($counter as $value)
        { 
            $value->totprice = $value->price * $value->quantity;
            $counter->totalprice = $counter->totalprice + $value->totprice;
            $value->totprice = number_format(($value->totprice),2);
            $value->price = number_format(($value->price),2);
        }

        $counter->totalprice = number_format(($counter->totalprice),2);

        // $cartcount = Navbar::cart();
        $dropdown = Navbar::dropdown();
    
        return View::make('counter.index',compact('counter','dropdown'));
    }

    public function addcart(Request $request)
    {
        $cart = new Cart;
        $existence = Cart::where([
            ['product_id',$request->input('product_id')],
            ['user_id',Auth::user()->id]])
            ->exists();
        if(!$existence)
        {   
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->input('product_id');
            
            $cart->save();
        }
        else 
        {
            $cart = Cart::where([
                    ['product_id',$request->input('product_id')],
                    ['user_id',Auth::user()->id]])
                    ->select('*')->get();
                    
            foreach($cart as $value)
            {
                $value->quantity = $value->quantity + 1;
                $value->save();
            }
        }
        return redirect()->back();
    }

    public function updatecart(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $request->input('quantity');
        $cart->save();

        return Redirect::to('counter/'.$cart->user_id);
    }


    public function delcart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return Redirect::to('counter/'.$cart->user_id);
    }

    public function order()
    {
        
    }

}
