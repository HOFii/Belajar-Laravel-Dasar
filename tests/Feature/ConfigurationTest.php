<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('Gusti', $firstName);
        self::assertEquals('Akabr', $lastName);
        self::assertEquals('echo.alifiraqsha@gmail.com', $email);
        self::assertEquals('https://github.com/', $web);
    }
}
