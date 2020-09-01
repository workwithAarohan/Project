<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Navbar;
use App\Subcategory;
use App\Brand;
use App\Product;
use App\Cart;
use App\Review;
use App\User;
use App\ProductDescription;
use Auth;
use View;
use Redirect;

class ProductController extends Controller
{
    //
    
    public function index($id)
    {
        $brand = Brand::find($id);
        $product = Product::where('brand_id',$id)->get();
        foreach($product as $value)
        {
            $value->price = number_format(($value->price),2);
        }
        $product->count = Product::where('brand_id',$id)->count();
        $dropdown = Navbar::dropdown();

        return View::make('product.index',compact('brand','product','cartcount','dropdown'));
    }

    public function allbrands($id)
    {
        $subcategory = Subcategory::find($id);
        $brands = Brand::where('subcat_id',$id)->get();
        foreach($brands as $brand)
        {
            $products = Product::where('brand_id',$brand->id)->get();
            $brand->products = $products;
        }

        $dropdown = Navbar::dropdown();

        return view('index',compact('subcategory','brands','dropdown'));
    }

    public function create()
    {

    } 

    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->brand_id = $request->input('brand_id');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $filename = $image->getClientOriginalName();
            $Path = public_path() . '/image/';
            $image->move($Path, $filename);
            $product->image=$filename;
        }
        $product->save();

        return Redirect::to('product/'.$product->brand_id);
    }

    public function storereview(Request $request)
    {
        $review = new Review;
        
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->user_id = $request->input('user_id');
        $review->product_id = $request->input('product_id');
        
        $review->save();

        return Redirect::to('showproduct/'.$review->product_id);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        foreach($product as $value)
        {  
            $description = ProductDescription::where('product_id',$id)->get();
            $product->description = $description;
        }
        $dropdown = Navbar::dropdown();
        return View::make('product.edit',compact('product','dropdown'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $filename = $image->getClientOriginalName();
            $Path = public_path() . '/image/';
            $image->move($Path, $filename);
            $product->image=$filename;
        }
        $product->save();

        return Redirect::to('product/'.$product->brand_id);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $product->price = number_format(($product->price),2);

        $brand = Brand::find($product->brand_id);

        $description = ProductDescription::where('product_id',$id)->get();
        $description->count = ProductDescription::where('product_id',$id)->count();

        $review = Review::where('product_id',$id)->orderBy('id','DESC')->get();
        $review->count = Review::where('product_id',$id)->count('id');

        if($review->count !=0)
        {
            $review->ratingcount = intval((Review::where('product_id',$id)->sum('rating'))/$review->count);
        }
        

        foreach($review as $value)
        {
            $user = User::where('id',$value->user_id)->get();
            $value->user = $user;
        }

        

        $dropdown = Navbar::dropdown();

        return View::make('product.show',compact('product','description','brand','cartcount','dropdown','review'));
    }

    

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return Redirect::to('product/'.$product->brand_id);
    }
}
