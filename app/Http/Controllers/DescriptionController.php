<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDescription;
use Redirect;

class DescriptionController extends Controller
{
    public function store(Request $request)
    {
        $product = new ProductDescription;

        $product->description = $request->input('description');
        $product->product_id = $request->input('product_id');
        $product->save();

        return Redirect::to('showproduct/'.$product->product_id);
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        
    }
}
