<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\File as Myfiles;
use File;

class FilesAdminController extends AdminController {

    const UPLOAD_URL = 'appfiles/files';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $file = Myfiles::paginate(10);
        return view('admin.files.files', ['files' => $file]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        return view('admin.files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        try {
            $this->validate($request, [


                'file' => 'required|mimes:pdf,txt,jpeg,jpg,png,doc,docx,xls,xlsx,ppt,pptx',
            ]);

//        public static $rules = array(
//    'destest' => 'regex:/[\d]{2},[\d]{2}/'
//);
            $filename = $request->file('file')->getClientOriginalName();
            $filext = $request->file('file')->getClientOriginalExtension();
            $logoname = $filename . str_random(10) . ".$filext";
            $pages = new Myfiles();
            $pages->name = $request->input('name');


            $pages->file = $logoname;
            $pages->save();

            File::makeDirectory(self::UPLOAD_URL . '/' . $pages->id, 0775, true, true);

            $file = $request->file('file')->move(self::UPLOAD_URL . '/' . $pages->id . '/', $logoname);



            return redirect('/admin/files')->with('product', 'File upload');
        } catch (Exception $e) {
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

    public function download($id) {
        $file = Myfiles::find($id);
        return response()->download(Myfiles::getFileUrl($file->id, $file->file));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $page = Myfiles::find($id);
        return view('admin.files.update', ['page' => $page]);
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

                'file' => 'required|mimes:pdf,txt,jpeg,jpg,png,doc,docx,xls,xlsx,ppt,pptx',
            ]);

            $id = $request->input('id');
            $filename = $request->file('file')->getClientOriginalName();
            $filext = $request->file('file')->getClientOriginalExtension();
            $logoname = $filename . str_random(10) . " $filext";

            $pages = Myfiles::find($id);
            $oldname = $pages->image;

            $pages->name = $request->input('name');


            $pages->file = $logoname;
            $pages->save();

            if (File::isDirectory(self::UPLOAD_URL . '/' . $pages->id . '/', $pages->image)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $pages->id);
                File::makeDirectory(self::UPLOAD_URL . '/' . $pages->id, 0775, true, true);
                $file = $request->file('file')->move(self::UPLOAD_URL . '/' . $pages->id . '/', $logoname);

                return redirect('/admin/files')->with("info", "Update file");
            } else {
                return redirect('/admin/files')->with('info', 'file no updated');
            }
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
            $page = Myfiles::findOrFail($id);
            $page->delete();
            if (File::isDirectory(self::UPLOAD_URL . '/' . $page->id . '/', $page->image)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $page->id);
                return redirect('/admin/files')->with('product', 'File deleted');
            } else {
                return redirect('/admin/files')->with('product', 'File no deleted');
            }
        } catch (Exception $e) {
            abort(404);
        }
    }

}
