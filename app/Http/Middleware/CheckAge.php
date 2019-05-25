<?php

namespace App\Http\Middleware;
use App\Contact;

use Closure;

class CheckAge
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
        $objContact = new Contact();
        $objContact = $objContact::find($request->id);
        if($objContact->age >= 18){
            return $next($request);
        }else{
            return abort(404);
        }
    }
}
