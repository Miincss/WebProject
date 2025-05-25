<?php
require_once __DIR__ . '/../services/NewsletterService.php';
require_once __DIR__. '/../middleware/AuthMiddleware.php';


/**
* @OA\Get(
*     path="/newsletter",
*     tags={"newsletter"},
*     summary="Get all newsletter subscriptions",
*     security={
*         {"ApiKey": {}}
*     },
*     @OA\Response(
*         response=200,
*         description="List of all newsletter subscriptions"
*     )
* )
*/
Flight::route('GET /newsletter', function(){
    Flight::auth_middleware()->requireAdmin();
    Flight::json(Flight::NewsletterService()->getAllSubscriptions());
});


/**
* @OA\Post(
*     path="/newsletter",
*     tags={"newsletter"},
*     summary="Add a new newsletter subscription",
*     security={
*         {"ApiKey": {}}
*     },
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             required={"email"},
*             @OA\Property(property="email", type="string", example="subscriber@example.com")
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Subscription added successfully"
*     )
* )
*/
Flight::route('POST /newsletter', function(){
    $request = Flight::request()->data->getData();
    Flight::json(Flight::NewsletterService()->addSubscription($request));
});
