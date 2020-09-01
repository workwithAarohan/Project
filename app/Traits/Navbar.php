<?php

    namespace App\Traits;

    use App\Category;
    use App\Subcategory;
    use App\Brand;
    use App\Cart;
    use Auth;

    trait Navbar
    {
        public static function cart()
        {
            $cart = Cart::where('user_id',Auth::user()->id)->sum('quantity');

            return $cart;
        }

        public static function dropdown()
        {
            $category = Category::all();
            
            foreach($category as $value)
            {
                $subcategories = Subcategory::where('cat_id',$value->id)->get();
                $value->subcategories = $subcategories;
                foreach($subcategories as $values)
                {
                    $brands = Brand::where('subcat_id',$values->id)->get();
                    $values->brands = $brands;
                }
            }

            return $category;
        }
    }

