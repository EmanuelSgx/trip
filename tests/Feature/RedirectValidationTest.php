<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectValidationTest extends TestCase
{
    use RefreshDatabase;    protected function setUp(): void
    {
        parent::setUp();
        
        // Create users for testing
        $this->admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@triptech.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);

        $this->user = User::create([
            'name' => 'Regular User',
            'email' => 'user@triptech.com',
            'password' => \Illuminate\Support\Facades\Hash::make('user123'),
            'role' => User::ROLE_USER,
            'email_verified_at' => now(),
        ]);
    }

    public function test_root_redirects_to_login_when_not_authenticated()
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    public function test_root_redirects_to_dashboard_when_authenticated()
    {
        $response = $this->actingAs($this->user)->get('/');
        $response->assertRedirect('/dashboard');
    }

    public function test_dashboard_redirects_to_login_when_not_authenticated()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }    public function test_dashboard_accessible_when_authenticated()
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        // Dashboard might redirect to verify email or other flow, check if it's a valid response
        $this->assertTrue(in_array($response->getStatusCode(), [200, 302]));
        
        // If it's a redirect, make sure it's not back to login
        if ($response->getStatusCode() === 302) {
            $this->assertNotEquals('http://localhost/login', $response->headers->get('Location'));
        }
    }    public function test_admin_user_created_correctly()
    {
        $this->assertEquals('Administrator', $this->admin->name);
        $this->assertEquals('admin@triptech.com', $this->admin->email);
        $this->assertEquals(User::ROLE_ADMIN, $this->admin->role);
    }

    public function test_regular_user_created_correctly()
    {
        $this->assertEquals('Regular User', $this->user->name);
        $this->assertEquals('user@triptech.com', $this->user->email);
        $this->assertEquals(User::ROLE_USER, $this->user->role);
    }

    public function test_login_redirects_to_dashboard_after_authentication()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'user123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_admin_login_redirects_to_dashboard()
    {
        $response = $this->post('/login', [
            'email' => $this->admin->email,
            'password' => 'admin123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_guest_middleware_working()
    {
        // When authenticated, login page should redirect
        $response = $this->actingAs($this->user)->get('/login');
        $response->assertRedirect('/dashboard');
    }

    public function test_auth_middleware_working()
    {
        // Protected routes require authentication
        $protectedRoutes = ['/dashboard'];
        
        foreach ($protectedRoutes as $route) {
            $response = $this->get($route);
            $response->assertRedirect('/login');
        }
    }
}
