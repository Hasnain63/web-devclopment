@extends('admin/layout');
@section('page_title','Manage Category')
@section('category_select','active')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Manage Category</h1>
            <a href="{{url('admin/category')}}"> <button type="button" class="btn btn-secondary">Back </button></a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4 mb-4">
            <div class="card ">
                <form action="{{route('manage_category_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="category_name" class="control-label ml-4 mb-1">Category Name</label>
                        <input id="category_name" name="category_name" type="text"
                            value="{{old('category_name',$category_name)}}"
                            class="form-control {{($errors->any() && $errors->first('category_name'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('category_name')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="category_slug" class="control-label ml-4 mb-1 ">Category Slug</label>
                        <input id="category_slug" name="category_slug" type="text"
                            value="{{old('category_slug',$category_slug)}}"
                            class="form-control {{($errors->any() && $errors->first('category_slug'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('category_slug')}}</p>
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