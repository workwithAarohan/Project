<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Navbar;
use View;
use App\Cart;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $cartcount = Cart::where('user_id',Auth::user()->id)->count();
        // return View::make('home')->with('cartcount',$cartcount);

        $cartcount = Navbar::cart();
        $dropdown = Navbar::dropdown();
        return View::make('home',compact('cartcount','dropdown'));
    }
}
