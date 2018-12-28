<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Support\Respond;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


}
