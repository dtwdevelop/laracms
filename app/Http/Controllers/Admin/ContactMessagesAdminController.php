<?php


 namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\AdminController;

use App\ContactMessage;


class ContactMessagesAdminController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $messages = ContactMessage::paginate(10);
        return view('admin.messages.contact_messages',['messages'=>$messages]);
        
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
        $review = ContactMessage::findOrFail($id);
        
        $review->is_reviewed=1;
        $review->save();
       return  redirect('/admin/contact_messages');
    }
    
     public function view($id)
    {
        $review = ContactMessage::findOrFail($id);
        
        return view('admin.messages.view',['review'=>$review]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        $message = ContactMessage::findOrFail($id);
        $message->is_reviewed = $request->input('is_reviewed');
        $message->save();
        return redirect('/admin/contact_messages')->with('info','Review change');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
