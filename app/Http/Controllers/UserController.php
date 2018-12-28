<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Support\Respond;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Repositories\InformationRepository;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    private $respond;
    private $informationRepository;

    public function __construct(Respond $respond, InformationRepository $informationRepository)
    {
        $this->respond = $respond;
        $this->informationRepository = $informationRepository;
    }

    public function login(Request $request)
    {
        /*
         ADD VALIDATION HERE
         */


        try {
            if (!auth()->attempt(['email' => $request->get('email'),
                                 'password' => $request->get('password')],
                        false)) {
                return $this->respond->ok(["N TA CERTO"]);
            }
        } catch (\Exception $e) {
            return $this->respond->ok([$e]);
        }


        $user = Auth::user();
        dd($user);
        // $token = $this->jwtAuth->fromUser($user);

        // return response()->json(compact('access', 'token', 'user'));
    }


    public function register(Request $request)
    {
        try {
            $user = User::create(['name' => "Pedro", 'email' => "pedro@pedro.com", 'password' => "123"]);
            $user->token = $user->createToken($user->_id)->accessToken;


            if ($user) {
                return $this->respond->ok($user);
            }

            return $this->respond->ok([]);

        } catch (\Exception $e) {
            return $this->respond->badRequest([]);
        }
    }


}
