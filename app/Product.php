<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const UPLOAD_URL = 'appfiles/products';
    //
     public static function getImageUrl($folder,$file) {
        return self::UPLOAD_URL."/".$folder."/".$file;
    }
    
   public function product() {
        return $this->hasOne('App\OrderProduct','product_id');
    }   
}
