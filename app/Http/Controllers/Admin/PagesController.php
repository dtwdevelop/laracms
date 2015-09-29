<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\Page;
use File;

class PagesController extends AdminController {

    const UPLOAD_URL = 'appfiles/pages';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $pages = Page::orderBy('title', 'asc')->paginate(10);

        return view('admin.pages.pages', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
//        
         try{
        $this->validate($request, [
            'title' => 'required|max:200',
            'content' => 'required',
            'file' => 'image',
        ]);


        $pages = new Page();
        $pages->title = $request->input('title');
        $pages->meta_description = $request->input('meta_description');
        $pages->meta_keywords = $request->input('meta_keywords');
        $pages->content = $request->input('content');
        if ($request->hasFile('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $logoname = $filename . str_random(10) . ".jpg";
            $pages->image = $logoname;
            $pages->save();
            File::makeDirectory(self::UPLOAD_URL . '/' . $pages->id, 0775, true, true);

            $file = $request->file('file')->move(self::UPLOAD_URL . '/' . $pages->id . '/', $logoname);
        } else {
            $pages->image = "";
            $pages->save();
        }


        return redirect('/admin/pages/')->with('photo', 'Created new page');
         }
         catch(Exception $e){
             abort(404);
         }
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
        $page = Page::findOrFail($id);
        return view('admin.pages.update', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        //
        try {
            $this->validate($request, [
                'title' => 'required|max:200',
                'content' => 'required',
            ]);
            $id = $request->input('id');

            $pages = Page::find($id);


            $pages->title = $request->input('title');
            $pages->meta_description = $request->input('meta_description');
            $pages->meta_keywords = $request->input('meta_keywords');
            $pages->content = $request->input('content');
//        if($request->hasFile('image')){
//        $filename = $request->file('file')->getClientOriginalName();
//        $logoname = $filename . str_random(10) . ".jpg";
//        $pages->image = $logoname;
//        }


            $pages->save();

//        if (File::isDirectory(self::UPLOAD_URL.'/'.$pages->id.'/',$pages->image)) {
//             File::deleteDirectory(self::UPLOAD_URL.'/'.$pages->id);
//              File::makeDirectory(self::UPLOAD_URL . '/' . $pages->id, 0775, true, true); 
//             $file = $request->file('file')->move(self::UPLOAD_URL.'/'. $pages->id.'/',$logoname);
//             return redirect('/admin/pages')->with("photo","Update photo OK");
//        }
//        else{
//            return redirect('/admin/pages')->with('Page no updated');
//        }

            return redirect('/admin/pages')->with('Page no updated');
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
        try {
            $page = Page::find($id);
            $page->delete();
            if (File::isDirectory(self::UPLOAD_URL . '/' . $page->id . '/', $page->image)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $page->id);
                return redirect('/admin/pages')->with('Page deleted');
            } else {
                return redirect('/admin/pages')->with('Page file no deleted');
            }
        } catch (Exception $e) {
            abort(404);
        }
    }

}
