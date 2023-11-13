<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\TeacherDemande;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_space');
    }

    public function teacherRequest(){
        $requests = TeacherDemande::all();
        return view('admin.teacher_request' , [
            'requests' => $requests
        ]);
    }

    public function teacherRequestAccept($id){
        $request = TeacherDemande::find($id);
        $user = User::find($request->teacherId);
        $request->etat = 'Done';
        $request->update();

        $user->role = '1';
        $user->update(); 
        return redirect('/admin/teacherRequest');
    }

    public function teacherRequestDeny($id){
        $request = TeacherDemande::find($id);
        $user = User::find($request->teacherId);
        $request->etat = 'Done';
        $request->update();
                
        return redirect('/admin/teacherRequest');
    }

    public function allStudents(){
        $users = User::all();
        return view('admin.all_students' , [
            'users' => $users
        ]);
    }

    public function allTeachers(){
        $users = User::where('role' , 1)->get();
        return view('admin.all_teachers' , [
            'users' => $users
        ]);
    }

    public function allCourses(){
        $courses = Course::all();
        return view('admin.all_courses',[
            'courses' => $courses
        ]);
    }


    public function deleteStudent($id){
        User::destroy($id);
        return redirect('/admin/allStudents');
    }

    public function deleteTeacher($id){
        User::destroy($id);
        return redirect('/admin/allTeachers');
    }

    public function deleteCourse($id){
        Course::destroy($id);
        return redirect('/admin/allCourses');
    }

}
