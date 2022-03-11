@extends('layouts.backend_master')
@section('title', 'Movie')
@section('master_content')
    <div class="row justify-content-center pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.movie.index') }}" class="btn btn-success">Create</a>
                    <br> <br>
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Image</th>
                        </tr>
                        @foreach ($movies as $movie)
                            <tr>
                                <td>{{ $movie->id }}</td>
                                <td>{{ $movie->name }}</td>
                                <td>{{ $movie->category->name }}</td>
                                <td><img src="{{ asset($movie->image) }}" alt="" width="100px"></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
