<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Support\Respond;
use Validator;
use App\Repositories\InformationRepository;
use Illuminate\Http\Request;

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
                return $this->respond->ok(["status" => true, "data" => $information]);
            }

            return $this->respond->ok(["status" => false, "data" => []]);

        }catch (\Exception $e){
            return $this->respond->badRequest(["status" => false, "data" => []]);
        }
    }

    public function store(Request $request){
        try {

            $rules = [
                'firstName' => 'required',
                'lastName' => 'required',
                'participation' => 'required',
            ];

            $messages =  [
                'firstName.required' => 'Você precisa especificar o primeiro nome!',
                'lastName.required' => 'Você precisa especificar o ultimo nome!',
                'participation.required' => 'Você precisa especificar a participação!',
            ];

            $errors = Validator::make($request->all(), $rules, $messages)->errors();

            foreach ($errors->all() as $message) {
                return $this->respond->badRequest(["status" => false, "data" => $message]);
            }

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
