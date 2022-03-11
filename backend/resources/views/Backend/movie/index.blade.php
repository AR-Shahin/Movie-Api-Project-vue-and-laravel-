@extends('layouts.backend_master')
@section('title', 'Movie')
@section('master_content')
    <div class="row justify-content-center pt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.movie.all') }}" class="btn btn-success">All Movie</a> <br><br>
                    <form method="POST" action="{{ url('api/v1/movies') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control" name="name"> <br>
                        <input type="number" class="form-control" name="duration"> <br>
                        <textarea name="description" id="" class="form-control" cols="30" rows="5"></textarea> <br>
                        <select name="category_id" id="" class="form-control">
                            <option value="">Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select> <br>
                        <input type="file" class="form-control" name="image"> <br>
                        <button class="btn btn-sm btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
