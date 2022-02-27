<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Actions\File\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $data = Category::latest()->get();
            if ($data->count() != 0) {
                return sendSuccessResponse($data, 'Data Retrieved Successfully!');
            } else {
                return sendSuccessResponse($data, 'Data not found!');
            }
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:categories,name'],
            'image' => ['required', 'image', 'mimes:jpg,png'],
        ]);

        if ($validator->fails()) {
            return sendErrorResponse('Data Validation Error!', $validator->errors(), 422);
        }

        $data = $validator->validated();
        $data['slug'] = Str::slug($data['name']);
        $data['image'] = File::upload($request->file('image'), 'category');

        try {
            $category = Category::create($data);
            if ($category) {
                return sendSuccessResponse($category, 'Data Created Successfully!', 201);
            }
        } catch (QueryException $e) {
            return sendErrorResponse("Something Went Wrong! {$e->getMessage()}", 500);
        }
    }
    public function show($slug)
    {
        try {
            $category = Category::whereSlug($slug)->first();
            if ($category) {
                return sendSuccessResponse($category, 'Data Retrieved Successfully!');
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
            $category = Category::whereSlug($slug)->first();
            if ($category) {
                if ($request->hasFile('image')) {
                    $validator = Validator::make($request->all(), [
                        'name' => ['required', 'unique:categories,name,' . $category->id],
                        'price' => ['required'],
                        'description' => ['required'],
                        'image' => ['required', 'image', 'mimes:jpg,png'],
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'name' => ['required', 'unique:categories,name,' . $category->id],
                        'price' => ['required'],
                        'description' => ['required'],
                    ]);
                }

                if ($validator->fails()) {
                    return sendErrorResponse('Data Validation Error!', $validator->errors(), 422);
                } else {
                    $oldImg = $category->image;
                    $data = $validator->validated();
                    $data['slug'] = Str::slug($data['name']);
                    if ($request->hasFile('image')) {
                        $data['image'] = File::upload($request->file('image'), 'ca$category');
                        try {
                            $category = $category->update($data);
                            if ($category) {
                                File::deleteFile($oldImg);
                                return sendSuccessResponse($category, 'Data Updated Successfully!', 200);
                            }
                        } catch (QueryException $e) {
                            return sendErrorResponse("Something Went Wrong! {$e->getMessage()}", 500);
                        }
                    } else {
                        try {
                            $category = $category->update($data);
                            if ($category) {
                                return sendSuccessResponse($category, 'Data Updated Successfully!', 200);
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
            $category = Category::whereSlug($slug)->first();
            if ($category) {
                $img = $category->image;
                $category->delete();
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
