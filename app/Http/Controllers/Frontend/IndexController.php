<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Benefit;
use App\Product;
use App\Feedback;
use App\ContactMessage;
use App\Faq;
use App\File as Files;
use App\Page;
use Paypal;
use App\Order;
use Session;
use App\User;
use Auth;
use App\DiscountCoupons;
use Carbon\Carbon;
use App\OrderProduct;
use DB;
use Event;
use App\Events\PaypalPay;
use Exception;
use Validator;
use Log;
use Cart;

class IndexController extends Controller
{

    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'), config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => env('PAY_MODE'),
            'service.EndPoint' => env('PAY_ENDPOINT'),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function _getIndex()
    {
        $benefit = Benefit::orderBy('order', 'asc')->get();
        //$socials = SiteSocial::orderBy('order', 'asc')->get();
        $products = Product::all();
        //$site = SiteSetting::get()->first();
        $feedback = Feedback::where(['is_active' => 1])->get();

        return view(
            'frontend/index', [
                'benefits' => $benefit,
                'products' => $products,
                //'socials' => $socials,
                'feedback' => $feedback,
                //'site' => $site
            ]
        );
    }

    public function _getAboutUs()
    {
        $faqs = Faq::orderBy('order', 'asc')->get();
        $files = Files::all();
        $pages = Page::all();
        return view('frontend/about', ['faqs' => $faqs, 'files' => $files, 'pages' => $pages]);
    }

    public function _mail()
    {

        return view('frontend/email');
    }

    public function _download($id)
    {
        $file = Files::find($id);
        return response()->download(Files::getFileUrl($file->id, $file->file));
    }

    public function _addCart($id)
    {

        $product = Product::findOrFail($id);

        Cart::add($product->id,$product->name,1,$product->price,['image'=>$product->image]);
       // Session::flush();
        if (Session::has('pro')) {
            Session::put('cart.price', number_format(Cart::total(),2));
            Session::put('total', count(Cart::all()));

        } else {
            Session::put('pro',1);
            Session::put('cart.price', number_format(Cart::total(),2));
            Session::put('total', count(Cart::all()));
        }


        return response()->json(['add' => 'Add Cart', 'total' => Session::get('total'), 'cart' => Session::get('cart.price')]);


    }

    public function _getMyCart(Request $request)
    {


        if (Cart::count() < 1) {
            return redirect('/');
        }
        if ($request->ajax()) {


            return response()->json(['delete' => 1]);
        } else {
            $product  = Cart::all();
          // dd($product);


            return view('frontend/cart', ["pro"=>$product]);
        }
    }

    /**
     * Get coupon code
     * @param type $id
     * @return json
     */
    public function _ajaxGetCoupon($id)
    {

        $disc = DiscountCoupons::where('code', $id)->get()->last();
        //dd($disc);
        if ($disc == null) {
            return response()->json(['error' => 'err']);
        } else {
            if (Carbon::now() > $disc->valid_till) {
                $is_expired = 1;
            } else {
                $is_expired = 0;
            }

            //  Session::forget('code');


            Session::put('code', $disc->id);
            if ($disc->is_activated == 0) {
                // $disc->is_activated = 1;
                $disc->save();
                $active = 0;
            } else {
                $active = 1;
            }

            $data = ['sum' => $disc->sum, 'code' => $disc->code, 'valid_till' => $disc->valid_till, 'is_activated' => $active, 'is_expired' => $is_expired];
        }

        return response()->json($data);
    }

    /**
     *
     * @param type $id
     * @return typeremove item from cart
     */
    public function _removeItem($id)
    {
        $id = $id;

//        $cart = Cart::search(['id'=>$id]);
//        $key  = $cart->keys();
        Cart::update($id, 0);
        Cart::remove($id);

        Session::put('total', count(Cart::all()));
        Session::put('cart.price', number_format(Cart::total(),2));
        if (Cart::count() < 1) {
            Session::forget('cart.price');
            Session::forget('pro');
            Session::forget('total');
            Cart::destroy();
        }
        return redirect('/my-cart');
    }

