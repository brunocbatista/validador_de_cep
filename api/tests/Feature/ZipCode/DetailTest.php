<?php

namespace Tests\Feature\ZipCode;

use App\Models\ZipCode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DetailTest extends TestCase
{
    /** @test */
    public function it_should_not_be_authenticated()
    {
        $zip_code = ZipCode::factory()->create();

        $this->get(route('zip-code.details', $zip_code->value))
            ->assertSuccessful();
    }

    /** @test */
    public function it_should_contain_a_valid_value_field()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('zip-code.details', '100000'))
            ->assertForbidden();
    }

    /** @test */
    public function it_should_detail()
    {
        $user = User::factory()->create();
        $zip_code = ZipCode::factory()->create();

        $this->actingAs($user)
            ->get(route('zip-code.details', $zip_code->value))
            ->assertSuccessful();
    }
}
