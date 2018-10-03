<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    protected $baseUrl = 'http://feelthemovies.test/auth';

    public function testAuthenticationSuccess()
    {
        $user = User::find(1);

        if ($user) {
            if (Hash::check('-%O1r2y3c487-%', $user->password)) {
                $this->json('POST', $this->baseUrl, [
                    'email' => 'xorycx@gmail.com',
                    'password' => '-%O1r2y3c487-%',
                ])
                    ->seeJson(['message' => 'success'])
                    ->seeJsonStructure(['message', 'api_token'])
                    ->seeStatusCode(200);
            }
        }
    }

    public function testAuthenticationFail()
    {
        $user = User::find(1);

        if ($user) {
            if (Hash::check('-%O1r2y3c487-%', $user->password)) {
                $this->json('POST', $this->baseUrl, [
                    'email' => 'xorycx@gmail.com',
                    'password' => '123456',
                ])
                    ->seeJson(['message' => 'authentication failed'])
                    ->seeStatusCode(401);
            }
        }
    }

}