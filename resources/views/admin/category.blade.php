@extends('admin/layout');
@section('page_title','Category')
@section('category_select','active')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Category</h1>
            <a href="{{url('admin/category/manage_category')}}"> <button type="button" class="btn btn-success">Add
                    Category</button></a>
        </div>
        <div class="col-md-12 mt-4 mb-4">
            <!-- DATA TABLE-->
            @if(Session::has('message'))
            <div class="col-md-12">
                <div class="alert alert-success">{{Session::get('message')}}</div>
            </div>
            @endif
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{ $list->id}}</td>
                            <td>{{ $list->category_name}}</td>
                            <td>{{ $list->category_slug}}</td>
                            <td>
                                <a href="{{url('admin/category/manage_category/')}}/{{$list->id}}"
                                    class="btn btn-primary btn btn-sm">Edit</a>
                                @if($list->status==1)
                                <a href="{{url('admin/category/status/0')}}/{{$list->id}}"
                                    class="btn btn-primary btn btn-sm">Active</a>
                                @elseif($list->status==0)
                                <a href="{{url('admin/category/status/1')}}/{{$list->id}}"
                                    class="btn btn-warning btn btn-sm">Deactive</a>
                                @endif

                                <a href="{{url('admin/category/delete/')}}/{{$list->id}}"
                                    class="btn btn-danger btn btn-sm">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
</div>

@endsection