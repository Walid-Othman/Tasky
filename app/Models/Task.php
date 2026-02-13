<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title','description','is_done','user_id','is_high_priority'];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
