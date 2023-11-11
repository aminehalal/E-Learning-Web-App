<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherDemande extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacherId',
        'username',
        'certificate',
        'coverLetter'
    ];
}

