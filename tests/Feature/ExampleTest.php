<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function the_application_root_path_redirects_unauthenticated_user_to_login(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function the_application_root_path_redirects_authenticated_user_to_tickets_route(): void
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user)->get('/');

        $response->assertRedirect(route('tickets.index'));
    }
}
