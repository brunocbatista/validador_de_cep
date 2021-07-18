<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function email_field_is_required()
    {
        $user = User::factory()->make(['email'=> null])->toArray();
        $this->post(route('login'), $user)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function email_field_is_valid()
    {
        $user = User::factory()->make(['email'=> '123123'])->toArray();
        $this->post(route('login'), $user)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function password_field_is_required()
    {
        $user = User::factory()->make(['password'=> null])->toArray();
        $this->post(route('login'), $user)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function user_can_be_authenticated()
    {
        $user = User::factory()->create()->toArray();
        $user['password'] = 'password';
        $this->post(route('login'), $user)
                ->assertSuccessful();
    }

    /** @test */
    public function user_must_enter_valid_credentials()
    {
        $user = User::factory()->create()->toArray();
        $user['password'] = 'abc123*';
        $this->post(route('login'), $user)
            ->assertForbidden();
    }
}
