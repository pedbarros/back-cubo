<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
class InformationTest extends TestCase
{

    /*protected $stack;

    protected function setUp()
    {
        $this->stack = [];
    }
*/ 
    protected $token;

    public static function setUpBeforeClass()
    {
      //  $userObj = User::find("5c2a0793aa47b91b224d9a55");
        // $this->token =  $userObj->createToken("5c2a0793aa47b91b224d9a55")->accessToken;
        echo User::all();
    }


    public function testRequiresEmailAndLogin()
    {
        // echo $this->token;
        $userObj = \App\User::find("5c2a0793aa47b91b224d9a55");
        $tokenStr =  $userObj->createToken("5c2a0793aa47b91b224d9a55")->accessToken;
       
        $response = $this->withHeaders(['Authorization' => "Bearer " . $tokenStr])->json('POST', 'api/information');
       
        $response->assertStatus(400)
            ->assertJson([
                'status' => false,
                'data' => 'Você precisa especificar o primeiro nome!',
            ]);
    }


    public function testUnauthorizedGetInformations() 
    {
        $response = $this->json('GET', '/api/information');

        $response->assertStatus(400)
                 ->assertJsonFragment(['status' => false]);

    }


    public function testCanGetInformations() 
    {
        $userObj = \App\User::find("5c2a0793aa47b91b224d9a55");
        $tokenStr = $userObj->createToken("5c2a0793aa47b91b224d9a55")->accessToken;
        $response = $this->withHeaders(['Authorization' => "Bearer " . $tokenStr])->json('GET', '/api/information');

        $response->assertOk()
                 ->assertJsonFragment(['status' => true]);

    }
}
