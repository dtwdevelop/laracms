<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model {

    protected $fillable = array('name_en', 'name_ru', 'name_lv');

    protected $table = 'order_statuses';

    protected $primaryKey = 'id';

}

