<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function response()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('hello response');
    }
    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Gusti')->assertSeeText('Akbar')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'HOFi')
            ->assertHeader('App', 'Belajar Laravel');
    }
    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText("Hello Gusti");
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                "firstName" => 'Gusti',
                "lastName" => "Akbar"
            ]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', "image/png");
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('memories.png');
    }
}
