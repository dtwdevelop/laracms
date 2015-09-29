<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Exception;

class PriceOffer extends Model {

    protected $fillable = array('doc_nr', 'company_name', 'contact_person_name', 'contact_email', 'contact_phone', 'is_viewable', 'status_id');

    protected $table = 'price_offers';

    protected $primaryKey = 'id';

    public function fillWithContactFields(Contact $contact){
        $this->contact_id = $contact->id;
        $this->doc_nr = 'WE3-15/'.sprintf('%04d', $contact->id);
        $this->sender_company_name = $contact->company;
        $this->sender_contact_person_name = $contact->name;
        $this->sender_contact_email = $contact->email;
        $this->sender_contact_phone = $contact->phone;
    }

    public function getServices(){
        return DB::table('price_offer_services')->where('price_offer_id', $this->id)->get();
    }

    public function loadServices(){
        $this->services = $this->getServices();
    }

    public function getPortfolios(){
        return DB::table('price_offer_portfolios')->where('price_offer_id', $this->id)->get();
    }

    public function loadPortfolios(){
        $this->portfolios = $this->getPortfolios();
    }

    public function getPortfolioIds(){
        $ids = array();
        foreach($this->portfolios as $p){
            $ids[] = $p->portfolio_id;
        }
        return $ids;
    }

    public function insertOrUpdateServices($request){

        // 0. Get IDs of existed items
        $existedItemIds = array();
        $all = DB::table('price_offer_services')->where('price_offer_id', $this->id)->get();
        foreach($all as $item){
            $existedItemIds[] = $item->id;
        }

        // 1.
        // update changed rows
        // store IDs of deleted rows
        // store new rows
        $itemsToInsert = array();
        $itemsInRequest = array();
        $k = 0;
        if ($request->items !== null && is_array($request->items)){
            foreach($request->items as $item){
                if (isset($item['label']) && $item['label'] !== '') {
                    $k++;
                    $item['price_offer_id'] = $this->id;
                    if ($item['id'] !== '') {
                        $itemsInRequest[] = $item['id'];
                        // update
                        if (in_array($item['id'], $existedItemIds)){
                            DB::table('price_offer_services')->where('id', $item['id'])->update($item);
                        } else {
                            //$itemsToInsert[] = $item;
                        }
                    }else{
                        $itemsToInsert[] = $item;
                    }
                }
            }
        }

        if ($k === 0){
            throw new Exception('No services submitted');
        }

        // 2. Get diff of row IDs and delete rows
        $itemsToDelete = array_diff($existedItemIds, $itemsInRequest);
        DB::table('price_offer_services')->whereIn('id', $itemsToDelete)->delete();

        // 3. insert new rows
        DB::table('price_offer_services')->insert($itemsToInsert);

    }

    public function insertOrUpdatePortfolios($request){

        // 0. Get IDs of existed items
        $existedItemIds = array();
        $all = DB::table('price_offer_portfolios')->where('price_offer_id', $this->id)->get();
        foreach($all as $item){
            $existedItemIds[] = $item->portfolio_id;
        }

        // 1.
        // update changed rows
        // store IDs of deleted rows
        // store new rows
        $itemsInRequest = array();
        $itemsToInsert = array();

        if ($request->portfolios !== null && is_array($request->portfolios)){
            foreach($request->portfolios as $portfolio_id){
                $itemsInRequest[] = $portfolio_id;
                if (!in_array($portfolio_id, $existedItemIds)){
                    $itemsToInsert[] = array(
                        'price_offer_id' => $this->id,
                        'portfolio_id' => $portfolio_id,
                    );
                }
            }
        }

        // 2. Get diff of row IDs and delete rows
        $itemsToDelete = array_diff($existedItemIds, $itemsInRequest);
        DB::table('price_offer_portfolios')->where('price_offer_id', $this->id)->whereIn('portfolio_id', $itemsToDelete)->delete();

        // 3. insert new rows
        DB::table('price_offer_portfolios')->insert($itemsToInsert);

    }

    public function data()
    {
        $data = PriceOffer::select(array('price_offers.id','price_offers.contact_id','price_offers.doc_nr','price_offers.sender_company_name',
            'price_offers.sender_contact_person_name', 'price_offers.sender_contact_email', 'price_offers.sender_contact_phone'));

        return Datatables::of($data)
            ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '@if ($id!="1")<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                @endif')
            ->remove_column('id')

            ->make();
    }
}

