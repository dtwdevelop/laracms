<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\DBConfiguration as cfg;
use App\Http\Requests\Admin\ConfigRequest;

class ConfigController extends AdminController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $config = cfg::orderBy('key')->get();
        return view('admin.config.index', compact('config'));
    }

    public function postUpdate(ConfigRequest $request) {
        $cfg = new cfg();
        $cfg->insertOrUpdate($request);
        return redirect()->intended('admin/config')
            ->with('message', sprintf(trans('admin/config.message_updated_ok')));
    }

}
