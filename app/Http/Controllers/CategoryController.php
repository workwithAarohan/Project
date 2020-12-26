<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Navbar;
use App\Category;
use App\Cart;
use App\User;
use Auth;
use View;
use Session;
use Redirect;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index()
    {
        //
        $category = Category::all();  //Select * from categories;
        $category->count = Category::count();
        $dropdown = Navbar::dropdown();
        return View::make('category.index',compact('category','dropdown'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('category.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $category = new Category;
        $category->title = $request->input('title');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $filename = $image->getClientOriginalName();
            $Path = public_path() . '/image/';
            $image->move($Path, $filename);
            $category->image=$filename;
        }

        $category->save();

        return Redirect::to('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = User::all();

        return View::make('category.show')->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        $cartcount = Navbar::cart();
        $dropdown = Navbar::dropdown();

        return View::make('category.edit',compact('category','cartcount','dropdown'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::find($id);
        $category->title = $request->input('title');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $filename = $image->getClientOriginalName();
            $Path = public_path() . '/image/';
            $image->move($Path, $filename);
            $category->image=$filename;
        }
        $category->save();

        return Redirect::to('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        $category->delete();

        return Redirect::to('category');
    }
}
