@extends('admin/layout');
@section('page_title','Manage Coupon')
@section('coupon_select','active')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Manage Coupon</h1>
            <a href="{{url('admin/coupon')}}"> <button type="button" class="btn btn-secondary">Back </button></a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4 mb-4">
            <div class="card ">
                <form action="{{route('manage_coupon_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="control-label ml-4 mb-1">Coupon Title</label>
                        <input id="title" name="title" type="text" value="{{old('title',$title)}}"
                            class="form-control {{($errors->any() && $errors->first('title'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('title')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="code" class="control-label ml-4 mb-1 ">Coupon Code </label>
                        <input id="code" name="code" type="text" value="{{old('code',$code)}}"
                            class="form-control {{($errors->any() && $errors->first('code'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('code')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="value" class="control-label ml-4 mb-1 ">Coupon Value</label>
                        <input id="value" name="value" type="text" value="{{old('value',$value)}}"
                            class="form-control {{($errors->any() && $errors->first('value'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('value')}}</p>
                        @endif
                    </div>
                    <input type="hidden" name="id" value="{{$id}}">
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection