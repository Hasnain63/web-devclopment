@extends('admin/layout');
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Manage Product</h1>
            <a href="{{url('admin/product')}}"> <button type="button" class="btn btn-secondary">Back </button></a>
        </div>
    </div>
</div>
@if($id>0)
{{$image_required=""}}
@else
{{$image_required="required"}}
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4 mb-4">
            <div class="card ">
                <form action="{{route('manage_product_process')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="control-label ml-4 mb-1">Product Name</label>
                        <input id="name" name="name" type="text" value="{{old('name',$name)}}"
                            class="form-control {{($errors->any() && $errors->first('name'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('name')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="slug" class="control-label ml-4 mb-1 ">Product Slug</label>
                        <input id="slug" name="slug" type="text" value="{{old('slug',$slug)}}"
                            class="form-control {{($errors->any() && $errors->first('slug'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('slug')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label ml-4 mb-1 ">Product Image</label>
                        <input id="image" name="image" type="file"
                            class="form-control {{($errors->any() && $errors->first('image'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false" {{$image_required}}>
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('image')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="category_id" class="control-label ml-4 mb-1">Category id</label>
                                <select id="category_id" name="category_id" type="text"
                                    value="{{old('category_id',$category_id)}}"
                                    class="form-control {{($errors->any() && $errors->first('category_id'))?'is-invalid':''}} "
                                    aria-required="true" aria-invalid="false">
                                    <option value="">Select Category</option>
                                    @foreach($category as $list)

                                    @if($category_id == $list->id)
                                    <option selected value="{{$list->id}}">
                                        @else
                                    <option value="{{$list->id}}">
                                        @endif
                                        {{$list->category_name}}
                                    </option>
                                    @endforeach
                                </select>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('category_id')}}</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="brand" class="control-label ml-4 mb-1 ">Brand</label>
                                <input id="brand" name="brand" type="text" value="{{old('brand',$brand)}}"
                                    class="form-control {{($errors->any() && $errors->first('brand'))?'is-invalid':''}} "
                                    aria-required="true" aria-invalid="false">
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('brand')}}</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="model" class="control-label ml-4 mb-1 ">Model</label>
                                <input id="model" name="model" type="text" value="{{old('model',$model)}}"
                                    class="form-control {{($errors->any() && $errors->first('model'))?'is-invalid':''}} "
                                    aria-required="true" aria-invalid="false">
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('model')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="short_desc" class="control-label ml-4 mb-1 ">Short_desc</label>
                        <textarea id="short_desc" name="short_desc" type="text"
                            class="form-control {{($errors->any() && $errors->first('short_desc'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">{{old('short_desc',$short_desc)}}</textarea>
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('short_desc')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="desc" class="control-label ml-4 mb-1 ">Desc</label>
                        <textarea id="desc" name="desc" type="text"
                            class="form-control {{($errors->any() && $errors->first('desc'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">{{old('desc',$desc)}} </textarea>

                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('desc')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="keywords" class="control-label ml-4 mb-1 ">Keywords</label>
                        <input id="keywords" name="keywords" type="text" value="{{old('keywords',$keywords)}}"
                            class="form-control {{($errors->any() && $errors->first('keywords'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('keywords')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="technical_spacification"
                            class="control-label ml-4 mb-1 ">Technical_spacification</label>
                        <input id="technical_spacification" name="technical_spacification" type="text"
                            value="{{old('technical_spacification',$technical_spacification)}}"
                            class="form-control {{($errors->any() && $errors->first('technical_spacification'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('technical_spacification')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="uses" class="control-label ml-4 mb-1 ">Uses</label>
                        <input id="uses" name="uses" type="text" value="{{old('uses',$uses)}}"
                            class="form-control {{($errors->any() && $errors->first('uses'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('uses')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="warranty" class="control-label ml-4 mb-1 ">Warranty</label>
                        <input id="warranty" name="warranty" type="text" value="{{old('warranty',$warranty)}}"
                            class="form-control {{($errors->any() && $errors->first('warranty'))?'is-invalid':''}} "
                            aria-required="true" aria-invalid="false">
                        @if($errors->any())
                        <p class="invalid-feedback">{{$errors->first('warranty')}}</p>
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