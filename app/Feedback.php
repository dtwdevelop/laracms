<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Url;

class Feedback extends Model
{
    const UPLOAD_URL = 'appfiles/feeback';
    //
    public function getFotoUrl()
    {
        return URL::to(self::UPLOAD_URL."/".$this->id."/".$this->foto);
    }

}
