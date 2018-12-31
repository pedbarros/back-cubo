<?php

namespace App\Http\Middleware;

use App\Http\Support\Respond;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate extends Middleware
{
    private $respond;

   public function __construct(Auth $auth, Respond $respond)
   {
       parent::__construct($auth);
       $this->respond = $respond;
   }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        return $this->respond->unauthorized([ "status" => false ]);
    }
}
