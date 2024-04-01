<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductListController extends Controller
{
    public function getProducts(){
        //get all products from the db as an stdclass object
        $data = Product::with("attributes")->get();
        //return the search results as a json response
        return response()->json($data);
    }
}
