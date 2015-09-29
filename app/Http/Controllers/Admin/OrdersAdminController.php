<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\Feedback;
use File;
use App\Order;

class OrdersAdminController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        try {
            //completed
            $product = Order::paginate(10);

            return view('admin.orders.index', ['orders' => $product]);
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function completed(Request $request)
    {

        $id = $request->input('complete');
        $order = Order::find($id);
        $order->order_status = 2;
        $order->save();
        return redirect('admin/orders');
    }
}
