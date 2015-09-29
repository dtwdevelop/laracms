<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Timeline extends Model {

	//
      public $timestamps = false;
    public function setstartAttribute($value)
    {
      
        $this->attributes['start'] =  Carbon::createFromFormat('Y-m-d',$value);
    }
    
     public function setendAttribute($value)
    {
         
        $this->attributes['end'] = Carbon::createFromFormat('Y-m-d',$value);
    }
    
    public function project(){
       return $this->belongsTo("App\Project","project_id");
    }
}
