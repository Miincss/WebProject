<?php
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__. '/../middleware/AuthMiddleware.php';

/**
* @OA\Get(
*     path="/users",
*     tags={"users"},
*     summary="Get all users",
*     security={
*         {"ApiKey": {}}
*     },
*     @OA\Response(
*         response=200,
*         description="List of all users"
*     )
* )
*/
Flight::route('GET /users', function(){
    Flight::auth_middleware()->requireAdmin();
    Flight::json(Flight::UserService()->getAllUsers());
});

/**
* @OA\Get(
*     path="/users/{id}",
*     tags={"users"},
*     summary="Get user by ID",
*     security={
*         {"ApiKey": {}}
*     },
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of user to fetch",
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(
*         response=200,
*         description="User details"
*     )
* )
*/
Flight::route('GET /users/@id', function($id){
    Flight::auth_middleware()->requireSelfOrAdmin($id);
    Flight::json(Flight::UserService()->getUserById($id));
});

/**
* @OA\Post(
*     path="/users",
*     tags={"users"},
*     summary="Create a new user",
*     security={
*         {"ApiKey": {}}
*     },
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             required={"username", "email", "password"},
*             @OA\Property(property="username", type="string", example="johndoe"),
*             @OA\Property(property="email", type="string", example="john@example.com"),
*             @OA\Property(property="password", type="string", format="password"),
*             @OA\Property(property="first_name", type="string", example="John"),
*             @OA\Property(property="last_name", type="string", example="Doe"),
*             @OA\Property(property="is_admin", type="integer", example="0")
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="User created successfully"
*     )
* )
*/
Flight::route('POST /users', function(){
    $request = Flight::request()->data->getData();
    Flight::json(Flight::UserService()->createUser($request));
});

/**
* @OA\Put(
*     path="/users/{id}",
*     tags={"users"},
*     summary="Update an existing user",
*     security={
*         {"ApiKey": {}}
*     },
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of user to update",
*         @OA\Schema(type="integer")
*     ),
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             @OA\Property(property="username", type="string"),
*             @OA\Property(property="email", type="string"),
*             @OA\Property(property="password", type="string", format="password"),
*             @OA\Property(property="first_name", type="string", example="John"),
*             @OA\Property(property="last_name", type="string", example="Doe"),
*             @OA\Property(property="is_admin", type="integer", example="0")
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="User updated successfully"
*     )
* )
*/
Flight::route('PUT /users/@id', function($id){
    Flight::auth_middleware()->requireSelfOrAdmin($id);
    $request = Flight::request()->data->getData();
    Flight::json(Flight::UserService()->updateUser($id, $request));
});

/**
* @OA\Delete(
*     path="/users/{id}",
*     tags={"users"},
*     summary="Delete a user",
*     security={
*         {"ApiKey": {}}
*     },
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of user to delete",
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(
*         response=200,
*         description="User deleted successfully"
*     )
* )
*/
Flight::route('DELETE /users/@id', function($id){
    Flight::auth_middleware()->requireAdmin();
    Flight::json(Flight::UserService()->deleteUser($id));
});