@extends('admin/layout');
@section('page_title','Manage Size')
@section('size_select','active')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Manage Size</h1>
            <a href="{{url('admin/size')}}"> <button type="button" class="btn btn-secondary">Back </button></a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4 mb-4">
            <div class="card ">
                <form action="{{route('manage_size_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="size" class="control-label ml-4 mb-1">Size</label>
                        <input id="size" name="size" type="text" value="{{old('size',$size)}}"
                            class="form-control {{($errors->any() && $errors->first('size'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('size')}}</p>
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