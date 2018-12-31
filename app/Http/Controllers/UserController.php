<?php

namespace App\Http\Controllers;

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
                'password' => $request->get('password')], false)) {
                return $this->respond->badRequest(["status" => false, "data" => $e]);
            }
        } catch (\Exception $e) {
            return $this->respond->badRequest(["status" => false, "data" => $e]);
        }


        $user = Auth::user();
        $user->token =  $user->createToken($user->_id)-> accessToken;

        return $this->respond->ok(["status" => true, "data" => $user]);
    }


    public function register(Request $request)
    {
        try {
            $user = User::create($request->all());
            $user->token = $user->createToken($user->_id)->accessToken;


            if ($user) {
                return $this->respond->ok(["status" => true, "data" => $user]);
            }

            return $this->respond->ok(["status" => false, "data" => []]);

        } catch (\Exception $e) {
            return $this->respond->badRequest(["status" => false, "data" => $e]);
        }
    }


}
