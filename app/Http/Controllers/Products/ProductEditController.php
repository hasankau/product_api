<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Traits\Attributes;

class ProductEditController extends Controller
{

    use Attributes;
    public function editProduct(Request $request)
    {
        //validate the request parameters
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category' => 'required|string',
            'code' => 'required|string',
            'description' => 'nullable|string',
            'sellingPrice' => 'required|numeric|min:0',
            'attributes' => 'nullable|array',
            'status' => 'required|string',
            'isDeliveryAvailable' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        // Return response if  request validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        //assign params to variables
        $productId = $request->id;
        $productName = $request->name;
        $productCode = $request->code;
        $productCategory = $request->category;
        $productDescription = $request->description;
        $productSellingPrice = $request->sellingPrice;
        $productSpecialPrice = $request->specialPrice?$request->specialPrice:0;
        $productStatus = $request->status;
        $isDeliveryAvailable = $request->isDeliveryAvailable?$request->isDeliveryAvailable:0;
        $imagePath = "";

        try {

            //find the product from id
            $product = Product::find($productId);

            if (!$product) {
                // Return the response if the product does not exist
                return response()->json(['error' => 'Product not found'], 404);
            }

            
            //check if a product image is uploaded
            //create product_images directory if already not created
            //check if an image was uploaded before
            //delete exisiting image
            //move upladed file to folder 
            if ($request->has("image")) {
                Storage::makeDirectory('public/product_images');
                if ($product->image && Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }
                $imagePath = $request->file('image')->store('public/product_images');
                $imagePath = str_replace('public/', '', $imagePath);
            }

            //assign new values
            $product->name = $productName;
            $product->code = $productCode;
            $product->category = $productCategory;
            $product->description = $productDescription; 
            $product->image = $imagePath;
            $product->sellingPrice = $productSellingPrice;
            $product->specialPrice = $productSpecialPrice;
            $product->status = $productStatus;
            $product->isDeliveryAvailable = $isDeliveryAvailable;

            if ($product->save()) {
                //delete existing attributes
                $this->deleteAttributes($product->id);

                $attributes = $request->post('attributes');
                //save attributes if attributes added
                if (!empty($attributes)) {
                    $this->addAttributes($product->id, $attributes);
                }
                // Return the response when success with the updated product
                return response()->json(['message' => 'Product updated successfully', 'product' => $product], 201);
            }

            // Return the response if the save failed
            return response()->json(['error' => 'Unexpected error occured'], 500);

        } catch (\Throwable $th) {
            // Return the response if an unexpexted error
            return $th;
        }

    }
}
