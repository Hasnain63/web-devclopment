<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Color::all();
        return view('admin/color', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_color(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Color::where(['id' => $id])->get();
            $result['color'] = $arr['0']->color;
            $result['status'] = $arr['0']->status;
            $result['id'] = $arr['0']->id;
        } else {
            $result['color'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }
        // print_r($result);
        // die;
        return view('admin/manage_color', $result);
    }
    public function manage_color_process(Request $request)
    {

        $validator = validator::make($request->all(), [
            'color' => 'required|unique:colors,color,' . $request->post('id'),
        ]);

        if ($validator->fails()) {
            // error
            return redirect('admin/manage_color')->withErrors($validator)->withInput();
        }
        if ($request->post('id') > 0) {
            $model = Color::find($request->post('id'));
            $msg = "Color Updated";
        } else {
            $model = new Color();
            $msg = "Color inserted";
        }
        $model->color = $request->post('color');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message',  $msg);
        return redirect('admin/color');
    }
    public function delete(Request $request, $id)
    {
        $model = Color::find($id);
        $model->delete();
        $request->session()->flash('message', 'color Deleted');
        return redirect('admin/color');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Color::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/color');
    }
}