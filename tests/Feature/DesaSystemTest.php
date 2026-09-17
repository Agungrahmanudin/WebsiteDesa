<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DesaSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_can_be_accessed(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('DESA CIMEONG');
    }

    public function test_profil_desa_can_be_accessed(): void
    {
        $response = $this->get('/profil');
        $response->assertStatus(200);
        $response->assertSee('Profil Pemerintah Desa Cimeong');
    }

    public function test_layanan_surat_page_can_be_accessed(): void
    {
        $response = $this->get('/layanan-surat');
        $response->assertStatus(200);
        $response->assertSee('Pelayanan Administrasi Surat Desa');
    }

    public function test_login_page_can_be_accessed(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login Admin Desa');
    }

    public function test_admin_dashboard_requires_authentication(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin_test@desa.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_active' => 1,
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Ringkasan Sistem');
    }
}
