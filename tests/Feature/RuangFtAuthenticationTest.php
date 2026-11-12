<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RuangFtAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_book_list_and_login_page(): void
    {
        $this->get(route('buku.index'))->assertOk();
        $this->get(route('login'))->assertOk();
    }

    public function test_guest_is_redirected_to_login_before_creating_or_editing_books(): void
    {
        $this->get(route('buku.create'))->assertRedirect(route('login'));
        $this->post(route('buku.store'), [])->assertRedirect(route('login'));
        $this->put('/buku/1', [])->assertRedirect(route('login'));
        $this->delete('/buku/1')->assertRedirect(route('login'));
    }

    public function test_user_can_login_and_logout(): void
    {
        $password = 'SandiTes123!';
        $user = User::factory()->create(['password' => Hash::make($password)]);

        $this->post(route('login.authenticate'), [
            'email' => $user->email,
            'password' => $password,
        ])->assertRedirect(route('buku.index'));

        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))
            ->assertRedirect(route('buku.index'));

        $this->assertGuest();
    }

    public function test_wrong_password_does_not_log_user_in(): void
    {
        $user = User::factory()->create();

        $this->post(route('login.authenticate'), [
            'email' => $user->email,
            'password' => 'TidakBenar123!',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_user_can_open_add_book_page(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('buku.create'))
            ->assertOk();
    }
}
