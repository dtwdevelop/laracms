<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class SiteSetting extends Model
{
   // protected $table = 'sitesettings';

     const UPLOAD_URL = 'appfiles/site_settings';
    const UPLOAD_ICON = 'appfiles/site_socials';

    public function getLogoUrl()
    {
        return URL::to(self::UPLOAD_URL."/".$this->id."/".$this->logo);
    }


    public function getFaviconUrl()
    {
        return URL::to(self::UPLOAD_URL."/".$this->id."/".$this->favicon);
    }
}
