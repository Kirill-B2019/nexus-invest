<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LkAccessTest extends TestCase
{
    use RefreshDatabase;

    private function grantLkAccess(User $user): void
    {
        $permission = Permission::firstOrCreate([
            'name' => 'access-lk',
            'guard_name' => 'web',
        ]);
        $user->givePermissionTo($permission);
    }

    public function test_lk_home_requires_authentication(): void
    {
        $response = $this->get('/lk');

        $response->assertRedirect(route('login'));
    }

    public function test_verified_user_with_access_lk_can_open_lk(): void
    {
        $user = User::factory()->create();
        $this->grantLkAccess($user);

        $response = $this->actingAs($user)->get('/lk');

        $response->assertOk();
    }

    public function test_user_without_access_lk_is_redirected_from_lk(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/lk');

        $response->assertRedirect(route('welcome'));
        $response->assertSessionHas('info');
    }
}