    /**
     *
     * @param Request $request
     * @return typereturn profile data
     */
    public function _getMyProfile(Request $request)
    {
        try {


//            
            $user = User::findOrFail(Auth::user()->id);
            $order = Order::where('user_id', $user->id)->paginate(10);


            if ($request->isMethod('post')) {
                $this->validate($request, [
                    "billing_country" => "required|min:2",
                    "billing_first_name" => "required",
                    "billing_last_name" => "required",
                    "billing_address_1" => "required",
                    "billing_city" => "required",
                    "billing_postcode" => "required",
                    "billing_email" => "required|email",
                    "billing_phone" => "required",
                ]);


                $userdata = [
                    "country" => $request->input("billing_country"),
                    "first_name" => $request->input("billing_first_name"),
                    "last_name" => $request->input("billing_last_name"),
                    "company" => $request->input("billing_company"),
                    "address_1" => $request->input("billing_address_1"),
                    "address_2" => $request->input("billing_address_2"),
                    "city" => $request->input("billing_city"),
                    "state" => $request->input("billing_state"),
                    "postcode" => $request->input("billing_postcode"),
                    "email" => $request->input("billing_email"),
                    "phone" => $request->input("billing_phone"),
                ];
                //$user->save();
                $user->update($userdata);
                return redirect('my-profile')->with('info', 'Profile updated');
            }
            return view('frontend/profile', ['user' => $user, 'order' => $order]);
        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * Return total from cart
     * @param Request $request
     * @return type
     */
    public function _getCheckout(Request $request)
    {

        try {
         //   dd($request->all());

            if (Auth::user()) {
                $id = Auth::user()->id;
            } else {
                $id = 0;
            }
            Session::set('items', $request->input('item'));
           // dd($request->input('item')['id'][0]);
            Session::put('totalpay', $request->input('total'));
            // Session::put('cart.price',$request->input('total'));
           // Sesssion::put('pro',0);
            $user = User::findOrNew($id);
            return view('frontend/checkout', ['user' => $user, 'total' => $request->input('total'), 'copsum' => $request->input('codesum'), 'code' => $request->input('code'), 'item' => $request->input('item')]);
        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * Make create order and send to paypal
     * @param Request $request
     * @return api from paypal
     */
    public function _pay(Request $request)
    {

        try {

            // dd($request->all());
            if ($request->ajax()) {

                //dd($request->all());
                if (!Auth::check()) {
                    if ($request->has('password')) {
                        if ($request->input('password') !== $request->input('password_repeat')) {
                            return response()->json(['data' => 'error']);
                        } else {
                            $mail = $request->input("billing_email");

                            $mailfrom = User::where('email', $mail)->get();

                            if (count($mailfrom) == 0) {
                                $user = new User;
                                $user->name = "";
                                $user->confirmation_code = str_random(6);
                                $user->password = bcrypt($request->input('password'));
                                $user->username = $mail;
                                $user->email = $mail;
                                $user->country = $request->input("billing_country");
                                $user->first_name = $request->input("billing_first_name");
                                $user->last_name = $request->input("billing_last_name");
                                $user->company = $request->input("billing_company");
                                $user->address_1 = $request->input("billing_address_1");
                                $user->address_2 = $request->input("billing_address_2");
                                $user->city = $request->input("billing_city");
                                $user->state = $request->input("billing_state");
                                $user->postcode = $request->input("billing_postcode");
                                $user->email = $request->input("billing_email");
                                $user->phone = $request->input("billing_phone");
                                $user->locale = $request->input("billing_country");
                                $user->currency = "GBP";
                                $user->save();
                                $this->mail_to = $user->email;

                                send_mail(
                                    $this->mail_to,
                                    'client_registered',
                                    array(
                                        'user' => $user,
                                        'confirmation_code' => $user->confirmation_code
                                    )
                                );

                                return response()->json(['data' => 'ok', 'user' => $user->id]);
                            } else {
                                return response()->json(['mail' => 'err']);
                            }
                        }
                    }
                }

                return response()->json(['data' => 'error']);
            }

            $order = new Order();
            $order->billing_country = $request->input("billing_country");
            $order->billing_first_name = $request->input("billing_first_name");
            $order->billing_last_name = $request->input("billing_last_name");
            $order->billing_company = $request->input("billing_company");
            $order->billing_address_1 = $request->input("billing_address_1");
            $order->billing_address_2 = $request->input("billing_address_2");
            $order->billing_city = $request->input("billing_city");
            $order->billing_state = $request->input("billing_state");
            $order->billing_postcode = $request->input("billing_postcode");
            $order->billing_email = $request->input("billing_email");
            $order->billing_phone = $request->input("billing_phone");
            if ($request->input('cc') == 1) {

                $order->shipping_country = $request->input("billing_country");
                $order->shipping_first_name = $request->input("billing_first_name");
                $order->shipping_last_name = $request->input("billing_last_name");
                $order->shipping_company = $request->input("billing_company");
                $order->shipping_address_1 = $request->input("billing_company");
                $order->shipping_address_2 = $request->input("billing_address_2");
                $order->shipping_city = $request->input("billing_city");
                $order->shipping_state = $request->input("billing_state");
                $order->shipping_postcode = $request->input("billing_postcode");
                $order->shipping_email = $request->input("billing_email");
                $order->shipping_phone = $request->input("billing_phone");
                $order->ship_to_billing = 0;
            } else {


                $order->shipping_country = $request->input("shipping_country");
                $order->shipping_first_name = $request->input("shipping_first_name");
                $order->shipping_last_name = $request->input("shipping_last_name");
                $order->shipping_company = $request->input("shipping_company");
                $order->shipping_address_1 = $request->input("shipping_address_1");
                $order->shipping_address_2 = $request->input("shipping_address_2");
                $order->shipping_city = $request->input("shipping_city");
                $order->shipping_state = $request->input("shipping_state");
                $order->shipping_postcode = $request->input("shipping_postcode");
                $order->shipping_email = $request->input("shipping_email");
                $order->shipping_phone = $request->input("shipping_phone");
                $order->ship_to_billing = 1;
            }


            $order->order_ip = $request->ip();
            $order->order_hash = "";
            $order->order_status = 0;
            $order->order_currency = "GBP";
            $order->order_locale = "GB";
            $order->order_total_sum = 0.00;
            if (Auth::user()) {
                $order->user_id = Auth::user()->id;
            } else {
                $order->user_id = $request->input("user_id");
                $userdata = [
                    "country" => $request->input("billing_country"),
                    "first_name" => $request->input("billing_first_name"),
                    "last_name" => $request->input("billing_last_name"),
                    "company" => $request->input("billing_company"),
                    "address_1" => $request->input("billing_address_1"),
                    "address_2" => $request->input("billing_address_2"),
                    "city" => $request->input("billing_city"),
                    "state" => $request->input("billing_state"),
                    "postcode" => $request->input("billing_postcode"),
                    "email" => $request->input("billing_email"),
                    "phone" => $request->input("billing_phone"),
                ];
                if ($request->input('regitercheck') == 1) {
                    $user = User::find($request->input("user_id"));
                    $user->update($userdata);
                } else {
                    $order->user_id = null;
                }
            }

            if (Session::has('code')) {
                $order->discount_coupon_id = Session::get('code');
            }
            $order->save();

            $data = Session::get('items');

            //dd( count(Session::get('pro')));

            for ($i = 0; $i < count(Cart::all()); $i++) {

                // dd($data['quantyt'][$i]);
                $model = Product::find($data['id'][$i]);

                $order->addProduct($model, $data['quantyt'][$i]);
            }

            Session::forget('cart.price');
            Session::forget('pro');
            Session::forget('limit');
            Session::forget('total');
            Session::forget('items');
            Session::forget('code');
            Cart::destroy();
            $order = Order::find($order->id);

            Session::put('order_id', $order->id);

            $orderpro = OrderProduct::where('order_id', $order->id)->get();
//            dd($orderpro);

            //discount
            $payer = PayPal::Payer();
            $payer->setPaymentMethod('paypal');
            //while sample
            $list = array();
            foreach ($orderpro as $product) {
                // dd($product);
                $item = PayPal::Item();
                //$product->quantity
                // dd($product->product_name);
                $item->setName($product->product_name)->setCurrency('GBP')->setQuantity($product->quantity)->setSku("123123")->setPrice($product->product_price);
                $list[] = $item;
            }
            if (isset($order->discount_coupon_id)) {
                $code = DiscountCoupons::findOrFail($order->discount_coupon_id);
                $code->is_activated = 1;
                $code->save();
                $procent = ($code->sum / 100);
                $sub = number_format($order->order_total_sum * $procent,2);
                //dd($sub);
                //72.485
                //-72.49

                $discoupon = PayPal::Item();
                $discoupon->setName('Discount Coupon')->setCurrency('GBP')->setQuantity(1)->setSku("0")->setPrice(-$sub);
                $list[] = $discoupon;
                if($order->order_total_sum < config('app.free_shipping_price')){
                    $item3 = PayPal::Item();
                    $item3->setName('STANDART SHIPPING')->setCurrency('GBP')->setQuantity(1)->setSku("1")->setPrice(config('app.shipping_price'));
                    $list[] = $item3;
                    $order->order_total_sum += config('app.shipping_price');

                }
                $order->order_total_sum -= $sub;



            }
            else{
                if ($order->order_total_sum < config('app.free_shipping_price')) {
                    $item3 = PayPal::Item();
                    $item3->setName('STANDART SHIPPING')->setCurrency('GBP')->setQuantity(1)->setSku("1")->setPrice(config('app.shipping_price'));
                    $list[] = $item3;
                    $order->order_total_sum += config('app.shipping_price');
                }

            }



           // dd($order->order_total_sum);
            $order->save();
           // dd($list);
            $itemList = PayPal::ItemList();
            $itemList->setItems($list);


            $amount = PayPal:: Amount();
            $amount->setCurrency('GBP');
            $amount->setTotal($order->order_total_sum); // This is the simple way,
            $transaction = PayPal::Transaction();

            $transaction->setAmount($amount)->setItemList($itemList);

            $transaction->setDescription('Buy some');
            $redirectUrls = PayPal:: RedirectUrls();
            $redirectUrls->setReturnUrl(url('/done'));
            $redirectUrls->setCancelUrl(url('/cancel'));

            $payment = PayPal::Payment();
            $payment->setIntent('sale');
            $payment->setPayer($payer);
            $payment->setRedirectUrls($redirectUrls);
            $payment->setTransactions(array($transaction));

            $response = $payment->create($this->_apiContext);

            $redirectUrl = $response->links[1]->href;
            return redirect($redirectUrl);
        } catch (PayPal\Exception\PayPalConnectionException $e) {
            var_dump(json_decode($e->getData()));
            exit;
        }
    }

    /**
     * Active payment in paypal
     * @param Request $request
     * @return order to view
     */
    public function done(Request $request)
    {
        try {
            Event::listen('App\Events\PaypalPay', function ($event) {
                //  dd($event->task);
                $data = (string)$event->task->headers;

                DB::table('order_logs')->insert(
                    ['ip' => $event->task->ip(), 'headers' => $data, 'order_id' => Session::get('order_id')]
                );
            });
            event(new PaypalPay($this->task = $request));

            $id = $request->get('paymentId');
            $token = $request->get('token');
            $payer_id = $request->get('PayerID');
            $this->request = $request;

//            $id = 'PAY-70040052NL770154YKWMLWNY';
//            $token = 'EC-2KM03021799477404';
//            $payer_id = '6CEAEG9AKWS4N';
            $payment = PayPal::getById($id, $this->_apiContext);
            $payments = json_decode($payment);
            $this->head = $payments;
            //total sum from paypal     
            $this->totalpay = $payments->{'transactions'}[0]->{'amount'}->{'total'};

            if ($payments->payer->status !== "VERIFIED") {
                return redirect('/cancel');
            }
            $this->total_item = 0;
            $this->discount = 0;
            $this->items = $payments->{'transactions'}[0]->{'item_list'};
            foreach ($payments->{'transactions'}[0]->{'item_list'} as $item) {
                if ($item[0]->{'sku'} == 0) {
                    $this->discount += $item[0]->{'price'};
                }
                if ($item[0]->{'sku'} != 0 && $item[0]->{'sku'} != 1) {
                    $this->total_item += $item[0]->{'quantity'};
                }
            }
            // payment agree
            $paymentExecution = PayPal::PaymentExecution();

            $paymentExecution->setPayerId($payer_id);
            $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

            DB::transaction(function () {


                if (Session::has('order_id')) {
                    $this->order = Order::findOrFail(Session::get('order_id'));
                    if ($this->totalpay === $this->order->order_total_sum) {


                        $this->order->order_status = 1;
                        $this->order->save();
                        $this->mail_to = $this->order->billing_email;


                        send_mail(
                            $this->mail_to,
                            'client_order_made',
                            array(
                                'order' => $this->order,
                                'disc' => $this->discount,
                                'q' => $this->total_item,
                                'items' => $this->items,
                                'title' => 'Your Capsilite order',
                            )
                        );

                        send_info_mails(
                            'client_order_made_us',
                            array(
                                'order' => $this->order,
                                'disc' => $this->discount,
                                'q' => $this->total_item,
                                'items' => $this->items,
                                'title' => 'New order received',
                            )
                        );

                    } else {
                        throw new Exception('Invalid sum to pay');
                    }
                }
            });
            //  return view('emails.welcome', array('order' => $this->order, 'disc' => $this->discount, 'q' => $this->total_item, 'items' => $this->items));
            return view('frontend.order_processing', ['order' => $this->order]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect('/')->with([
                'modal' => trans('site.error')
            ]);
        }
    }

    public function cancel()
    {
        return view("frontend.order_processing");
    }

    public function _getAuth()
    {
        return view('frontend/auth');
    }

    public function _postAuth(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'confirmed' => 1])) {
            return redirect('/');
        } else {
            return redirect('/auth')
                ->withErrors('User with that email and password not found or account not activated.')
                ->withInput();
        }
    }

    public function _getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function _postRegister(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
                'registration_email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|confirmed|min:6',
            ],
            [
                'registration_email.unique' => 'This email has already been taken.'
            ]
        );

        if ($validator->fails()) {
            return redirect('/auth')
                ->withErrors($validator)
                ->withInput();
        } else {
            try {
                DB::transaction(function () use ($request) {

                    $confirmation_code = md5(microtime() . $request->input('registration_email') . env('APP_KEY'));

                    User::create([
                        'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                        'first_name' => $request->input('first_name'),
                        'last_name' => $request->input('last_name'),
                        'username' => $request->input('registration_email'),
                        'email' => $request->input('registration_email'),
                        'password' => bcrypt($request->input('password')),
                        'confirmed' => 0,
                        'confirmation_code' => $confirmation_code,
                    ]);

                    send_mail(
                        $request->input('registration_email'),
                        'client_registered',
                        array(
                            'user' => (object)$request->all(),
                            'confirmation_code' => $confirmation_code
                        )
                    );

                });
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return redirect('/auth')
                    ->withErrors(trans('site.error'))
                    ->withInput();
            }

            return redirect('/')->with([
                'modal-title' => trans('modals.client_registered_title'),
                'modal' => trans('modals.client_registered'),
            ]);
        }
    }

