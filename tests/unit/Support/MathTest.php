<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MathTest extends TestCase
{
    protected $mapping = [
        1 => 1,
        10 => 'a',
        20 => 'k',
        1000 => 'g8',
    ];

    /** @test */
    function it_can_encode_values()
    {
        $math = new \App\Support\Math;

        foreach ($this->mapping as $value => $encoded) {
            $this->assertEquals($encoded, $math->toBase($value));
        }
    }
}
