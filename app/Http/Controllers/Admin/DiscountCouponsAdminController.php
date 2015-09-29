<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\DiscountCoupons;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;
use Session;
use Exception;
use Log;

class DiscountCouponsAdminController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $discount_coupons = DiscountCoupons::paginate(10);

        return view('admin.discount_coupons.index', compact('discount_coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.discount_coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $this->validate($request,
                ['code' => 'required|unique:discount_coupons', 'sum' => 'required|max:8', 'valid_till' => 'required']);
            // Uncomment and modify if needed.
            $disc = new DiscountCoupons;
            $disc->code = $request->input('code');
            $disc->sum = $request->input('sum');
            $disc->valid_till = $request->input('valid_till');
            $disc->is_activated = 0;
            $disc->is_sent = 0;
            $disc->save();
            $d = date('M d Y', strtotime($request->input('valid_till')));
            $message = "Coupon for sum {$request->input('sum')} was genirated with code {$request->input('code')} and valid till $d";

            return redirect('admin/discount_coupons')->with('info', $message);
        } catch (Exception $e) {
            return redirect('admin/discount_coupons')->with('info', $e->getMessage());
        }
    }

    public function _getSendEmail($id)
    {
        $coupon = DiscountCoupons::findOrFail($id);

        return view('admin.discount_coupons.couponmail', ['coupon' => $coupon]);
    }

    public function _sendToEmail(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:4',
                'email' => 'required|email',
            ]);
            $coupon = DiscountCoupons::findOrFail($request->input('id'));
            if ($coupon->is_activated == 1) {
                return redirect('admin/discount_coupons')->with('info',
                    "Unnable to send coupon by email. Coupon was already activated or expired");

            }
            $coupon->is_sent = 1;
            $coupon->save();
            $this->mail_to = $request->input('email');
            // dd($request);

            send_mail(
                $this->mail_to,
                'admin_discount_coupon_send',
                array(
                    'name' => $request->input('name'),
                    'code' => $coupon->code,
                    'expire' => $coupon->valid_till,
                    'sum' => $coupon->sum
                )
            );

            return redirect('admin/discount_coupons')->with(
                'info',
                "Coupon code was sent to {$request->input('name')} {$request->input('email')}");

        } catch (Exception $e) {
            return redirect('admin/discount_coupons')->with('info', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $discount_coupon = DiscountCoupons::findOrFail($id);

        return view('discount_coupons.show', compact('discount_coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $discount_coupon = DiscountCoupons::findOrFail($id);

        return view('discount_coupons.edit', compact('discount_coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        //$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
        $discount_coupon = DiscountCoupons::findOrFail($id);
        $discount_coupon->update($request->all());

        return redirect('admin/discount_coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        DiscountCoupons::destroy($id);
        if (Session::has('code')) {
            Session::forget('code');
        }

        return redirect('admin/discount_coupons');
    }

}
