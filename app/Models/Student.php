<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable=[
      'name','image'
    ];


   public function student_results()
    {
     return $this->hasMany('App\Models\Student_result');
    }

   public function subjects()
    {
     return $this->hasMany('App\Models\Ssubject');
    }
}
