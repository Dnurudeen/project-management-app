<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_user_can_create_project()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/projects', [
            'title' => 'Test Project',
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('projects', ['title' => 'Test Project']);
    }
}
