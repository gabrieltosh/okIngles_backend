<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentStudent extends Model
{
    protected $table='assignment_students';
    protected $fillable=[
        'schedule_id',
        'student_id',
        'skills_id',
        'percentage',
        'absent',
        'detail_lesson_id'
    ];
    protected $appends = ['status'];
    public function getStatusAttribute()
    {
        if($this->absent==0 && is_null($this->detail_lesson_id)){
            return 'wait';
        }else{
            if($this->absent==0 && !is_null($this->detail_lesson_id)){
                return 'present';
            }else{
                if($this->absent==1 && is_null($this->detail_lesson_id)){
                    return 'absent';
                }
            }
        }
    }
    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }
    public function schedule(){
        return $this->belongsTo(Schedule::class,'schedule_id');
    }
    public function skill(){
        return $this->belongsTo(Skill::class,'skills_id');
    }
    public function lesson(){
        return $this->belongsTo(DetailLesson::class,'detail_lesson_id');
    }
}
