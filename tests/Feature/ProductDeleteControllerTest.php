<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class ProductDeleteControllerTest extends TestCase
{
    /**
     * Test creating a product.
     *
     * @return void
     */
    public function testDeleteProduct()
    {

        $product = Product::factory()->create();

        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        // Authenticate the user and get the token
        $token = $user->createToken('authToken')->plainTextToken;

        // Prepare request data
        $requestData = [
            'id' => $product->id,
        ];

        Storage::fake('product_images');

        // Make a POST request to create the product
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
        ->post('/api/deleteProduct', $requestData);

        // Assert the expected response status messsage
        $response->assertStatus(201);
        $response->assertJson(['message' => 'Product deleted successfully']);

    }
}
