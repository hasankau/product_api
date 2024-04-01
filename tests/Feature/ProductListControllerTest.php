<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;

class ProductListControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test retrieving all products with their attributes.
     *
     * @return void
     */
    public function testGetProducts()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        // Authenticate the user and get the token
        $token = $user->createToken('authToken')->plainTextToken;

        // Create some products with attributes
        $products = Product::factory()->count(3)->hasAttributes()->create();

        // Make a GET request to the api
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
        ->get('/api/getProducts');
        // Assert the response status
        $response->assertStatus(200);

        // Assert the response content
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'description',
                'image',
                'sellingPrice',
                'created_at',
                'updated_at',
                'attributes' => [
                    '*' => [
                        'id',
                        'attribute_name',
                        'product_id',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]
        ]);

        foreach ($products as $product) {
            $response->assertJsonFragment([
                'id' => $product->id,
                'name' => $product->name,
            ]);
            foreach ($product->attributes as $attribute) {
                $response->assertJsonFragment([
                    'id' => $attribute->id,
                    'attribute_name' => $attribute->attribute_name,
                ]);
            }
        }
    }
}
