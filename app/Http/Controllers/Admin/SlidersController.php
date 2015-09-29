<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Slider;
use App\Http\Requests\Admin\SliderRequest;
use App\Http\Requests\Admin\SliderEditRequest;

class SlidersController extends AdminController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate() {
        $title = trans('admin/sliders.add_slider');
        return view('admin.sliders.create_edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(SliderRequest $request) {
        $slider = new Slider();
        $this->createOrEdit($request, $slider);
        return redirect()->intended('admin/sliders')
            ->with('message', sprintf(trans('admin/sliders.message_created_ok'), $request->title_en));
    }

    protected function createOrEdit($request, Slider $slider){

        $slider -> title_en = $request->title_en;
        $slider -> title_ru = "";
        $slider -> title_lv = "";
        $slider -> name = $request->name;

        $icon_file = "";
        if($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $icon_file = sha1($filename . time()) . '.' . $extension;
            $slider -> icon = $icon_file;
        }

        $slider -> save();

        if($request->hasFile('icon'))
        {
            $destinationPath = public_path() . '/appfiles/sliders/'.$slider->id.'/';
            $request->file('icon')->move($destinationPath, $icon_file);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slider
     * @return Response
     */
    public function getEdit($id) {

        $slider = Slider::find($id);
        $title = trans('admin/sliders.edit_slider') . ' "' . $slider->title_en . '"';
        return view('admin.sliders.create_edit', compact('slider', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $slider
     * @return Response
     */
    public function postEdit(SliderEditRequest $request, $id) {
        $slider = Slider::find($id);
        $this->createOrEdit($request, $slider);
        return redirect()->intended('admin/sliders')
            ->with('message', sprintf(trans('admin/sliders.message_edited_ok'), $slider->title_en));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $slider
     * @return Response
     */

    public function getDelete($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        // Show the page
        return redirect()->intended('admin/sliders')
            ->with('message', sprintf(trans('admin/sliders.message_deleted_ok'), $slider->title_en));
    }

}
