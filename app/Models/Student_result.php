<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_result extends Model
{
    use HasFactory;

    protected $fillable=[
     'subject_id','student_id','achieve_number'
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

}
