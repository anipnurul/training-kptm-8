<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =['title','description','trainer','attachment'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    //getter training url
    public function getAttachmentUrlAttribute(){  //mutator

        if($this->attachment){
           return asset('storage/'.$this->attachment);
        }
        else {
            return asset('storage/unavailable.jpg'); 
        }
    }
}
