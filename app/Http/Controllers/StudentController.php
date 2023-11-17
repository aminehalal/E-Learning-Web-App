<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEtat;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function home(){
        $courses = Course::orderBy('created_at', 'desc')->take(4)->get();

        $numOfUsers = User::all()->count();
        $numOfTeachers = User::where('role' , 1)->count();
        $numOfCourses = Course::all()->count();

        return view('home' ,[
            'courses'=>$courses , 'numOfUsers' => $numOfUsers , 'numOfTeachers' => $numOfTeachers , 'numOfCourses'=>$numOfCourses
        ]);
    }

    public function loginPage(){
        return view('login');
    }

    public function signupPage(){
        return view('signup');
    }

    public function allCourses(){
        $q = request('q');
        $tag = request('tag');
        if($q && $tag){
            $courses = Course::where('name' , 'like' , '%'.$q.'%')->where('tags' , 'like' , '%'.$tag.'%')->get();
        }
        elseif($q){
            $courses = Course::where('name' , 'like' , '%'.$q.'%')->get();
        }
        elseif($tag){
            $courses = Course::where('tags' , 'like' , '%'.$tag.'%')->get();
        }
        else{
            $courses = Course::orderBy('created_at', 'desc')->get();
        }


        return view('courses' , [
            'courses'=>$courses
        ]);
    }

    public function courseView($id){
        $course = Course::find($id);

        if ($course){
            $comments =  CourseEtat::where('courseId', $course->id)->get() ;
            return view('course_view' , [
                'course' => $course , 'comments' => $comments
            ]);
        }
        else{
            abort(404);
        }
    }

    public function courseWatch($id){
        $course = Course::find($id);
        if ($course){
            $userId = auth()->user()->id ;
            $checkCourse = CourseEtat::where('courseId', $id)->where('studentId', $userId)->first();
            if($checkCourse){
            }
            else{
                $course_etat_form = [
                    'courseId' => $id,
                    'teacherId' => $course->teacherId,
                    'studentId' => $userId,
                    'etat' => 'En Cours'
                ];
                CourseEtat::create($course_etat_form);
            }
            return view('course_watch' , [
                'course' => $course
            ]);
        }
        else{
            abort(404);
        }
    }

    public function courseMarkWatched($id){
        $courseId = $id ;
        $userId = auth()->user()->id ;
        $courseEtat = CourseEtat::where('courseId' , $courseId)->where('studentId', $userId)->first();
        if ($courseEtat) {
            $courseEtat->etat = 'Done';
            $courseEtat->save();
        }
        return back();
    }

    public function courseRate($id , Request $request){
        $course = Course::find($id);
        if ($course){
            $newRating = $request->input('rating');
            $lastRating = $course->rating;

            // Calculate the average rating
            $averageRating = ($lastRating + $newRating) / 2;

            // Update the course with the new average rating
            $course->update(['rating' => $averageRating]);
        }
        return back();
    }

    public function courseComment($id , Request $request){
        $userId = auth()->user()->id ;
        $courseEtat = CourseEtat::where('courseId',$id)->where('studentId' , $userId)->first();

        $comment = $request->input('comment');
        $courseEtat->update(['comment' => $comment]);
        return back();
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

        $studentClassForm['studentId'] =  $user->id;
        StudentClass::create($studentClassForm);

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

    public function myclasses(){
        $userId = auth()->user()->id ;
        $classesId = StudentClass::where('studentId' , $userId)->pluck('classesId');

        return view('myclasses' , [
            'classesId' => $classesId
        ]);
    }

}
