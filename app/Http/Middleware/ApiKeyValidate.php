<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return response()->json([
        //     'status'=>402,
        //     'mensaje'=> $request->api_key,
        // ],401);

        if(!isset($request->api_key)){
            return response()->json([
                'status'=>401,
                'mensaje'=>'Acceso no autorizadoa',
            ],401);
        }

        if(isset($request->api_key)){
            $api_key="AbCd123";
            if(trim($request->api_key)!=$api_key){
                return response()->json([
                    'status'=>401,
                    'mensaje'=>'Acceso no autorizado',
                ],401);
            }
        }

        return $next($request);
    }
}
