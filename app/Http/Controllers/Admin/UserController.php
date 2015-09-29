<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\DeleteRequest;
use Datatables;
use DB;
use Mail;
use Exception;
use Log;


class UserController extends AdminController {

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate() {
        return view('admin.users.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(UserRequest $request)
    {
        try {

            $name = $request->first_name . ' ' . $request->last_name;

            $user = new User ();
            $user -> name = $name;
            $user -> first_name = $request->first_name;
            $user -> last_name = $request->last_name;
            $user -> username = $request->email;
            $user -> email = $request->email;
            $user -> password = bcrypt($request->password);
            $user -> confirmation_code = str_random(32);
            $user -> confirmed = $request->confirmed;
            $user -> admin = $request->admin;
            $user -> save();

            Mail::send(
                'emails.admin_user_created',
                ['user' =>$request, 'name' => $name],
                function ($message) use ($request, $name) {
                    $message->from(config('mail.info_email'), config('mail.info_email_name'));
                    $message->to($request->email, $name);
                    $message->subject(config('mail.subject_admin_user_created'));
                }
            );

        } catch ( Exception $e) {
            echo $e->getMessage();
            Log::error($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit($id) {

        $user = User::find($id);
        return view('admin.users.create_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function postEdit(UserEditRequest $request, $id) {

        $user = User::find($id);
        $user -> name = $request->first_name . ' ' . $request->last_name;
        $user -> first_name = $request->first_name;
        $user -> last_name = $request->last_name;
        $user -> confirmed = $request->confirmed;
        $user -> admin = $request->admin;

        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user -> password = bcrypt($password);
            }
        }
        $user -> save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function getDelete($id)
    {
        $user = User::find($id);
        // Show the page
        return view('admin.users.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $user= User::find($id);
        $user->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $users = User::select(array('users.id','users.name','users.email','users.phone','users.confirmed','users.admin', 'users.created_at'))->orderBy('users.created_at', 'DESC');

        return Datatables::of($users)
            ->filterColumn('name', 'where', \Input::get('name'))
            ->set_row_class(function($user){if ($user->admin == "1") return 'info';})
            ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->edit_column('admin', '@if ($admin=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    @if ($admin != "1")<a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                @endif')
            ->remove_column('id')
            ->make();
    }

}
