<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use DB;

class Slider extends Model {

    /**
     * The attributes included in the model's JSON form.
     *
     * @var array
     */
    protected $table = 'sliders';
    protected $fillable = array('title_en', 'title_ru', 'title_lv', 'icon');

    /**
     * The rules, automatic validation.
     *
     * @var array
     */
    private $rules = array(
        'title_en' => 'required|min:2',
        'icon' => 'required',
    );

    public function getIconUrl( $withBaseUrl = false )
    {
        if(!$this->icon) return NULL;

        $imgDir = '/appfiles/sliders/' . $this->id;
        $url = $imgDir . '/' . $this->icon;

        return $withBaseUrl ? URL::asset( $url ) : $url;
    }
}
