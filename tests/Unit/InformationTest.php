<?php

namespace Tests\Unit;

use Tests\TestCase;

class InformationTest extends TestCase
{
    public function testCanGetInformations() {
        $token = "";
        $response = $this->json('GET', '/api/information', ['Authorization' => 'Bearer ' . $token]);

        $response->assertOk()
                 ->assertJsonFragment(['status' => true]);

    }
}
