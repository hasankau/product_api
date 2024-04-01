<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Traits\Attributes;

class ProductDeleteController extends Controller
{
    use Attributes;

    public function deleteProduct(Request $request)
    {

        //validate the request parameters
        $validator = Validator::make($request->all(), [
            'id' => 'required|string'
        ]);

        // Return response if  request validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        //assign params to variables
        $productId = $request->id;

        try {

            //find the product from id
            $product = Product::find($productId);

            if (!$product) {
                // Return the response if the product does not exist
                return response()->json(['error' => 'Product not found'], 404);
            }

            //check if an image was uploaded before
            //delete exisiting image
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete("public/".$product->image);
            }


            if ($product->delete()) {
                $this->deleteAttributes($product->id);
                // Return the response when success with the deleted product
                return response()->json(['message' => 'Product deleted successfully'], 201);
            }

            // Return the response if the save failed
            return response()->json(['error' => 'Unexpected error occured'], 500);

        } catch (\Throwable $th) {
            // Return the response if an unexpexted error
            return response()->json(['error' => 'Unexpected error occured'], 500);
        }

    }
}
