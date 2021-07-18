<?php

namespace Tests\Feature\ZipCode;

use App\Models\ZipCode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AllTest extends TestCase
{
    /** @test */
    public function it_should_be_authenticated()
    {
        $this->post(route('zip-code.all'))
            ->assertRedirect('/api/login');
    }

    /** @test */
    public function it_should_list_all()
    {
        $user = User::factory()->create();

        ZipCode::factory(10)->create();


        $this->actingAs($user)
            ->get(route('zip-code.all'))
            ->assertSuccessful();
    }
}
