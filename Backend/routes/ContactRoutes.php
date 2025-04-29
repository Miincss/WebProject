<?php
require_once __DIR__ . '/../services/ContactService.php';

/**
* @OA\Get(
*     path="/contact",
*     tags={"contact"},
*     summary="Get all contact messages",
*     @OA\Response(
*         response=200,
*         description="List of all contact messages"
*     )
* )
*/
Flight::route('GET /contact', function(){
    Flight::json(Flight::ContactService()->getAllMessages());
});

/**
* @OA\Get(
*     path="/contact/{id}",
*     tags={"contact"},
*     summary="Get contact message by ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of message to fetch",
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(
*         response=200,
*         description="Contact message details"
*     )
* )
*/
Flight::route('GET /contact/@id', function($id){
    Flight::json(Flight::ContactService()->getMessageById($id));
});

/**
* @OA\Post(
*     path="/contact",
*     tags={"contact"},
*     summary="Create a new contact message",
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             required={"name", "email", "message"},
*             @OA\Property(property="name", type="string", example="John Doe"),
*             @OA\Property(property="email", type="string", example="john@example.com"),
*             @OA\Property(property="message", type="string", example="Hello, I have a question...")
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Contact message created successfully"
*     )
* )
*/
Flight::route('POST /contact', function(){
    $request = Flight::request()->data->getData();
    Flight::json(Flight::ContactService()->createMessage($request));
});