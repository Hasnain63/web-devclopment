<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Coupon::all();
        return view('admin/coupon', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_coupon(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Coupon::where(['id' => $id])->get();
            $result['title'] = $arr['0']->title;
            $result['code'] = $arr['0']->code;
            $result['value'] = $arr['0']->value;
            $result['id'] = $arr['0']->id;
        } else {
            $result['title'] = '';
            $result['code'] = '';
            $result['value'] = '';
            $result['id'] = 0;
        }
        // print_r($result);
        // die;
        return view('admin/manage_coupon', $result);
    }
    public function manage_coupon_process(Request $request)
    {

        $validator = validator::make($request->all(), [
            'title' => 'required|max:255',
            'code' => 'required|unique:coupons,code,' . $request->post('id'),
            'value' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            // error
            return redirect('admin/manage_coupon')->withErrors($validator)->withInput();
        }
        if ($request->post('id') > 0) {
            $model = Coupon::find($request->post('id'));
            $msg = "Coupon Updated";
        } else {
            $model = new Coupon();
            $msg = "Coupon inserted";
        }
        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');
        $model->save();
        $request->session()->flash('message',  $msg);
        return redirect('admin/coupon');
    }
    public function delete(Request $request, $id)
    {
        $model = Coupon::find($id);
        $model->delete();
        $request->session()->flash('message', 'Coupon Deleted');
        return redirect('admin/coupon');
    }
    public function status(Request $request, $status, $id)
    {
        $model = Coupon::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/coupon');
    }
}