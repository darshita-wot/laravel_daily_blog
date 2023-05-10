<?php
use Pest\Support\Str;

// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Support\Facades\Log;
// use Tests\TestCase;

// class UserRegistrationTest extends TestCase
// {
//     /**
//      * A basic feature test example.
//      */
//     use  WithFaker;

// public function test_user_can_register()
// {
//     $response = $this->post('/registration', [
//         'fullname' => $this->faker->name,
//         'email' => $this->faker->unique()->safeEmail,
//         'password' => 'password',
//         'password_confirmation' => 'password',
//         'mobile_no' => '1523596384',
//         'birthday_date' => '2023-04-06',
//         'profile_photo' => ''
//     ]);
//     Log::info('response',[$response]);
//     $response->assertStatus(200);
// }
// }

it('has login page')->get('/login')->assertStatus(200);

it('user registration')->post('/registration', [
    'fullname' => fake()->name,
    'email' => fake()->unique()->safeEmail,
    'password' => 'password',
    'password_confirmation' => 'password',
    'mobile_no' => Str::random(10),
    'birthday_date' => '2023-04-06',
    'profile_photo' => ''
])->assertStatus(200);

it('has login user', function () {

    $response = $this->postJson('/login', [
        'username' => 'admin@gmail.com',
        'password' => 'admin@123'
    ]);

    $response->assertStatus(200);

    $response->assertJson([
        'status' => 'success'
    ]);
});

it('has invalid credentials ', function () {
    $response = $this->postJson('/login', [
        'username' => 'admin@gmail.com',
        'password' => 'adminnnnnnn@123'
    ]);

    $response->assertStatus(401);

    $response->assertJson([
        'status' => 'invalid',
        'data' => 'Invalid login credentials'
    ]);
});

it('forgot password', function () {
    $response = $this->postJson('/forgotpassword', [
        'email' => 'krishna@gmail.com',
    ]);

    $response->assertStatus(200);

    $response->assertJson(['status' => 'success', 'data' => 'Please check your mail to reset your password']);
});

it('has not correcr email for forgot password', function () {
    $response = $this->postJson('/forgotpassword', [
        'email' => 'hdfjsad@gmail.com',
    ]);

    $response->assertStatus(404);

    $response->assertJson(['status' => 'error', 'data' => "Email doesn't exists"]);
});
