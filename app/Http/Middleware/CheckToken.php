<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $user = null;
        try{
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return returnError( 'INVALID_TOKEN' , 'E3001');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return returnError( 'EXPIRED_TOKEN' , 'E3001');
            } else {
                return returnError( 'TOKEN_NOTFOUND' , 'E3001');
            }
        } catch (\Throwable $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return returnError( 'INVALID_TOKEN' , 'E3001');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return returnError( 'EXPIRED_TOKEN' , 'E3001');
            } else {
                return returnError( 'TOKEN_NOTFOUND' , 'E3001');
            }
        }

        if (!$user)
            return returnError(trans('Unauthenticated'));

        return $next($request);

    }
}