    public function _getTestModal()
    {
        return redirect('/')->with([
            'modal-title' => trans('modals.client_registered_title'),
            'modal' => trans('modals.client_registered'),
        ]);
    }

    public function _getActivateAccount($code)
    {
        $user = User::where('confirmation_code', $code)->first();

        if ($user === null) {
            abort(404);
        } else {
            $user->confirmation_code = '';
            $user->confirmed = 1;
            $user->save();

            return redirect('/')->with([
                'modal-title' => trans('modals.client_registration_completed_title'),
                'modal' => trans('modals.client_registration_completed'),
            ]);
        }
    }

    public function _getAjaxModalStrings()
    {
        echo json_encode(trans('modals'));
    }

    /**
     * Send contact Message
     * @param Request $request
     * @return json
     */
    public function _postAjaxSendContactMessage(Request $request)
    {
        try {
            // dd(Session::all());

            $this->validate($request, [
                'name' => 'required|max:200',
                'last_name' => 'required|max:200',
                'email' => 'required|email',
                'content' => 'required',
                'captcha' => 'required|captcha'
            ]);
            if (Session::has('captcha')) {
                Session::forget('captcha');

            }

            $this->request = $request;

            DB::transaction(function () {
                $clientmessage = new ContactMessage;
                $clientmessage->name = $this->request->input('name');
                $clientmessage->last_name = $this->request->input('last_name');
                $clientmessage->email = $this->request->input('email');
                $clientmessage->message = $this->request->input('content');
                $clientmessage->is_reviewed = 0;
                $clientmessage->save();
                // dd($this->request->input('email'));

                $this->mail_to = $this->request->input('email');

                send_info_mails('contact_message_sent_us', array('client' => $clientmessage));

                send_mail($this->mail_to, 'contact_message_sent', array('client' => $clientmessage));
            });
            return response()->json(["send" => "ok"]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(["ex" => "error"]);
        }
    }

    public function _getResetPassword()
    {


        return view('frontend/reset_password');
    }

    public function _codeGenerator()
    {
        return response()->json(['code' => captcha_src('flat')]);
    }

    public function _resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',

        ]);

        $user = User::where('email', $request->input('email'))->first();

        if ($user !== null) {
            try {
                $this->str_password = str_random(6);
                $user->password = bcrypt($this->str_password);
                $user->save();
                $this->mail_to = $user->email;

                send_mail(
                    $this->mail_to,
                    'client_password_changed',
                    array(
                        'user' => $user,
                        'password' => $this->str_password
                    )
                );
                return redirect('/reset-password')->with('info', 'New password has been sent to your email.');

            } catch (Exception $e) {
                Log::error($e->getMessage());
                return redirect('/')->with(
                    array(
                        'modal' => trans('site.error')
                    )
                );
            }
        } else {
            return redirect('/reset-password')->with('info', 'Not user exit');
        }

    }

    public function _getChangePassword()
    {


        try {

            $user = User::findOrFail(Auth::user()->id);
            return view('frontend/change_password', ['user' => $user]);
        } catch (Exception $ex) {
            abort(404);
        }
    }

    public function _postChangePassword(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            // dd($request->all());
//                $this->validate($request, [
//                    'passwordold' => 'required|max:4',
//                    'newpassword' => 'required|max:4',
//                    'newpasswordr' => 'required|max:4',
//                ]);


            $cred = ['email' => $user->email, 'password' => $request->input('passwordold')];


            if (Auth::validate($cred)) {

                if ($request->input('newpassword') != $request->input('newpasswordr')) {
                    return redirect('/change-password')->with('info', 'Whoops, these don\'t match');
                } else {
                    $user->password = bcrypt($request->input('newpassword'));
                    $user->save();
                    return redirect('/change-password')->with('info', 'Password changed.');
                }
            } else {
                return redirect('/change-password')->with('info', 'Old password wrong.');


            }

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect('/change-password')->with('info', trans('app.error'));
        }
    }

    public function _getThankYouForOrder()
    {
        return view('frontend/order_processing');
    }

    public function _getTerms()
    {
        return view('frontend/legal_terms');
    }

    public function _getCookies()
    {
        return view('frontend/legal_cookies');
    }

}
