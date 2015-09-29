<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use DB;

class Service extends Model {

    /**
     * The attributes included in the model's JSON form.
     *
     * @var array
     */
    protected $fillable = array('title_en', 'title_ru', 'title_lv', 'icon');

    /**
     * The rules, automatic validation.
     *
     * @var array
     */
    private $rules = array(
        'title_en' => 'required|min:2',
        'title_ru' => 'required|min:2',
        'title_lv' => 'required|min:2',
        'icon' => 'required',
    );

    public function getIconUrl( $withBaseUrl = false )
    {
        if(!$this->icon) return NULL;

        $imgDir = '/appfiles/services/' . $this->id;
        $url = $imgDir . '/' . $this->icon;

        return $withBaseUrl ? URL::asset( $url ) : $url;
    }

    public function descriptions(){
        return $this->hasMany('App\ServiceDescription');
    }

    public function getDescriptions(){
        return DB::table('service_descriptions')->where('service_id', $this->id)->get();
    }

    public function insertOrUpdateDescriptions($request){

        // 0. Get IDs of existed descriptions
        $existedDescriptionIds = array();
        foreach($this->getDescriptions() as $description){
            $existedDescriptionIds[] = $description->id;
        }

        // 1.
        // update changed rows
        // store IDs of deleted rows
        // store new rows
        $descriptionsToInsert = array();
        $descriptionsInRequest = array();
        if ($request->descriptions !== null && is_array($request->descriptions)){
            foreach($request->descriptions as $descr){
                if (isset($descr['title_en']) && $descr['title_en'] !== ''){
                    $descr['service_id'] = $this->id;
                    if ((int) $descr['id'] > 0) {
                        $descriptionsInRequest[] = $descr['id'];
                        // update
                        DB::table('service_descriptions')->where('id', $descr['id'])->update($descr);
                    }else {
                        $descriptionsToInsert[] = $descr;
                    }
                }
            }
        }

        // 2. Get diff of row IDs and delete rows
        $descriptionsToDelete = array_diff($existedDescriptionIds, $descriptionsInRequest);
        DB::table('service_descriptions')->whereIn('id', $descriptionsToDelete)->delete();

        // 3. insert new rows
        DB::table('service_descriptions')->insert($descriptionsToInsert);
    }
}