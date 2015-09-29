<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use DB;

class DBConfiguration extends Model {

    protected $fillable = array('key', 'value');

    protected $table = '_configurations';

    protected $insertOrUpdateIDColumn = 'key';

    protected $primaryKey = 'key';

    private static $cache = array();

    public $rules = array(
        'key' => 'required|min:3|max:32|unique:_configurations|alpha_dash',
        'value' => 'required',
    );

    public static function get($cfg, $lang=null)
    {
        if ($lang === null){
            $lang = App::getLocale();
        }

        if (empty(self::$cache)){
            self::$cache = self::all()->lists('value', 'key');
        }

        if ($lang === null) {
            if (isset(self::$cache[$cfg])) {
                return self::$cache[$cfg];
            } else {
                return $cfg;
            }
        }else{
            $cfg_lang = $cfg . '_' . $lang;
            $cfg_default = $cfg . '_en';
            if (isset(self::$cache[$cfg_lang])) {
                return self::$cache[$cfg_lang];
            } elseif ($lang !== 'en' && isset(self::$cache[$cfg_default])) {
                return self::$cache[$cfg_default];
            } elseif (isset(self::$cache[$cfg])) {
                return self::$cache[$cfg];
            } else {
                return $cfg_lang;
            }
        }
    }

    public function insertOrUpdate($request){

        // 0. Get IDs of existed items
        $existedItemIds = array();
        foreach($this->all() as $item){
            $existedItemIds[] = $item->{$this->primaryKey};
        }

        // 1.
        // update changed rows
        // store IDs of deleted rows
        // store new rows
        $itemsToInsert = array();
        $itemsInRequest = array();
        if ($request->items !== null && is_array($request->items)){
            foreach($request->items as $item){
                if (isset($item[$this->insertOrUpdateIDColumn]) && $item[$this->insertOrUpdateIDColumn] !== '') {
                    if ($item[$this->primaryKey] !== '') {
                        $itemsInRequest[] = $item[$this->primaryKey];
                        // update
                        if (in_array($item[$this->primaryKey], $existedItemIds)){
                            DB::table($this->table)->where($this->primaryKey, $item[$this->primaryKey])->update($item);
                        } else {
                            $itemsToInsert[] = $item;
                        }
                    }
                }
            }
        }

        // 2. Get diff of row IDs and delete rows
        $itemsToDelete = array_diff($existedItemIds, $itemsInRequest);
        DB::table($this->table)->whereIn($this->primaryKey, $itemsToDelete)->delete();

        // 3. insert new rows
        DB::table($this->table)->insert($itemsToInsert);

    }
}
