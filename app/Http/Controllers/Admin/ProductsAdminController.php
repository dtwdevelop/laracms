<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use App\Product;
use File;

class ProductsAdminController extends AdminController {

    const UPLOAD_URL = 'appfiles/products';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $product = Product::paginate(10);
        return view('admin.products.products_index', ['products' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        try {
            $this->validate($request, [
                // 'name' => 'required|max:200',
                'price' => 'required|numeric',
                'image' => 'required|image',
            ]);

//        public static $rules = array(
//    'destest' => 'regex:/[\d]{2},[\d]{2}/'
//);
            $filename = $request->file('image')->getClientOriginalName();
            $logoname = $filename . str_random(10) . ".jpg";
            $pages = new Product();
            $pages->name = $request->input('name');
            $pages->price = $request->input('price');

            $pages->image = $logoname;
            $pages->save();

            File::makeDirectory(self::UPLOAD_URL . '/' . $pages->id, 0775, true, true);

            $file = $request->file('image')->move(self::UPLOAD_URL . '/' . $pages->id . '/', $logoname);



            return redirect('/admin/products/')->with('product', 'Created new product');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $page = Product::findOrFail($id);

        return view('admin.products.update', ['product' => $page]);
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
                'name' => 'required|max:200',
                'price' => 'required|numeric',
               // 'image' => 'required|image',
            ]);

            $id = $request->input('id');
            $pages = Product::find($id);
            $pages->name = $request->input('name');
            $pages->price = $request->input('price');
             if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $logoname = $filename . str_random(10) . ".jpg";
            $oldname = $pages->image;
        
           

            $pages->image = $logoname;
            $pages->save();

            if (File::isDirectory(self::UPLOAD_URL . '/' . $pages->id . '/', $pages->image)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $pages->id);
                File::makeDirectory(self::UPLOAD_URL . '/' . $pages->id, 0775, true, true);
                $file = $request->file('image')->move(self::UPLOAD_URL . '/' . $pages->id . '/', $logoname);

                return redirect('/admin/products')->with("photo", "Product  updated");
            }
             }
             else {
                  $pages->save();
                return redirect('/admin/products')->with('product', 'Product  updated');
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
            $page = Product::findOrFail($id);
            $page->delete();
            if (File::isDirectory(self::UPLOAD_URL . '/' . $page->id . '/', $page->image)) {
                File::deleteDirectory(self::UPLOAD_URL . '/' . $page->id);
                return redirect('/admin/products')->with('product', 'Page  deleted');
            } else {
                return redirect('/admin/products')->with('product', ' Not Deleted');
            }
        } catch (Exception $e) {
            abort(404);
        }
    }

}
