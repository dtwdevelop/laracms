<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class OrderProduct extends Model
{
    //
    
   public function  fillWithProductData(Product $model){
        $this->product_id  = $model->id;
        $this->product_name  = $model->name;
        $this->product_price  = $model->price;
}

}
