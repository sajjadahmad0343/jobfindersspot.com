<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Company\Models\Company;
use Modules\Candidate\Models\Candidate;

class CompleteProfile
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
        if(auth()->check()){
            if(auth()->user()->role_id == 2){
                $companyLocation = Company::where('owner_id', auth()->id())->whereNotNull('location_id')->first();
                if(!$companyLocation){
                    return redirect('user/company/profile');
                }
            }else if(auth()->user()->role_id == 3){
                $candidate=Candidate::find(auth()->id());
                if($candidate && $candidate->title==null){
                    return redirect('user/profile');
                }
            }
        }
        return $next($request);
    }
}
