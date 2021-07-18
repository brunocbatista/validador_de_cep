<?php

namespace Tests\Feature\ZipCode;

use App\Models\ZipCode;
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
        $zip_code = ZipCode::factory()->make(['value'=> null])->toArray();

        $this->actingAs($user)
            ->post(route('zip-code.store'), $zip_code)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function value_field_is_valid()
    {
        $user = User::factory()->create();
        $zip_code = ZipCode::factory()->make(['value'=> '12ABC13'])->toArray();

        $this->actingAs($user)
            ->post(route('zip-code.store'), $zip_code)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function city_field_is_required()
    {
        $user = User::factory()->create();
        $zip_code = ZipCode::factory()->make(['city'=> null])->toArray();

        $this->actingAs($user)
            ->post(route('zip-code.store'), $zip_code)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function state_field_is_required()
    {
        $user = User::factory()->create();
        $zip_code = ZipCode::factory()->make(['state'=> null])->toArray();

        $this->actingAs($user)
            ->post(route('zip-code.store'), $zip_code)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function state_field_is_valid()
    {
        $user = User::factory()->create();
        $zip_code = ZipCode::factory()->make(['state'=> 'Paraná'])->toArray();

        $this->actingAs($user)
            ->post(route('zip-code.store'), $zip_code)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function it_should_be_authenticated()
    {
        $zip_code = ZipCode::factory()->make()->toArray();

        $this->post(route('zip-code.store'), $zip_code)
            ->assertRedirect('/api/login');
    }

    /** @test */
    public function it_should_contain_a_valid_value_field()
    {
        $user = User::factory()->create();
        $zip_code = ZipCode::factory()->make(['value'=> '100000'])->toArray();

        $this->actingAs($user)
            ->post(route('zip-code.store'), $zip_code)
            ->assertForbidden();
    }

    /** @test */
    public function it_should_store_in_database()
    {
        $user = User::factory()->create();
        $zip_code = ZipCode::factory()->make()->toArray();


        $this->actingAs($user)
            ->post(route('zip-code.store'), $zip_code)
            ->assertSuccessful();

        $this->assertDatabaseHas('zip_codes', $zip_code);
    }
}
