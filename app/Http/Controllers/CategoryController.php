<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Category::all();
        return view('admin/category', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_category(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Category::where(['id' => $id])->get();
            $result['category_name'] = $arr['0']->category_name;
            $result['category_slug'] = $arr['0']->category_slug;
            $result['id'] = $arr['0']->id;
        } else {
            $result['category_name'] = '';
            $result['category_slug'] = '';
            $result['id'] = 0;
        }
        // print_r($result);
        // die;
        return view('admin/manage_category', $result);
    }
    public function manage_category_process(Request $request)
    {

        $validator = validator::make($request->all(), [
            'category_name' => 'required|max:255',
            'category_slug' => 'required|unique:categories,category_slug,' . $request->post('id'),

        ]);

        if ($validator->fails()) {
            // error
            return redirect('admin/manage_category')->withErrors($validator)->withInput();
        }
        if ($request->post('id') > 0) {
            $model = Category::find($request->post('id'));
            $msg = "Category Updated";
        } else {
            $model = new Category();
            $msg = "Category inserted";
        }
        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message',  $msg);
        return redirect('admin/category');
    }
    public function delete(Request $request, $id)
    {
        $model = Category::find($id);
        $model->delete();
        $request->session()->flash('message', 'Category Deleted');
        return redirect('admin/category');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Category::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/category');
    }
}