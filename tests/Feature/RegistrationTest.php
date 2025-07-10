<?php

// tests/Feature/RegistrationTest.php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Mail\NewUserRegistered;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_displayed()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee(__('messages.registration_form'));
    }

    public function test_username_availability_check()
    {
        User::factory()->create(['user_name' => 'existinguser']);
        
        $response = $this->get('/check-username?username=existinguser');
        $response->assertJson(['exists' => true]);
        
        $response = $this->get('/check-username?username=nonexistinguser');
        $response->assertJson(['exists' => false]);
    }

    public function test_user_can_register()
    {
        Mail::fake();
        Storage::fake('public');
        
        $file = UploadedFile::fake()->image('profile.jpg');
        
        $response = $this->post('/register', [
            'full_name' => 'Test User',
            'user_name' => 'testuser',
            'email' => 'test@example.com',
            'phone_number' => '1234567890',
            'whatsapp_number' => '1234567890',
            'address' => '123 Test St',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
            'profile_picture' => $file
        ]);
        
        $response->assertRedirect();
        $response->assertSessionHas('success', __('messages.registration_success'));
        
        $this->assertDatabaseHas('users', [
            'user_name' => 'testuser',
            'email' => 'test@example.com'
        ]);
        
        Mail::assertSent(NewUserRegistered::class);
    }

    public function test_validation_works()
    {
        $response = $this->post('/register', [
            'full_name' => '',
            'user_name' => '',
            'email' => 'invalid',
            'phone_number' => '123',
            'whatsapp_number' => '123',
            'address' => '',
            'password' => 'weak',
            'password_confirmation' => 'mismatch',
            'profile_picture' => ''
        ]);
        
        $response->assertSessionHasErrors([
            'full_name', 'user_name', 'email', 'phone_number', 
            'whatsapp_number', 'address', 'password', 'profile_picture'
        ]);
    }

    public function test_password_encryption()
    {
        $password = 'Password1!';
        $user = User::factory()->create(['password' => bcrypt($password)]);
        
        $this->assertNotEquals($password, $user->password);
        $this->assertTrue(password_verify($password, $user->password));
    }
}

?>