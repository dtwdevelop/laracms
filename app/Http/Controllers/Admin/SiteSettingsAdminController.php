<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\SiteSetting;
use App\SiteSocial;
use File;

class SiteSettingsAdminController extends AdminController {

    const UPLOAD_URL = 'appfiles/site_settings';
    const UPLOAD_ICON = 'appfiles/site_socials';
    const UPLOAD_SOC = 'appfiles/site_socials/icon';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $setting = SiteSetting::all()->last();
        if ($setting == null)
            $setting = new SiteSetting;
        $social = SiteSocial::all();

        if ($social == null)
            $social = 0;


        return view('admin.setting.site_settings', ['settings' => $setting, "socials" => $social]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
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
        //
    }

    public function createsocial(Request $request) {
        try {
            $data = $request->all();
            // dd($data);
            for ($i = 0; $i < count($data['name']); $i++) {

//                 $this->validate($request, [
//            'order'.$i => 'integer',
//            'icon'.$i => 'required',
//            
//        ]);

                $pages = SiteSocial::find($data['id'][$i]);


                $pages->name = $data['name'][$i];
                $pages->link = $data['link'][$i];
                $pages->order = (int) $data['order'][$i];

                if ($data['icon'][$i] != null) {


                    $file = $data['icon'][$i]->getClientOriginalName();
                    $iconfile = $file . str_random(10) . ".jpg";
                    $pages->icon = $iconfile;


                    if (File::isDirectory(self::UPLOAD_SOC . '/' . $pages->id . '/', $iconfile)) {
                        File::deleteDirectory(self::UPLOAD_SOC . '/' . $pages->id);
                        File::makeDirectory(self::UPLOAD_SOC . '/' . $pages->id, 0775, true, true);
                        $file = $data['icon'][$i]->move(self::UPLOAD_SOC . '/' . $pages->id . '/', $iconfile);
                    } else {
                        File::makeDirectory(self::UPLOAD_SOC . '/' . $pages->id, 0775, true, true);
                        $file = $data['icon'][$i]->move(self::UPLOAD_SOC . '/' . $pages->id . '/', $iconfile);
                    }
                } else {
                    $pass = "";
                    // $pages->icon = "";
                }
                $pages->save();
            }
            return redirect('/admin/site_settings')->with("info", "Update p OK");
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function addsoc(Request $request) {
        try {
            $data = $request->all();
            for ($i = 0; $i < count($data['name']); $i++) {
                $this->validate($request, [
                    "order" . $i => 'integer',
                ]);

                $pages = new SiteSocial;
                $pages->name = $data['name'][$i];
                $pages->link = $data['link'][$i];
                $pages->order = (int) $data['order'][$i];

                if ($data['icon'][$i] != null) {

                    $file = $data['icon'][$i]->getClientOriginalName();
                    $iconfile = $file . str_random(10) . ".jpg";
                    $pages->icon = $iconfile;
                    $pages->save();
                    File::makeDirectory(self::UPLOAD_SOC . '/' . $pages->id, 0775, true, true);
                    $data['icon'][$i]->move(self::UPLOAD_SOC . '/' . $pages->id . '/', $iconfile);
                } else {
                    $pages->icon = "";

                    $pages->save();
                }
                return redirect('/admin/site_settings/')->with('info', 'Add new');
            }
        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        // dd($request);
        try {
            $this->validate($request, [
                'name' => 'required|max:200',
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'logo' => 'required|image',
                'favicon' => 'required|image',
            ]);

            $id = $request->input('id');
            // dd($id);
            if ($id == "") {
                $pages = New SiteSetting();
            } else {
                $pages = SiteSetting::find($id);
            }
            $filename = $request->file('logo')->getClientOriginalName();
            $logoname = $filename . str_random(10) . ".jpg";

            $filename2 = $request->file('favicon')->getClientOriginalName();
            $logoname2 = $filename . str_random(10) . ".jpg";





            $pages->name = $request->input('name');
            $pages->meta_description = $request->input('meta_description');
            $pages->meta_keywords = $request->input('meta_keywords');
            $pages->title = $request->input('title');
            $pages->logo = $logoname;
            $pages->favicon = $logoname2;

            $pages->save();

            if (File::isDirectory(self::UPLOAD_URL . '/' . $pages->id . '/', $pages->image)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $pages->id);
                File::makeDirectory(self::UPLOAD_URL . '/' . $pages->id, 0775, true, true);
                $file = $request->file('logo')->move(self::UPLOAD_URL . '/' . $pages->id . '/', $logoname);
                $file = $request->file('favicon')->move(self::UPLOAD_URL . '/' . $pages->id . '/', $logoname2);
                return redirect('/admin/site_settings')->with("info", "Update p OK");
            } else {
                File::makeDirectory(self::UPLOAD_URL . '/' . $pages->id, 0775, true, true);
                $file = $request->file('logo')->move(self::UPLOAD_URL . '/' . $pages->id . '/', $logoname);
                $file = $request->file('favicon')->move(self::UPLOAD_URL . '/' . $pages->id . '/', $logoname2);

                return redirect('/admin/site_settings')->with('info', 'Created');
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
            $page = SiteSocial::findOrFail($id);
            $page->delete();
            if (File::isDirectory(self::UPLOAD_SOC . '/' . $page->id . '/', $page->icon)) {
                File::deleteDirectory(self::UPLOAD_SOC . '/' . $page->id);
                return redirect('/admin/site_settings')->with('info', ' Deleted');
            } else {
                return redirect('/admin/site_settings')->with('info', ' Deleted');
            }
        } catch (Exception $e) {
            abort(404);
        }
    }

}
