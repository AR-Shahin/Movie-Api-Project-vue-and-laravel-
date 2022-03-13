<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Actions\File\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{

    public function viewAllMovie()
    {
        $movies = Movie::with('category')->latest()->get();
        return view('Backend.movie.all', compact('movies'));
    }
    public function viewWeb()
    {
        $categories = Category::all();
        // $movie = Movie::first();
        return view('Backend.movie.index', compact('categories'));
    }
    public function index()
    {
        try {
            $data = Movie::latest()->get();
            if ($data->count() != 0) {
                return sendSuccessResponse($data->load('category'), 'Data Retrieved Successfully!');
            } else {
                return sendSuccessResponse($data, 'Data not found!');
            }
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }
    public function store(Request $request)
    {
        //  return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:movies,name'],
            'category_id' => ['required', 'numeric'],
            'description' => ['required'],
            'duration' => ['required'],
            'image' => ['required', 'image', 'mimes:jpg,png'],
        ]);

        if ($validator->fails()) {
            return sendErrorResponse('Data Validation Error!', $validator->errors(), 422);
        }

        $data = $validator->validated();
        $data['slug'] = Str::slug($data['name']);
        $data['image'] = File::upload($request->file('image'), 'movie');

        try {
            $movie = Movie::create($data);
            if ($movie) {
                return sendSuccessResponse($movie, 'Data Created Successfully!', 201);
            }
        } catch (QueryException $e) {
            return sendErrorResponse("Something Went Wrong! {$e->getMessage()}", 500);
        }
    }
    public function show($slug)
    {
        try {
            $movie = Movie::whereSlug($slug)->first();
            if ($movie) {
                return sendSuccessResponse($movie->load(['category', 'reviews']), 'Data Retrieved Successfully!');
            } else {
                return sendSuccessResponse([], 'Data Not Found!', 404);
            }
        } catch (QueryException $e) {
            return sendErrorResponse([], "Something went wrong! {$e->getMessage()}", 400);
        }
    }

    public function update(Request $request, $slug)
    {

        try {
            $movie = Movie::whereSlug($slug)->first();
            if ($movie) {
                if ($request->hasFile('image')) {
                    $validator = Validator::make($request->all(), [
                        'name' => ['required', 'unique:movies,name,' . $movie->id],
                        'description' => ['required'],
                        'duration' => ['required'],
                        'image' => ['required', 'image', 'mimes:jpg,png'],
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'name' => ['required', 'unique:movies,name,' . $movie->id],
                        'duration' => ['required'],
                        'description' => ['required'],
                    ]);
                }

                if ($validator->fails()) {
                    return sendErrorResponse('Data Validation Error!', $validator->errors(), 422);
                } else {
                    $oldImg = $movie->image;
                    $data = $validator->validated();
                    $data['slug'] = Str::slug($data['name']);
                    if ($request->hasFile('image')) {
                        $data['image'] = File::upload($request->file('image'), 'movie');
                        try {
                            $movie = $movie->update($data);
                            if ($movie) {
                                File::deleteFile($oldImg);
                                return sendSuccessResponse($movie, 'Data Updated Successfully!', 200);
                            }
                        } catch (QueryException $e) {
                            return sendErrorResponse("Something Went Wrong! {$e->getMessage()}", 500);
                        }
                    } else {
                        try {
                            $movie = $movie->update($data);
                            if ($movie) {
                                return sendSuccessResponse($movie, 'Data Updated Successfully!', 200);
                            }
                        } catch (QueryException $e) {
                            return sendErrorResponse("Something Went Wrong! {$e->getMessage()}", 500);
                        }
                    }
                }
                return sendSuccessResponse([], 'Data Deleted Successfully!');
            } else {
                return sendSuccessResponse([], 'Data Not Found!', 404);
            }
        } catch (QueryException $e) {
            return sendErrorResponse([], "Something went wrong! {$e->getMessage()}", 400);
        }
    }
    public function delete($slug)
    {
        try {
            $movie = Movie::whereSlug($slug)->first();
            if ($movie) {
                $img = $movie->image;
                $movie->delete();
                File::deleteFile($img);
                return sendSuccessResponse([], 'Data Deleted Successfully!');
            } else {
                return sendSuccessResponse([], 'Data Not Found!', 404);
            }
        } catch (QueryException $e) {
            return sendErrorResponse([], "Something went wrong! {$e->getMessage()}", 400);
        }
    }
}
