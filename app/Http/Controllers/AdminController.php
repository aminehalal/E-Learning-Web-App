<?php

namespace App\Http\Controllers;

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

}
