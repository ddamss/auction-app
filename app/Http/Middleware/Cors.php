<?php

namespace App\Http\Middleware;

use Closure;


class Cors {    

    public function handle($request, Closure $next)
    {
        //ALLOW OPTIONS METHOD
        return $next ($request)
            ->header('Access-Control-Allow-Origin',"*")
            ->header('Access-Control-Allow-Methods', "POST,GET,OPTIONS,PUT,DELETE")
            ->header('Access-Control-Allow-Headers',"Accept,Authorization,Content-Type,X-Auth-Token, Origin,X-Requested-With, Application");
            // , , 

    }
}