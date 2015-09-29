<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    const UPLOAD_URL = 'appfiles/files';
    
    public static function getFileUrl($folder,$file){
        return self::UPLOAD_URL.'/'.$folder.'/'.$file;
    }
}
