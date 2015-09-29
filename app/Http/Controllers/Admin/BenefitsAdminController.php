<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\Benefit;
use File;

class BenefitsAdminController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    const UPLOAD_URL = 'appfiles/benefits';

    public function index() {
        $product = Benefit::orderBy('order', 'asc')->paginate(10);

        return view('admin.benefits.benefits', ['pages' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $page = Benefit::find($id);
        if ($page === null) {
            $page = new Benefit;
        }
        return view('admin.benefits.benefits_create_update', ['review' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        try {
            $this->validate($request, [
                'order' => 'required|integer',
               // 'icon' => 'required'
            ]);
            $id = $request->input('id');
            if ($request->input('order') < 1) {
                return redirect('/admin/benefits')->with('info', 'order can be only great than 1');
            }

            $page = Benefit::find($id);
            if ($page == null) {
                $page = new Benefit;
            }


            $page->description = $request->input('description');
            $page->order = $request->input('order');
             if ($request->hasFile('icon')) {
            $filename = $request->file('icon')->getClientOriginalName();
            $logoname = $filename . str_random(10) . ".jpg";
            $page->icon = $logoname;
                 $page->save();


            if (File::isDirectory(self::UPLOAD_URL . '/' . $page->id . '/', $page->icon)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $page->id);
                File::makeDirectory(self::UPLOAD_URL . '/' . $page->id, 0775, true, true);

                $file = $request->file('icon')->move(self::UPLOAD_URL . '/' . $page->id . '/', $logoname);
               
                return redirect('/admin/benefits')->with("photo", "Update photo OK");
            } else {
                $page->save();
                $file = $request->file('icon')->move(self::UPLOAD_URL . '/' . $page->id . '/', $logoname);

               
            }
             
             }
              $page->save();
             return redirect('/admin/benefits')->with('product', 'Product  updated');
            
        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        try {
            $page = Benefit::find($id);
            $page->delete();
            if (File::isDirectory(self::UPLOAD_URL . '/' . $page->id . '/', $page->icon)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $page->id);
            }
            return redirect('/admin/benefits')->with('info', 'Deleted');
        } catch (Exception $e) {
            abort(404);
        }
    }

}
