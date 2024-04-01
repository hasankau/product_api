<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductShowController extends Controller
{
    public function getProduct($id){
        //get all products from the db as an stdclass object
        $product = Product::with("attributes")->where("id", $id)->get();
        //return the search results as a json response

        if(!$product){
            // Return the response if the product does not exist
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Return the response if the product exists
        return response()->json($product);
    }
}
