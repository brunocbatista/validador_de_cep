<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /** @test */
    public function name_field_is_required()
    {
        $user = User::factory()->make(['name'=> null])->toArray();
        $this->post(route('register'), $user)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function email_field_is_required()
    {
        $user = User::factory()->make(['email'=> null])->toArray();
        $this->post(route('register'), $user)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function email_field_is_valid()
    {
        $user = User::factory()->make(['email'=> '12313'])->toArray();
        $this->post(route('register'), $user)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function password_field_is_required()
    {
        $user = User::factory()->make(['password'=> null])->toArray();
        $this->post(route('register'), $user)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function it_should_store_in_database()
    {
        $user = User::factory()->make(['password' => 'abc123*'])->makeVisible('password')->toArray();
        $this->post(route('register'), $user)
            ->assertSuccessful();

        unset($user['password']);

        $this->assertDatabaseHas('users', $user);
    }
}
