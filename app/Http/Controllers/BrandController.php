<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Navbar;
use View;
use App\Subcategory;
use App\Brand;
use App\Cart;
use Auth;
use Redirect;

class BrandController extends Controller
{
    //
    public function index($id)
    {
        $subcategory = Subcategory::find($id);
        $brand = Brand::where('subcat_id',$id)->get();
        $brand->count = Brand::where('subcat_id',$id)->count();
        $dropdown = Navbar::dropdown();
        return View::make('brand.index',compact('subcategory','brand','dropdown'));
    }

    public function create($id)
    {
        $subcategory = Subcategory::find($id);
        return View::make('brand.create')->with('subcategory',$subcategory);
    }

    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->input('name');
        $brand->subcat_id = $request->input('subcat_id');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $filename = $image->getClientOriginalName();
            $Path = public_path() . '/image/';
            $image->move($Path, $filename);
            $brand->image=$filename;
        }
        $brand->save();

        return Redirect::to('brand/'.$brand->subcat_id);
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        $cartcount = Navbar::cart();
        $dropdown = Navbar::dropdown();

        return View::make('brand.edit',compact('brand','cartcount','dropdown'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->input('name');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $filename = $image->getClientOriginalName();
            $Path = public_path() . '/image/';
            $image->move($Path, $filename);
            $brand->image=$filename;
        }
        $brand->save();

        return Redirect::to('brand/'.$brand->subcat_id);
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return Redirect::to('brand/'.$brand->subcat_id);
    }
}
