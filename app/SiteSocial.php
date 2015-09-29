<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSocial extends Model
{
   // protected $table = 'sitesocials';
     public $timestamps = false;
      const UPLOAD_SOC = 'appfiles/site_socials/icon';
     
      public static function getImageUrlIcon($folder,$file) {
        return self::UPLOAD_SOC."/".$folder."/".$file;
         
    }
    
    public static function SocialIcons(){
       return $social = SiteSocial::orderBy('order', 'asc')->get();
    }
}
