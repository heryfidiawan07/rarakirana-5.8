<?php
//Socialite
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

//======= Product Cart / CartController
Route::get('/product/carts', "CartController@carts");
Route::get('/add-to-cart/{slug}', "CartController@addToCart");
Route::get('/buy-product/{slug}', "CartController@buy");
Route::get('/remove-cart/product/{slug}', "CartController@removeCartByProduct");
Route::get('/remove-all/product', "CartController@removeAllProduct");
Route::get('/cart/cost/{addId}/{kurir}', 'CartController@cost');
// ==== QTY Cart / Product
Route::post('/add-plus-qty-cart/{slug}', "CartController@plusQty");
Route::post('/add-min-qty-cart/{slug}', "CartController@minQty");

Route::get('/address/get-city/by-province/{provId}', 'AddressController@searchCity');

//Verify Email
Route::get('/verify/{token}/{id}', 'Auth\RegisterController@email_verify');

Auth::routes();

Route::middleware(['admin'])->group(function () {

    Route::get('/admin', 'AdminController@dashboard');
    // Admin Menus
    Route::get('/admin/menus', 'MenuController@index');
    Route::post('/admin/menu/store', 'MenuController@store');
    Route::post('/admin/menu/{id}/update', 'MenuController@update');
    Route::get('/admin/menu/{id}/delete', 'MenuController@delete');
    // Admin Post
    Route::get('/admin/posts', 'PostController@index');
    Route::get('/admin/post/create', 'PostController@create');
    Route::post('/admin/post/store', 'PostController@store');
    Route::get('/admin/post/{id}/edit', 'PostController@edit');
    Route::post('/admin/post/{id}/update', 'PostController@update');
    Route::get('/admin/post/{id}/delete', 'PostController@delete');
    Route::post('/admin/post/{id}/quict-edit', 'PostController@quickEdit');
    // Admin Tag
    Route::get('/admin/tags', 'TagController@index');
    Route::post('/admin/tag/store', 'TagController@store');
    Route::post('/admin/tag/{id}/update', 'TagController@update');
    Route::get('/admin/tag/{id}/delete', 'TagController@delete');
    //Admin Etalase
    Route::get('/admin/etalase', 'EtalaseController@index');
    Route::post('/admin/etalase/store', 'EtalaseController@store');
    Route::post('/admin/etalase/{id}/update', 'EtalaseController@update');
    Route::get('/admin/etalase/{id}/delete', 'EtalaseController@delete');
    //Admin Etalase Jquery
    Route::get('/admin/etalase/parent-menu/{id}', 'EtalaseController@getChildMenu');
    //Admin Category
    Route::get('/admin/category', 'CategoryController@index');
    Route::post('/admin/category/store', 'CategoryController@store');
    Route::post('/admin/category/{id}/update', 'CategoryController@update');
    Route::get('/admin/category/{id}/delete', 'CategoryController@delete');
    //Admin Category Jquery
    Route::get('/admin/category/parent-menu/{id}', 'CategoryController@getChildMenu');
    // Admin Product
    Route::get('/admin/products', 'ProductController@index');
    Route::get('/admin/product/create', 'ProductController@create');
    Route::post('/admin/product/store', 'ProductController@store');
    Route::get('/admin/product/{id}/edit', 'ProductController@edit');
    Route::post('/admin/product/{id}/update', 'ProductController@update');
    Route::get('/admin/product/{id}/delete', 'ProductController@delete');
    Route::post('/admin/product/{id}/quick-edit', 'ProductController@quickEdit');
    //Product Picture Delete Ajax
    Route::get('/admin/product/picture/ajax/delete/{id}', 'PictureController@deleteAjax');
    // Admin Forum
    Route::get('/admin/forums', 'ForumController@index');
    Route::get('/admin/forum/{id}/banned', 'ForumController@banned');
    Route::get('/admin/forum/{id}/delete', 'ForumController@delete');
    // Admin Address
    Route::get('/admin/address', 'AddressController@index');
    Route::post('/admin/address/store', 'AddressController@storeAdminOriginAddress');
    Route::post('/admin/address/{id}/update', 'AddressController@updateAdminOriginAddress');
    Route::get('/admin/address/{id}/delete', 'AddressController@delete');
    // Admin Account
    Route::get('/admin/accounts', 'AccountController@index');
    Route::post('/admin/account/store', 'AccountController@store');
    Route::post('/admin/account/{id}/update', 'AccountController@update');
    Route::get('/admin/account/{id}/delete', 'AccountController@delete');
    // Admin Order
    Route::get('/admin/orders', 'AdminOrder@index');
    Route::get('/admin/payment/{token}/accept', 'AdminOrder@accept');
    Route::get('/admin/payment/{token}/delete', 'AdminOrder@delete');
    // Admin Order/Payment Reject
    Route::post('/admin/payment/{token}/reject', 'AdminOrder@reject');
    // ==== Admin Order Resi
    Route::post('/admin/order/{token}/resi', 'AdminOrder@resi');
    Route::get('/admin/order/{token}/arrived', 'AdminOrder@arrived');
    Route::post('/admin/order/{token}/manual-update', 'AdminOrder@manualUpdate');
    Route::get('/admin/order/{token}/details', 'AdminOrder@details');
    // Admin Download & Print Address
    Route::get('/admin/order/{token}/download', 'AdminOrder@downloadInvoice');
    Route::get('/admin/order/{token}/stream', 'AdminOrder@streamInvoice');
    // Inbox
    Route::get('/admin/inbox', 'InboxController@index');
    Route::get('/admin/inbox/{id}/delete', 'InboxController@delete');
    // Product Offline
    Route::get('/admin/product/offline', 'OfflineController@index');
    Route::get('/admin/product/offline/{id}/delete', 'OfflineController@delete');
    // Aplication
    Route::get('/admin/aplication', 'AplicationController@index');
    Route::post('/admin/aplication/store', 'AplicationController@store');
    Route::get('/admin/aplication/{id}/edit', 'AplicationController@edit');
    Route::post('/admin/aplication/{id}/update', 'AplicationController@update');
    Route::get('/admin/aplication/{id}/delete', 'AplicationController@delete');
    // ======== Social Media
    Route::get('/admin/social-media', 'AdminController@socialMedia');
    // Follow
    Route::post('/admin/follow/store', 'FollowController@store');
    Route::post('/admin/follow/{id}/update', 'FollowController@update');
    Route::get('/admin/follow/{id}/delete', 'FollowController@delete');
    // Sosmed
    Route::post('/admin/share/store', 'ShareController@store');
    Route::get('/admin/share/{id}/delete', 'ShareController@delete');
    //MCE
    Route::get('/admin/filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/admin/filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
});

Route::middleware(['auth'])->group(function () {
    // Threads
    Route::get('/thread/create', 'ThreadController@create');
    Route::post('/thread/store', 'ThreadController@store');
    Route::get('/thread/{slug}/edit', 'ThreadController@edit');
    Route::post('/thread/{slug}/update', 'ThreadController@update');
    // Post Comments
    Route::post('/post/{slug}/comment/store', 'CommentController@postCommentStore');
    Route::post('/product/{slug}/comment/store', 'CommentController@productCommentStore');
    Route::post('/thread/{slug}/comment/store', 'CommentController@threadCommentStore');
    // Global Update
    Route::post('/comment/{id}/update', 'CommentController@update');
    // Global Comment Parent
    Route::post('/comment/{id}/store', 'CommentController@parentCommentStore');
    // Address
    Route::post('/address/store', 'AddressController@store');
    Route::post('/address/{id}/update', 'AddressController@update');
    // Order Checkout
    Route::post('/cart/checkout', 'OrderController@checkout');
    Route::get('/order/checkout/details/{token}', 'OrderController@orderDetails');
    Route::get('/order/cancel/{token}', 'OrderController@cancelOrder');
    // Order Payment
    Route::post('/order/payment/{token}', 'PaymentController@payment');
    Route::post('/order/payment/{token}/edit', 'PaymentController@paymentEdit');
    //User Order
    Route::get('/order/{slug}/details/{token}', 'UserController@orderDetails');
    // User Order Arrived
    Route::post('/order/{slug}/arrived/{token}/create', 'UserController@arrivedOrder');
    // ======== User Profile
    Route::post('/user/{slug}/upload/img', 'UserController@uploadImg');
    Route::post('/user/{slug}/create/description', 'UserController@createDesc');
    Route::post('/user/{slug}/update/description', 'UserController@updateDesc');
    Route::post('/user/{slug}/edit/name', 'UserController@updateName');
    Route::get('/user/{slug}/invoice/{token}', 'UserController@streamInvoice');
});
//Home
Route::get('/', 'HomeController@index');
//Global
Route::get('/{slug}', 'GlobalController@menu');
// User Profile
Route::get('/user/{slug}', 'UserController@slug');
//======= Tag
Route::get('/tag/{slug}', 'GlobalController@tag');
//======= /read/post/slug
Route::get('/read/post/{slug}', 'PostController@show');
//======= /show/product/slug
Route::get('/show/product/{slug}', 'ProductController@show');
Route::get('/product/etalase/{slug}', 'ProductController@etalase');
// Product Offline Form
Route::post('/send/product/{slug}/offline', 'OfflineController@store');
//======= /forum/slug
Route::get('/thread/{slug}', 'ThreadController@show');
Route::get('/thread/category/{slug}', 'ThreadController@category');
//======= /Global Form
Route::post('/send/form-data', 'GlobalController@contact');
