<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;

class ProductShowControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test retrieving a products with their attributes.
     *
     * @return void
     */
    public function testGetProduct()
    {

        $product = Product::factory()->create();

        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        // Authenticate the user and get the token
        $token = $user->createToken('authToken')->plainTextToken;

        // Make a GET request to the api
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
        ->get('/api/getProduct/'.$product->id);
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


    }
}
