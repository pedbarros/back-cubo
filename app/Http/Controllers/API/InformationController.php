<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Support\Respond;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class InformationController extends Controller
{
    private $respond;

    public function __construct(Respond $respond) {
        $this -> respond = $respond;
    }

    public function index(){
        try{
            $information = Information::all();

            if($information){
                return $this->respond->ok($information);
            }

            return $this->respond->ok([]);

        }catch (\Exception $e){
            return $this->respond->badRequest([]);
        }
    }

    public function store(Request $request){
        try {

            /*
                ADD VALIDATION HERE
            */


            $information = Information::create($request->all());

            if ($information) {
                return $this -> respond -> ok(["status" => true, "data" => $information]);
            } else {
                return $this -> respond -> ok(["status" => false, "data" => []]);
            }


        } catch (\Exception $e) {
            return $this -> respond -> badRequest(["status" => false, "data" => "There was a problem saving information. Error" . $e]);
        }
    }
}
