<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Size::all();
        return view('admin/size', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_size(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Size::where(['id' => $id])->get();
            $result['size'] = $arr['0']->size;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['size'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }
        // print_r($result);
        // die;
        return view('admin/manage_size', $result);
    }
    public function manage_size_process(Request $request)
    {

        $validator = validator::make($request->all(), [
            'size' => 'required|unique:sizes,size,' . $request->post('id'),
        ]);

        if ($validator->fails()) {
            // error
            return redirect('admin/manage_size')->withErrors($validator)->withInput();
        }
        if ($request->post('id') > 0) {
            $model = Size::find($request->post('id'));
            $msg = "Size Updated";
        } else {
            $model = new Size();
            $msg = "Size inserted";
        }
        $model->size = $request->post('size');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message',  $msg);
        return redirect('admin/size');
    }
    public function delete(Request $request, $id)
    {
        $model = Size::find($id);
        $model->delete();
        $request->session()->flash('message', 'size Deleted');
        return redirect('admin/size');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/size');
    }
}