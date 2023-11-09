<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function home(){
        $courses = Course::orderBy('created_at', 'desc')->take(4)->get();

        return view('home' ,[
            'courses'=>$courses
        ]);
    }

    public function loginPage(){
        return view('login');
    }

    public function signupPage(){
        return view('signup');
    }

    public function allCourses(){
        $courses = Course::orderBy('created_at', 'desc')->get();
        return view('courses' , [
            'courses'=>$courses
        ]);
    }

    public function courseView($id){
        $course = Course::find($id);
        if ($course){
            return view('course_view' , [
                'course' => $course
            ]);
        }
        else{
            abort(404);
        }
    }

    //users
    public function store(Request $request){
        $formRegisterFiled = $request->validate([
            'fullname' => ['required' , 'min:4'],
            'username' => ['required' , 'min:4' , Rule::unique('users' , 'username')],
            'genre' => ['required'],
            'birthday' => ['required' , 'date'],
            'adress' => ['required'],
            'email'=> ['required' , 'email' , Rule::unique('users' , 'email')],
            'password'=> ['required' , 'min:6']
        ]);
        $formRegisterFiled['password'] = bcrypt($formRegisterFiled['password']);

        //Create User
        $user = User::create($formRegisterFiled);

        //Login
        auth() -> login($user);

        return redirect('/') ->with('message' , 'User created successfully');
    }

    public function logout(Request $request){
        auth()->logout();

        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();

        return redirect('/') -> with('message' , 'Loggingout successfully !');
    }

    public function login(Request $request){
        $loginForm = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
         // Debugging statement
        if(auth() -> attempt($loginForm)){
            $request -> session() -> regenerate();
            return redirect('/') -> with('message' , 'Log in successfully !');
        }
        else{
        return back()->with('message','Login failed');
        }
    }

    public function find($user){
        $user = User::where('username', $user)->first();

        if($user){
            return view('profile' , [
                'user' => $user
            ]);
        }
        else{
            return abort(404);
        }

    }

}
