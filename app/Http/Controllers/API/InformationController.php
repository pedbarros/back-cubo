<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationStoreRequest;
use App\Http\Support\Respond;
use Validator;
use App\Repositories\InformationRepository;

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

    public function store(InformationStoreRequest $request){
        try {
            if($this -> informationRepository->permissionToAddInformation() ){
                return $this->respond->badRequest(["status" => false, "data" => "A porcentagem máxima de participação é 100%."]);
            }

            $information = $this -> informationRepository->create($request->all());

            if ($information) {
                return $this -> respond -> ok(["status" => true, "data" => $information]);
            } else {
                return $this -> respond -> ok(["status" => false, "data" => []]);
            }

        } catch (\Exception $e) {
            return $this -> respond -> badRequest(["status" => false, "data" => "Ocorreu um erro ao salvar a informação. Error" . $e]);
        }
    }


    public function destroy($id){
        try{
            $information = $this -> informationRepository->delete($id);

            if($information){
                return $this->respond->ok(["status" => true, "data" => "Informação deletada com sucesso!"]);
            }

            return $this->respond->ok(["status" => false, "data" => "Não foi possível deletar a informação!"]);

        }catch (\Exception $e){
            return $this->respond->badRequest(["status" => false, "Ocorreu um erro ao deletar a informação. Error" . $e]);
        }
    }
}
