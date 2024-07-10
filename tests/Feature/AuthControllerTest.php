<?php

namespace Tests\Feature;

use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    //  use RefreshDatabase;

    public function testSignUpWithValidData(): void
    {
        // Simulate a request with necessary parameters
        $request = new UserRequest([
            'name' => 'Test User',
            'email' => 'testuser@gmail.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234'
        ]);

        // Call the controller method
        $response = $this->post('/user/signup', $request->all());

        // Assert response status and structure
        $response->assertStatus(200)
        ->assertJsonStructure([
            "success", "status_code", "message", "data"
        ]);
    }

    public function testSignUpWithInValidData(): void
    {
        // Simulate a request with necessary parameters
        $request = new UserRequest([
            'name' => ' ',
            'email' => 'testuser',
            'password' => 'test',
            'password_confirmation' => '1234'
        ]);

        // Call the controller method
        $response = $this->post('/user/signup', $request->all());

        // Assert response status and structure
        $response->assertStatus(422)
        ->assertJsonStructure([
            "success", "status_code", "message", "data"
        ]);
    }
}