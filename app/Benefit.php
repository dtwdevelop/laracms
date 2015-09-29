<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Benefit extends Model
{
    const UPLOAD_DIR = 'appfiles/benefits';

    public function getImageUrl()
    {
        return URL::to(self::UPLOAD_DIR . '/' . $this->id . '/' . $this->icon);
    }
}
