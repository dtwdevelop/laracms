<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable =['title','meta_description','meta_keywords','image','content'];
    const UPLOAD_URL = 'appfiles/pages';
//    protected $guarded =['_token'];


    /**
     * return url
     */
     public static function getImageUrl($folder,$file) {
       return self::UPLOAD_URL."/".$folder."/".$file;
    }
}
