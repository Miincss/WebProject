<?php
require_once __DIR__ . '/../services/BookService.php';

/**
* @OA\Get(
*     path="/books",
*     tags={"books"},
*     summary="Get all books",
*     @OA\Response(
*         response=200,
*         description="List of all books"
*     ),
*     @OA\Response(
*         response=500,
*         description="Server error"
*     )
* )
*/
Flight::route('GET /books', function(){
    try {
        $books = Flight::BookService()->getAllBooks();
        Flight::json($books);
    } catch (Exception $e) {
        Flight::json(["error" => $e->getMessage()], 500);
    }
});

/**
* @OA\Get(
*     path="/books/featured",
*     tags={"books"},
*     summary="Get first three featured books",
*     @OA\Response(
*         response=200,
*         description="Returns three featured books"
*     )
* )
*/
Flight::route('GET /books/featured', function(){
    Flight::json(Flight::BookService()->getFirstThreeBooks());
});

/**
* @OA\Get(
*     path="/books/genre/{genre}",
*     tags={"books"},
*     summary="Get books by genre",
*     @OA\Parameter(
*         name="genre",
*         in="path",
*         required=true,
*         description="Genre of books to fetch",
*         @OA\Schema(type="string")
*     ),
*     @OA\Response(
*         response=200,
*         description="List of books in the specified genre"
*     )
* )
*/
Flight::route('GET /books/genre/@genre', function($genre){
    Flight::json(Flight::BookService()->getByGenre($genre));
});

/**
* @OA\Get(
*     path="/books/{id}",
*     tags={"books"},
*     summary="Get book by ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of book to fetch",
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(
*         response=200,
*         description="Book details"
*     )
* )
*/
Flight::route('GET /books/@id', function($id){
    Flight::json(Flight::BookService()->getBookById($id));
});

/**
* @OA\Post(
*     path="/books",
*     tags={"books"},
*     summary="Create a new book",
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             required={"title", "author", "genre"},
*             @OA\Property(property="title", type="string", example="The Great Gatsby"),
*             @OA\Property(property="author", type="string", example="F. Scott Fitzgerald"),
*             @OA\Property(property="genre", type="string", example="Fiction"),
*             @OA\Property(property="description", type="string"),
*             @OA\Property(property="year", type="integer", example=1925)
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Book created successfully"
*     )
* )
*/
Flight::route('POST /books', function(){
    $request = Flight::request()->data->getData();
    Flight::json(Flight::BookService()->addBook($request));
});

/**
* @OA\Put(
*     path="/books/{id}",
*     tags={"books"},
*     summary="Update an existing book",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of book to update",
*         @OA\Schema(type="integer")
*     ),
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             required={"title", "author", "genre"},
*             @OA\Property(property="title", type="string"),
*             @OA\Property(property="author", type="string"),
*             @OA\Property(property="genre", type="string"),
*             @OA\Property(property="description", type="string"),
*             @OA\Property(property="year", type="integer")
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Book updated successfully"
*     )
* )
*/
Flight::route('PUT /books/@id', function($id){
    $request = Flight::request()->data->getData();
    Flight::json(Flight::BookService()->updateBook($id, $request));
});

/**
* @OA\Delete(
*     path="/books/{id}",
*     tags={"books"},
*     summary="Delete a book",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of book to delete",
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(
*         response=200,
*         description="Book deleted successfully"
*     )
* )
*/
Flight::route('DELETE /books/@id', function($id){
    Flight::json(Flight::BookService()->deleteBook($id));
});

