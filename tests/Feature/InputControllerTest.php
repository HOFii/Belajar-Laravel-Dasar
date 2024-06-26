<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Gusti')
            ->assertSeeText('Hello Gusti');

        $this->post('/input/hello', [
            'name' => 'Gusti'
        ])->assertSeeText('Hello Gusti');
    }
    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Gusti",
                "last" => "Akbar"
            ]
        ])->assertSeeText("Hello Gusti");
    }
    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Gusti",
                "last" => "Akbar"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Gusti")
            ->assertSeeText("Akbar");
    }
    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 30000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Galaxy S10");
    }
    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Elaina',
            'married' => 'true',
            'birth_date' => '2007-07-07'
        ])->assertSeeText('Elaina')->assertSeeText("true")->assertSeeText("2007-07-07");
    }
    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Gusti",
                "middle" => "Alifiraqsha",
                "last" => "Akbar"
            ]
        ])->assertSeeText("Gusti")->assertSeeText("Akbar")
            ->assertDontSeeText("Alifiraqsha");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "akbar",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("akbar")->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }
    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "akbar",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("akbar")->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false");
    }
}
