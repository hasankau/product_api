<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProductCreateControllerTest extends TestCase
{
    /**
     * Test creating a product.
     *
     * @return void
     */
    public function testCreateProduct()
    {

        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        // Authenticate the user and get the token
        $token = $user->createToken('authToken')->plainTextToken;

        // Prepare request data
        $requestData = [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'sellingPrice' => 1500.00,
            'code' => 'ABC123',
            'category' => 'Test Category',
            'image' => UploadedFile::fake()->image('product_image.jpg'),
            'attributes' => json_encode(['1' => 'value1', '2' => 'value2']),
            'status' => 'draft',
            'isDeliveryAvailable' => true,
        ];

        Storage::fake('product_images');

        // Make a POST request to create the product
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->post('/api/createProduct', $requestData);

        // Assert the expected response status messsage and object
        $response->assertStatus(201);
        $response->assertJson(['message' => 'Product created successfully']);
        $response->assertJsonStructure([
            'product' => [
                'id',
                'name',
                'description',
                'image',
                'sellingPrice',
                'created_at',
                'updated_at'
            ]
        ]);

        // Assert the product image was stored in the storage
        Storage::disk()->assertExists($response->json('product.image'));
    }
}
