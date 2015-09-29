<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\Advertising;
use Illuminate\Http\Request;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Session;
use Cookie;



class AdvertisingAdminController extends AdminController
{
	const UPLOAD_URL = 'appfiles/advertising';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$advertisings = Advertising::paginate(10);
		return view('admin.advertising.index', compact('advertisings'));
	}
	public function _active($id){
		$add  = Advertising::findOrFail($id);
        if($add->is_active ==0){
			Advertising::where('is_active',1)->update(['is_active' => 0]);
			$add->is_active=1;


            Session::put("reklama",$add);
			setcookie('reklama', null, -1, '/');
		}
		else{
			$add->is_active=0;

		}
        $add->save();

		return redirect('admin/advertising')->with("info", "Status change");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.advertising.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			//'title' => 'required|min:4',
			'image' => 'required|image|max:1024',
		]);
		$id = $request->input('id');
		$page = Advertising::find($id);
		if ($page == null) {
			$page = new Advertising;
		}
		$page->title = "";
		$page->text = "";
		if($request->has('is_active')){
			Advertising::where('is_active',1)->update(['is_active' => 0]);
			$page->is_active = 1;

		}
		else{
			$page->is_active=0;
		}
		if ($request->hasFile('image')) {
			$filename = $request->file('image')->getClientOriginalName();
			$logoname =  str_random(10) . ".".$request->file('image')->getClientOriginalExtension();
			$page->image = $logoname;
			$page->save();
			Session::put("reklama",$page);
			setcookie('reklama', null, -1, '/');

			if (File::isDirectory(self::UPLOAD_URL . '/' . $page->id . '/', $page->image)) {
				File::deleteDirectory(self::UPLOAD_URL . '/' . $page->id);
				File::makeDirectory(self::UPLOAD_URL . '/' . $page->id, 0775, true, true);

				$file = $request->file('image')->move(self::UPLOAD_URL . '/' . $page->id . '/', $logoname);

				return redirect('/admin/advertising')->with("info", "Update with image");
			} else {
				$file = $request->file('image')->move(self::UPLOAD_URL . '/' . $page->id . '/', $logoname);
				$page->save();
				return redirect('/admin/advertising')->with("info", "Create with image");
			}

		}
		//$page->image="";
		$page->save();

		return redirect('admin/advertising');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$advertising = Advertisings::findOrFail($id);
		return view('admin.advertising.show', compact('advertising'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$advertising = Advertising::findOrFail($id);
		return view('admin.advertising.edit', compact('advertising'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$advertising = Advertisings::findOrFail($id);
		$advertising->update($request->all());
		return redirect('admin/advertising');
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
			$page = Advertising::find($id);
			$page->delete();
			if (File::isDirectory(self::UPLOAD_URL . '/' . $page->id . '/', $page->image)) {
				File::deleteDirectory(self::UPLOAD_URL . '/' . $page->id);
			}
			return redirect('/admin/advertising')->with('info', 'Deleted');
		} catch (Exception $e) {
			abort(404);
		}
	}

}
