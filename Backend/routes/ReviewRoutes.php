<?php
require_once __DIR__ . '/../services/ReviewService.php';

/**
* @OA\Get(
*     path="/reviews/book/{id}",
*     tags={"reviews"},
*     summary="Get reviews by book ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of the book to get reviews for",
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(
*         response=200,
*         description="List of reviews for the specified book"
*     )
* )
*/
Flight::route('GET /reviews/book/@id', function($id){
    Flight::json(Flight::ReviewService()->getByBookId($id));
});

/**
* @OA\Get(
*     path="/reviews/{id}",
*     tags={"reviews"},
*     summary="Get review by ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of review to fetch",
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(
*         response=200,
*         description="Review details"
*     )
* )
*/
Flight::route('GET /reviews/@id', function($id){
    Flight::json(Flight::ReviewService()->getByReviewId($id));
});

/**
* @OA\Post(
*     path="/reviews",
*     tags={"reviews"},
*     summary="Create a new review",
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             required={"book_id", "user_id", "rating", "comment"},
*             @OA\Property(property="book_id", type="integer"),
*             @OA\Property(property="user_id", type="integer"),
*             @OA\Property(property="rating", type="integer", minimum=1, maximum=5),
*             @OA\Property(property="comment", type="string")
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Review created successfully"
*     )
* )
*/
Flight::route('POST /reviews', function(){
    $request = Flight::request()->data->getData();
    Flight::json(Flight::ReviewService()->addReview($request));
});

/**
* @OA\Delete(
*     path="/reviews/{id}",
*     tags={"reviews"},
*     summary="Delete a review",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of review to delete",
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(
*         response=200,
*         description="Review deleted successfully"
*     )
* )
*/
Flight::route('DELETE /reviews/@id', function($id){
    Flight::json(Flight::ReviewService()->deleteReview($id));
});