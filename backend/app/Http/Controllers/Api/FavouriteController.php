<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavouriteController extends Controller
{
    public function userFavMovies()
    {
        $data = auth('user_api')->user()->favourite_movies;
        return sendSuccessResponse($data);
    }

    public function addToFavourite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'user_id' => ['required', 'numeric'],
            'movie_id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return sendErrorResponse("Validation Error", $validator->errors(), 422);
        }

        if (!$this->checkDuplicateMovie($request->movie_id)) {
            return sendErrorResponse("Duplication Error!", "This movie already Added!", 422);
        } else {
            try {
                auth('user_api')->user()->favourite_movies()->create([
                    'movie_id' => $request->movie_id
                ]);

                return sendSuccessResponse([], 'Added in Favourite List!');
            } catch (QueryException $e) {
                return sendErrorResponse([], "Something went wrong! {$e->getMessage()}", 400);
            }
        }
    }

    protected function checkDuplicateMovie($movie_id)
    {
        $data = Favourite::whereUserId(auth('user_api')->id())->whereMovieId($movie_id)->first();

        if ($data) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteMovie($id)
    {
        try {
            $movie = Favourite::whereId($id)->first();
            if ($movie) {
                return sendSuccessResponse([], 'Data Deleted Successfully!');
            } else {
                return sendSuccessResponse([], 'Data Not Found!', 404);
            }
        } catch (QueryException $e) {
            return sendErrorResponse([], "Something went wrong! {$e->getMessage()}", 400);
        }
    }
}
