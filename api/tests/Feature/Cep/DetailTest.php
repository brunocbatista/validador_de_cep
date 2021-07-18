<?php

namespace Tests\Feature\Cep;

use App\Models\Cep;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DetailTest extends TestCase
{
    /** @test */
    public function it_should_be_authenticated()
    {
        $this->get(route('cep.details', '100000'))
            ->assertRedirect('/api/login');
    }

    /** @test */
    public function it_should_contain_a_valid_value_field()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('cep.details', '100000'))
            ->assertForbidden();
    }

    /** @test */
    public function it_should_detail()
    {
        $user = User::factory()->create();
        $cep = Cep::factory()->create();

        $this->actingAs($user)
            ->get(route('cep.details', $cep->value))
            ->assertSuccessful();
    }
}
