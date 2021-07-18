<?php

namespace Tests\Feature\Cep;

use App\Models\Cep;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreTest extends TestCase
{
    /** @test */
    public function value_field_is_required()
    {
        $user = User::factory()->create();
        $cep = Cep::factory()->make(['value'=> null])->toArray();

        $this->actingAs($user)
            ->post(route('cep.store'), $cep)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function value_field_is_valid()
    {
        $user = User::factory()->create();
        $cep = Cep::factory()->make(['value'=> '12ABC13'])->toArray();

        $this->actingAs($user)
            ->post(route('cep.store'), $cep)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function city_field_is_required()
    {
        $user = User::factory()->create();
        $cep = Cep::factory()->make(['city'=> null])->toArray();

        $this->actingAs($user)
            ->post(route('cep.store'), $cep)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function state_field_is_required()
    {
        $user = User::factory()->create();
        $cep = Cep::factory()->make(['state'=> null])->toArray();

        $this->actingAs($user)
            ->post(route('cep.store'), $cep)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function state_field_is_valid()
    {
        $user = User::factory()->create();
        $cep = Cep::factory()->make(['state'=> 'Paraná'])->toArray();

        $this->actingAs($user)
            ->post(route('cep.store'), $cep)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function it_should_be_authenticated()
    {
        $cep = Cep::factory()->make()->toArray();

        $this->post(route('cep.store'), $cep)
            ->assertRedirect('/api/login');
    }

    /** @test */
    public function it_should_contain_a_valid_value_field()
    {
        $user = User::factory()->create();
        $cep = Cep::factory()->make(['value'=> '100000'])->toArray();

        $this->actingAs($user)
            ->post(route('cep.store'), $cep)
            ->assertForbidden();
    }

    /** @test */
    public function it_should_store_in_database()
    {
        $user = User::factory()->create();
        $cep = Cep::factory()->make()->toArray();


        $this->actingAs($user)
            ->post(route('cep.store'), $cep)
            ->assertSuccessful();

        $this->assertDatabaseHas('ceps', $cep);
    }
}
