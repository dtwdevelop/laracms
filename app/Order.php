<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\User;
use App\OrderProduct;
use DB;
class Order extends Model {

    //
    const FREE_SHIPPING = 59.99;
    const PAY_SHIPPING = 4.99;

    public function products() {
        return $this->belongsToMany('App\Product', 'order_products');
    }
    
   public function text(){
       
   }
    
    
  
    /**
     * 
     * @param Product $model
     * @param type $quantity
     * @throws \Exception
     */
    ///x /100 =
    //t *x  than tot -d
    public function addProduct(Product $model, $quantity = 1) {
        try {
            if ($model->id == null) {
                throw new \Exception('Order model id is null, model should be saved first within transaction');
            } else {
               // dd($this->id);
                $orderproduct = new OrderProduct();
                $orderproduct->order_id = $this->id;
                $orderproduct->quantity = $quantity;
                $orderproduct->fillWithProductData($model);
                $orderproduct->save();
                //all product total sum.
                //shipi 4.99
                //if 
                
               
               
                  $this->order_total_sum +=  number_format($model->price * $quantity,2)   ;
                  
                 $this->save();
              
               
              
               
                
            }
        } catch (ErrorException $e) {
            $e->getMessage();
        }
    }

    /**
     * 
     * @param User $model
     */
    public function fillWithUserData(User $user) {

        $this->billing_country = $user->country;
        $this->billing_first_name = $user->first_name;
        $this->billing_last_name = $user->last_name;
        $this->billing_company = $user->company;
        $this->billing_address_1 = $user->address_1;
        $this->billing_address_2 = $user->address_2;
        $this->billing_city = $user->city;
        $this->billing_state = $user->state;
        $this->billing_postcode = $user->postcode;
        $this->billing_email = $user->email;
        $this->billing_phone = $user->phone;
        // $this->save();
    }

}
