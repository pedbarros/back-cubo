<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Support\Respond;
use App\Models\Information;
use App\Repositories\InformationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class InformationController extends Controller
{
    private $respond;
    private $informationRepository;

    public function __construct(Respond $respond, InformationRepository $informationRepository) {
        $this -> respond = $respond;
        $this -> informationRepository = $informationRepository;
    }

    public function index(){
        try{
            $information = $this -> informationRepository->getAll();

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


            $information = $this -> informationRepository->create($request->all());

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
