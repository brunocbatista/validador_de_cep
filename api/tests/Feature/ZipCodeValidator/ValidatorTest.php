<?php

namespace Tests\Feature\ZipCodeValidator;

use App\Services\ZipCodeValidatorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidatorTest extends TestCase
{
    /** @test */
    public function value_must_be_greater_than_100000()
    {
        $this->assertFalse(ZipCodeValidatorService::validator('99999'));

    }

    /** @test */
    public function value_must_be_less_than_999999()
    {
        $this->assertFalse(ZipCodeValidatorService::validator('1000000'));
    }

    /** @test */
    public function value_cannot_count_repeated_alternate_numbers_in_pairs()
    {
        $this->assertFalse(ZipCodeValidatorService::validator('121426'));
    }
}
