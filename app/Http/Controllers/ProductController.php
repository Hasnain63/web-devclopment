<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Product::all();
        return view('admin/product', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_product(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Product::where(['id' => $id])->get();
            $result['category_id'] = $arr['0']->category_id;
            $result['name'] = $arr['0']->name;
            $result['slug'] = $arr['0']->slug;
            $result['brand'] = $arr['0']->brand;
            $result['model'] = $arr['0']->model;
            $result['image'] = $arr['0']->image;
            $result['short_desc'] = $arr['0']->short_desc;
            $result['desc'] = $arr['0']->desc;
            $result['keywords'] = $arr['0']->keywords;
            $result['technical_spacification'] = $arr['0']->technical_spacification;
            $result['uses'] = $arr['0']->uses;
            $result['warranty'] = $arr['0']->warranty;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['category_id'] = '';
            $result['name'] = '';
            $result['slug'] = '';
            $result['brand'] = '';
            $result['model'] = '';
            $result['image'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['keywords'] = '';
            $result['technical_spacification'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }
        // print_r($result);
        // die;
        $result['category'] = DB::table('categories')->where(['status' => 1])->get();
        return view('admin/manage_product', $result);
    }
    public function manage_product_process(Request $request)
    {
        if ($request->post('id') > 0) {
            $image_validation = 'mimes:jpeg,png,jgp';
        } else {
            $image_validation = 'required|mimes:jpeg,png,jgp';
        }
        $validator = validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' =>  $image_validation,
            'slug' => 'required|unique:products,slug,' . $request->post('id'),

        ]);

        if ($validator->fails()) {
            // error
            return redirect('admin/manage_product')->withErrors($validator)->withInput();
        }
        if ($request->post('id') > 0) {
            $model = Product::find($request->post('id'));
            $msg = "product Updated";
        } else {
            $model = new Product();
            $msg = "product inserted";
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->storeAS('/public/media', $image_name);
            $model->image = $image_name;
        }
        $model->category_id = $request->post('category_id');
        $model->name = $request->post('name');
        $model->slug = $request->post('slug');
        $model->brand = $request->post('brand');
        $model->model = $request->post('model');
        // $model->image = $request->post('image');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->technical_spacification = $request->post('technical_spacification');
        $model->uses = $request->post('uses');
        $model->warranty = $request->post('warranty');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message',  $msg);
        return redirect('admin/product');
    }
    public function delete(Request $request, $id)
    {
        $model = Product::find($id);
        $model->delete();
        $request->session()->flash('message', 'product Deleted');
        return redirect('admin/product');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/product');
    }
}