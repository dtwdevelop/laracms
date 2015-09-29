<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\Faq;

class FaqsAdminController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $product = Faq::orderBy('order', 'asc')->paginate(10);

        return view('admin.faqs.faqs', ['pages' => $product]);
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

        $page = Faq::find($id);
        if ($page == null) {
            $page = new Faq;
        }
        return view('admin.faqs.faqs_create_update', ['review' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        //
        $this->validate($request, [
            'order' => 'required|integer',
        ]);
        $id = $request->input('id');
        if ($request->input('order') < 1) {
            return redirect('/admin/faqs')->with('info', 'order can be only great than 1');
        }

        $page = Faq::find($id);
        if ($page == null) {
            $page = new Faq;
        }
        $page->question = $request->input('question');
        $page->answer = $request->input('answer');
        $page->order = $request->input('order');
        $page->save();
        return redirect('/admin/faqs')->with('info', 'Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        try {
            $page = Faq::find($id);
            $page->delete();
            return redirect('/admin/faqs')->with('info', 'Deleted');
        } catch (Exception $e) {
           abort(404);
        }
    }

}
