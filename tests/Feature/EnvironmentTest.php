<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iluminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
            $magang = env('MAGANG');

            self::assertEquals('Gusti Alifiraqsha Akbar', $magang);
    }

    public function testDefaultEnv()
    {
        $author = Env('AUTHOR', 'Gusti');

        self::assertEquals('Gusti', $author);
    }
}
