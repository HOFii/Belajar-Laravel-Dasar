<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{

    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Gusti');

        $this->get('/hello-again')
            ->assertSeeText('Hello Gusti');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Gusti');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Gusti'])
            ->assertSeeText('Hello Gusti');

        $this->view('hello.world', ['name' => 'Gusti'])
            ->assertSeeText('World Gusti');
    }
}
