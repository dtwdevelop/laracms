<?php


 namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\Feedback;
use File;
class FeedbacksAdminController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    const UPLOAD_URL = 'appfiles/feeback';
    public function index()
    {
         $product = Feedback::paginate(10);
       
        return view('admin.feedbacks.feeds', ['pages' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $page = Feedback::find($id);
        if($page == null){
            $page = new Feedback;
        }
        return view('admin.feedbacks.feedbacks_create_update', ['review' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $page = Feedback::find($id);
        if($page == null){
            $page = new Feedback;
        }
        $page->client_name =$request->input('client_name');
        $page->client_quote =$request->input('client_quote');
        $page->is_active= $request->input('is_active');

        if ($request->hasFile('foto')) {
            $filename = $request->file('foto')->getClientOriginalName();
            $logoname = $filename . str_random(10) . ".jpg";
            $page->foto = $logoname;
            $page->save();


            if (File::isDirectory(self::UPLOAD_URL . '/' . $page->id . '/', $page->foto)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $page->id);
                File::makeDirectory(self::UPLOAD_URL . '/' . $page->id, 0775, true, true);

                $file = $request->file('foto')->move(self::UPLOAD_URL . '/' . $page->id . '/', $logoname);

                return redirect('/admin/feedbacks')->with("photo", "Update photo OK");
            } else {
                $file = $request->file('foto')->move(self::UPLOAD_URL . '/' . $page->id . '/', $logoname);
                $page->save();

            }

        }
        $page->save();
        return redirect('/admin/feedbacks')->with('info','Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $page = Feedback::findOrFail($id);
            $page->delete();
            if (File::isDirectory(self::UPLOAD_URL . '/' . $page->id . '/', $page->foto)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $page->id);
            }
            return redirect('/admin/feedbacks')->with('info', 'Deleted');
        }
        catch(Exception $e){
            abort(404);
        }
    }
}
