<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClassPost;
use App\Models\Course;
use App\Models\StudentClass;
use App\Models\TeacherDemande;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class TeacherController extends Controller
{
    public function index(){
        return view('teacher.teacher_space');
    }

    public function becomeTeacher($username){
       $user = User::where('username',$username)->first();
       // Check if the user exists
        if($user){
            // Check if the authenticated user is the same as the user found
            $userAuthId = auth()->user()->id;
            
            if($user->id == $userAuthId){
                return view('teacher.become_teacher' , [
                    'user' => $user
                ]);
            } else {
                // If the authenticated user is not the same, return a 404 response
                abort(404);
            }
        } else {
            // If the user with the provided username is not found, return a 404 response
            abort(404);
        }
    }

    public function becomeTeacherDemande($id , Request $request){
        $user = User::find($id);
        $demadeForm = $request->validate([
            'teacherId' => 'required',
            'username' => 'required',
            'certificate' => 'required|mimes:pdf',
            'coverLetter' => 'required'
        ]);
        if ($request->hasFile('certificate')) {
            $certificate = $request->file('certificate');
            $certificate->move('pdf/certificate' , $certificate->getClientOriginalName());
        }
        $demadeForm['certificate'] = $certificate->getClientOriginalName();

        TeacherDemande::create($demadeForm);

        return redirect('/profile/'.$user->username);
    }

    public function addCourse(){
        return view('teacher.add_course');
    }

    public function store(Request $request) {
        // Validate the form data
        $createCourseForm = $request->validate([
            'name' => 'required',
            'teacherId' => 'required',
            'description' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
            'video.*' => 'mimes:mp4,avi,mov|max:51200', // Validate the video files (up to 50MB)
        ]);
    
        // Store the course image
        $createCourseForm['image'] = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('imgCourses', $createCourseForm['image'], 'img');
    
        $videosName = [];
    
        if ($request->hasFile('video')) {
            $videos = $request->file('video');

            foreach($videos as $video){
                $video->move('video/videoCourses' , $video->getClientOriginalName());
                $videosName[] = $video->getClientOriginalName() ;
            }
    
        }
        $videosName = implode(',' , $videosName);
        $createCourseForm['video'] = $videosName ; 
        Course::create($createCourseForm);
    
        return redirect('/')->with('success', 'Course created successfully');
    }

    public function allCourses(){
        $userId = auth()->user()->id ;

        $courses = Course::where('teacherId' , $userId)->get();
        return view('teacher.all_courses' , [
            'courses' => $courses
        ]);
    }

    public function deleteCourse($id){
        $course = Course::find($id);
        if (auth()->user()->id == $course->teacherId){
            Course::destroy($id);
            return redirect('/teacher/AllCourses');
        }
        else {
            abort(404);
        }
    }

    public function createClass(){
        return view('teacher.create_class');
    }

    public function createClassNow(Request $request){
        $createClassForm = $request->validate([
            'name' => 'required',
            'teacherId' => 'required',
            'description' => 'required',
            'code' => 'required|unique:classes'
        ]);
        $userId = auth()->user()->id ;
        $class = Classe::create($createClassForm);
        // Retrieve the student class for the current user
        $class->update([
            'students' => $userId
        ]);
        $myClasses = StudentClass::where('studentId', $userId)->first();

        // Update the classesId field
        if ($myClasses) {
            $myClasses->update([
                'classesId' => $myClasses->classesId . ',' . $class->id,
            ]);
        }
        return redirect('/class/'.$class->id);
    }

    public function classLive(Request $request){
        $classPostForm = $request->validate([
            'userId' => 'required',
            'classId' => 'required',
            'post' => 'required' ,
            'type' => 'required'
        ]);

        $classPostForm['post'] = 'http://localhost:3000?room='.$classPostForm['post'].''.rand(1000,9999) ;

        ClassPost::create($classPostForm);
        return back();
    }
    
}
