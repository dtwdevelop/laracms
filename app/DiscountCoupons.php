<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class DiscountCoupons extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'discount_coupons';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'sum', 'valid_till', 'is_activated', 'is_sent'];
    
     public function setstartAttribute($value)
    {
      $this->attributes['valid_till'] =  Carbon::createFromDate('Y-m-d',$value,'Europe/London');
    }
    //check in database
    public static function generateCode(){
        
       $code = str_random(24);
       $codes = DiscountCoupons::all();
       foreach ($codes as $val){
           if($val->code == $code){
               $code = str_random(24); 
           }
       }
       return strtoupper($code);
    }
    
    public function isExpired($code){
        if(Carbon::now() > $this->valid_till){
            return true;
        }
        else{
            return false;
        }
    }

}
