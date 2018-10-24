<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'] , function () use ($router) {
    // tours
    $router->get('tours', ['uses' => 'Admin\TourController@index']);
    $router->get('tours/{id}', ['uses' => 'Admin\TourController@getInfo']);
    $router->post('tours/create', ['uses' => 'Admin\TourController@processForm']);
    $router->post('tours/edit/{id}', ['uses' => 'Admin\TourController@processForm']);
    $router->get('tours/delete/{id}', ['uses' => 'Admin\TourController@deleteTour']);

    // categorys
    $router->get('categorys', ['uses' => 'Admin\CategoryController@index']);
    $router->get('categorys/{id}', ['uses' => 'Admin\CategoryController@getInfo']);
    $router->get('categorys/delete/{id}', ['uses' => 'Admin\CategoryController@deleteCategory']);
    $router->post('categorys/create', ['uses' => 'Admin\CategoryController@processFrom']);
    $router->post('categorys/edit/{id}', ['uses' => 'Admin\CategoryController@processFrom']);

    // Booking tour
    $router->get('booking-tours', ['uses' => 'Admin\BookingTourController@index']);
    $router->get('booking-tours/{id}', ['uses' => 'Admin\BookingTourController@getInfo']);
    $router->post('booking-tours/create', ['uses' => 'Admin\BookingTourController@procBookingTour']);
    $router->post('booking-tours/edit/{id}', ['uses' => 'Admin\BookingTourController@procBookingTour']);
    $router->get('booking-tours/accuracy/{id}', ['uses' => 'Admin\BookingTourController@sendMail']);

    // Author
    $router->get('authors', ['uses' => 'Admin\AuthorController@index']);
    $router->get('authors/{id}', ['uses' => 'Admin\AuthorController@getInfo']);
    $router->post('authors/create', ['uses' => 'Admin\AuthorController@processForm']);
    $router->post('authors/edit/{id}', ['uses' => 'Admin\AuthorController@processForm']);
    $router->get('authors/delete/{id}', ['uses' => 'Admin\AuthorController@drop']);

    // Blog
    $router->get('blogs', ['uses' => 'Admin\BlogController@index']);
    $router->get('blogs/{id}', ['uses' => 'Admin\BlogController@getInfo']);
    $router->post('blogs/create', ['uses' => 'Admin\BlogController@processForm']);
    $router->post('blogs/edit/{id}', ['uses' => 'Admin\BlogController@processForm']);
    $router->get('blogs/delete/{id}', ['uses' => 'Admin\BlogController@drop']);
    $router->get('blogs/send-mail/{id}', ['uses' => 'Admin\BlogController@infoBlog']);

    // User
    $router->post('users/login', ['uses' => 'Admin\UserController@login']);
    $router->post('users/sign-up', ['uses' => 'Admin\UserController@signUp']);

    // Contact
    $router->get('contacts', ['uses' => 'Admin\ContactController@index']);
    $router->post('contacts/create', ['uses' => 'Admin\ContactController@processForm']);
    $router->post('contacts/edit/{id}', ['uses' => 'Admin\ContactController@processForm']);
    $router->get('contacts/mail/{id}', ['uses' => 'Admin\ContactController@mailContact']);

    //Comment
    $router->get('comments', ['uses' => 'Admin\CommentController@index']);
    $router->get('comments/{id}', ['uses' => 'Admin\CommentController@showDetail']);
    $router->post('comments/create', ['uses' => 'Admin\CommentController@processForm']);
    $router->post('comments/edit/{id}', ['uses' => 'Admin\CommentController@processForm']);
    $router->get('comments/mail/{id}', ['uses' => 'Admin\CommentController@mailConfim']);

    //tests file upload
    $router->post('tests/upload', ['uses' => 'Admin\TestController@fileUpload']);

    // picture upload
    $router->get('pictures', ['uses' => 'Admin\PictureController@index']);
    $router->post('pictures/create', ['uses' => 'Admin\PictureController@processForm']);

    // Member
    $router->get('members', ['uses' => 'Admin\MemberController@index']); 
});
