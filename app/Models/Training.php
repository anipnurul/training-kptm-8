<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class Training extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

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
