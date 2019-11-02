<?php

use App\Models\Link;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LinkTest extends TestCase
{
    protected $mapping = [
        1 => 1,
        10 => 'a',
        20 => 'k',
        1000 => 'g8',
    ];

    /** @test */
    function correct_code_is_generated()
    {
        $link = new Link;

        foreach ($this->mapping as $id => $code) {
            $link->id = $id;

            $this->assertEquals($link->getCode(), $code);
        }
    }

    /** @test **/
    function an_exception_must_be_thrown_if_no_id()
    {
        $this->expectException(\App\Exceptions\CodeGenerationException::class);

        $link = new Link;

        $link->getCode();
    }

    /** @test */
    function can_fetch_model_by_its_code()
    {
        $link = factory(Link::class)->create([
            'code' => '123456'
        ]);

        $this->assertInstanceOf(Link::class, Link::byCode('123456')->first());

        $this->assertEquals($link->id, Link::byCode('123456')->first()->id);
    }

    /** @test */
    function can_get_shortened_url()
    {
        $link = factory(Link::class)->create([
            'code' => '123',
        ]);

        $this->assertEquals($link->shortenedUrl(), env('APP_URL') . '/123');
    }
}
