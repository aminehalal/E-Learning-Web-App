<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'classId',
        'userId',
        'post',
        'type'
    ];
}
