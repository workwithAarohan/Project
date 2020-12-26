<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Traits\Navbar;
use View;
use App\Category;
use App\Subcategory;
use App\Cart;
use Auth;
use Redirect;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        //
        $category = Category::find($id);
        $subcategory = Subcategory::where('cat_id',$id)->get();
        $subcategory->count= Subcategory::where('cat_id',$id)->count();
        $dropdown = Navbar::dropdown();
        return View::make('subcategory.index',compact('subcategory','category','dropdown')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $category = Category::find($id);
        return View::make('subcategory.create')->with('category',$category);
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
        $subcategory = new Subcategory;
        $subcategory->title = $request->input('title');
        $subcategory->cat_id = $request->input('cat_id');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $filename = $image->getClientOriginalName();
            $Path = public_path() . '/image/';
            $image->move($Path, $filename);
            $subcategory->image=$filename;
        }
        $subcategory->save();

        return Redirect::to('subcat/'.$subcategory->cat_id);
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
        $subcategory = Subcategory::find($id);
        $cartcount = Navbar::cart();
        $dropdown = Navbar::dropdown();
        return View::make('subcategory.edit',compact('subcategory','cartcount','dropdown'));
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
        $subcategory = Subcategory::find($id);
        $subcategory->title = $request->input('title');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $filename = $image->getClientOriginalName();
            $Path = public_path() . '/image/';
            $image->move($Path, $filename);
            $subcategory->image=$filename;
        }
        $subcategory->save();

        return Redirect::to('subcat/'.$subcategory->cat_id);
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
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        return Redirect::to('subcat/'.$subcategory->cat_id);
    }
}
