<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function CheckToken($request){

        $authorization = $request->header('Authorization');
        $token = null;
        if (substr($authorization, 0, 7) === "Bearer ") {
            $token = substr($authorization, 7);
        }     

        if ($token === null) {
            return abort(403);
        }
    }

}
