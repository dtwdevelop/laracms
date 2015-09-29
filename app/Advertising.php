<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Advertising extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'advertisings';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'image', 'text'];
    const UPLOAD_DIR = 'appfiles/advertising';

    public function getImageUrl()
    {
        return URL::to(self::UPLOAD_DIR . '/' . $this->id . '/' . $this->image);
    }
}
