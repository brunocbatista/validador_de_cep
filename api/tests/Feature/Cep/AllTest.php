<?php

namespace Tests\Feature\Cep;

use App\Models\Cep;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AllTest extends TestCase
{
    /** @test */
    public function it_should_be_authenticated()
    {
        $this->post(route('cep.all'))
            ->assertRedirect('/api/login');
    }

    /** @test */
    public function it_should_list_all()
    {
        $user = User::factory()->create();

        Cep::factory(10)->create();


        $this->actingAs($user)
            ->get(route('cep.all'))
            ->assertSuccessful();
    }
}
