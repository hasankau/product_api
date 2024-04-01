<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Traits\Attributes;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductCreateController extends Controller
{

    use Attributes;

    public function createProduct(Request $request)
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

            //check if a product image is uploaded
            //create product_images directory if already not created
            //move upladed file to folder and 
            if ($request->has("image")) {
                Storage::makeDirectory('public/product_images');
                $imagePath = $request->file('image')->store('public/product_images');
                $imagePath = str_replace('public/', '', $imagePath);
            }

            // Create new product object
            $product = new Product;
            // assign values to new product
            $product->name = $productName;
            $product->code = $productCode;
            $product->category = $productCategory;
            $product->description = $productDescription; 
            $product->image = $imagePath;
            $product->sellingPrice = $productSellingPrice;
            $product->specialPrice = $productSpecialPrice;
            $product->status = $productStatus;
            $product->isDeliveryAvailable = $isDeliveryAvailable;

            //save the product in the database
            if ($product->save()) {
                //parse attributes from json
                $attributes = $request->post('attributes');
                //save attributes if attributes added
                if (!empty($attributes)) {
                    $this->addAttributes($product->id, $attributes);
                }
                // Return the response when success with the created product
                return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
            }

            // Return the response if the save failed
            return response()->json(['error' => 'Unexpected error occured'], 500);

        } catch (\Throwable $th) {
            // Return the response if an unexpexted error
            return response()->json(['error' => 'Unexpected error occured'], 500);
        }

    }
}


