<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class ServiceDescription extends Model {

    /**
     * The attributes included in the model's JSON form.
     *
     * @var array
     */
    protected $fillable = array('title_en', 'title_ru', 'title_lv');

    /**
     * The rules, automatic validation.
     *
     * @var array
     */
    private $rules = array(
        'title_en' => 'required|min:2',
        'title_ru' => 'required|min:2',
        'title_lv' => 'required|min:2',
    );

    public function service(){
        return $this->belongsTo('App\Service');
    }
}