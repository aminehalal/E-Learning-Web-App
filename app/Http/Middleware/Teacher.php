<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->role == '1'){
                return $next($request);
            }
            else {
                abort(404);
            }
        }
    
        else{
            abort(404);
        }
    }

    // public function showTeacherDashboard()
    // {
    //     if (auth()->check() && auth()->user()->middlewre('isTeacher')) {
    //         // User is authenticated and is a teacher
    //         return view('teacher.dashboard');
    //     }

    //     return view('student.dashboard');
    // }

}
