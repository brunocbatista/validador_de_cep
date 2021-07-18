<?php

namespace Tests\Feature\CepValidator;

use App\Services\CepValidatorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidatorTest extends TestCase
{
    /** @test */
    public function value_must_be_greater_than_100000()
    {
        $this->assertFalse(CepValidatorService::validator('99999'));

    }

    /** @test */
    public function value_must_be_less_than_999999()
    {
        $this->assertFalse(CepValidatorService::validator('1000000'));
    }

    /** @test */
    public function value_cannot_count_repeated_alternate_numbers_in_pairs()
    {
        $this->assertFalse(CepValidatorService::validator('121426'));
    }
}
