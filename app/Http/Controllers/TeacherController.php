<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        return view('teacher.teacher_space');
    }

    public function becomeTeacher(){
        $userId = auth()->user()->id ;
        $user = User::find($userId);

        $user->role = '1';
        $user->save();

        return back();
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
                $video->move('img/video' , $video->getClientOriginalName());
                $videosName[] = $video->getClientOriginalName() ;
            }
    
        }
        $videosName = implode(',' , $videosName);
        $createCourseForm['video'] = $videosName ; 
        Course::create($createCourseForm);
    
        return redirect('/')->with('success', 'Course created successfully');
    }
    
}
