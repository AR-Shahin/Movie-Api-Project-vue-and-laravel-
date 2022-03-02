<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function reviews($id)
    {
        try {
            $movie = Movie::whereId($id)->first();
            if ($movie) {
                return sendSuccessResponse($movie->load(['category', 'reviews']), 'Data Retrieved Successfully!');
            } else {
                return sendSuccessResponse([], 'Data Not Found!', 404);
            }
        } catch (QueryException $e) {
            return sendErrorResponse([], "Something went wrong! {$e->getMessage()}", 400);
        }
    }

    public function addReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => ['required', 'numeric'],
            'comment' => ['required'],
        ]);

        if ($validator->fails()) {
            return sendErrorResponse('Data Validation Error!', $validator->errors(), 422);
        }
        $data = $validator->validated();

        if (!$this->checkDuplicateMovie($request->movie_id)) {
            return sendErrorResponse("Duplication Error!", "You can't add review!", 422);
        } else {
            try {
                $data['user_id'] = auth('user_api')->id();
                $data['review'] = $request->review ? $request->review : 0;

                $review = Review::create($data);

                return sendSuccessResponse($review, 'Review Added Successfully!');
            } catch (QueryException $e) {
                return sendErrorResponse([], "Something went wrong! {$e->getMessage()}", 400);
            }
        }
    }

    private function checkDuplicateReview($movie_id)
    {
        $data = Review::whereUserId(auth('user_api')->id())->whereMovieId($movie_id)->first();

        if ($data) {
            return false;
        } else {
            return true;
        }
    }
}
