<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Actions\File\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function index()
    {
        try {
            $data = Product::latest()->get();
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:products,name'],
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
        $data['image'] = File::upload($request->file('image'), 'product');

        try {
            $product = Product::create($data);
            if ($product) {
                return sendSuccessResponse($product, 'Data Created Successfully!', 201);
            }
        } catch (QueryException $e) {
            return sendErrorResponse("Something Went Wrong! {$e->getMessage()}", 500);
        }
    }
    public function show($slug)
    {
        try {
            $product = Product::whereSlug($slug)->first();
            if ($product) {
                return sendSuccessResponse($product->load('category'), 'Data Retrieved Successfully!');
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
            $product = Product::whereSlug($slug)->first();
            if ($product) {
                if ($request->hasFile('image')) {
                    $validator = Validator::make($request->all(), [
                        'name' => ['required', 'unique:products,name,' . $product->id],
                        'description' => ['required'],
                        'duration' => ['required'],
                        'image' => ['required', 'image', 'mimes:jpg,png'],
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'name' => ['required', 'unique:products,name,' . $product->id],
                        'duration' => ['required'],
                        'description' => ['required'],
                    ]);
                }

                if ($validator->fails()) {
                    return sendErrorResponse('Data Validation Error!', $validator->errors(), 422);
                } else {
                    $oldImg = $product->image;
                    $data = $validator->validated();
                    $data['slug'] = Str::slug($data['name']);
                    if ($request->hasFile('image')) {
                        $data['image'] = File::upload($request->file('image'), 'product');
                        try {
                            $product = $product->update($data);
                            if ($product) {
                                File::deleteFile($oldImg);
                                return sendSuccessResponse($product, 'Data Updated Successfully!', 200);
                            }
                        } catch (QueryException $e) {
                            return sendErrorResponse("Something Went Wrong! {$e->getMessage()}", 500);
                        }
                    } else {
                        try {
                            $product = $product->update($data);
                            if ($product) {
                                return sendSuccessResponse($product, 'Data Updated Successfully!', 200);
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
            $product = Product::whereSlug($slug)->first();
            if ($product) {
                $img = $product->image;
                $product->delete();
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
