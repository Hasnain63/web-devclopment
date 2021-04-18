@extends('admin/layout');
@section('page_title','Manage Color')
@section('color_select','active')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Manage Color</h1>
            <a href="{{url('admin/color')}}"> <button type="button" class="btn btn-secondary">Back </button></a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4 mb-4">
            <div class="card ">
                <form action="{{route('manage_color_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="color" class="control-label ml-4 mb-1">Color</label>
                        <input id="color" name="color" type="text" value="{{old('color',$color)}}"
                            class="form-control {{($errors->any() && $errors->first('color'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('color')}}</p>
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