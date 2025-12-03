<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ChildCategoriesController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemInformationController;
use App\Http\Controllers\ItemPhotosController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\UesrController;
use App\Http\Controllers\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// User Routes
Route::post('/addUser', [UesrController::class, 'store']);
Route::get('/showUser/{UserId}', [UesrController::class, 'show']);
Route::get('/getAllUser', [UesrController::class, 'getAllUsers']);
Route::get('/showAllDataAboutUsers', [UesrController::class, 'showAllDataAboutUsers']);
Route::delete('/deleteUser/{id}', [UesrController::class, 'destroy']);
Route::put('/updaetUser/{id}', [UesrController::class, 'update']);

// City Routes
Route::delete('/deleteCity/{id}', [CityController::class, 'delete']);
Route::post('/AddCity', [CityController::class, 'store']);
Route::get('/showCity/{id}', [CityController::class, 'show']);
Route::get('/showAllCity', [CityController::class, 'getAllCities']);
Route::put('/updateCity/{cityId}', [CityController::class, 'update']);

// Address Routes
Route::get('/showAddress/{addressId}', [AddressController::class, 'show']);
Route::get('/showAllAddress', [AddressController::class, 'showAllAddress']);
Route::get('/showAddressByCityId/{cityId}', [AddressController::class, 'showAddressByCityId']);
Route::post('/addAddress', [AddressController::class , 'store']);
Route::delete('/deleteAddress/{addressId}', [AddressController::class,'deleteAddress']);
Route::put('/updateAddress/{addressId}', [AddressController::class,'update']);

// Categories Routes
Route::delete('/deleteCategories/{categoryId}', [CategoriesController::class,'destroy']);
Route::get('/showAllCategories', [CategoriesController::class,'showAllCategories']);
Route::get('/showCategoriesById/{categoryId}', [CategoriesController::class,'categoryId']);
Route::post('/addCategories', [CategoriesController::class,'store']);
Route::put('/updateCategories/{categoryId}', [CategoriesController::class,'update']);

// Child Categories Routes
Route::delete('/deleteChildCategories/{childCategoryId}', [ChildCategoriesController::class,'destroy']);
Route::post('/addChildCategories', [ChildCategoriesController::class,'store']);
Route::put('/updateChildCategories/{childCategoryId}', [ChildCategoriesController::class,'update']);
Route::get('/showAllChildCategories', [ChildCategoriesController::class,'showAllChildCategories']);
Route::get('/showChildCategoriesById/{childCategoryId}', [ChildCategoriesController::class,'show']);
Route::get('/showChildCategoriesByParintsCategoriesId/{parentCategoryId}', [ChildCategoriesController::class,'showByParentCategoryId']);

// Item Routes
Route::post('/addItem', [ItemController::class,'stroe']);
Route::get('/showItemById/{ItemId}', [ItemController::class,'show']);
Route::get('/showAllItmes', [ItemController::class,'showAllItmes']);
Route::put('/updateItem/{ItemId}', [ItemController::class,'update']);
Route::delete('/deleteItem/{ItemId}', [ItemController::class,'destroy']);

// Item Information Routes
Route::post('/addItemInformation', [ItemInformationController::class,'store']);
Route::get('/showItemInformationById/{InfoId}', [ItemInformationController::class,'show']);
Route::get('/showAllItemInformation', [ItemInformationController::class,'showAllItmes']);
Route::put('/updateItemInformation/{InfoId}', [ItemInformationController::class,'update']);
Route::delete('/deleteItemInformation/{InfoId}', [ItemInformationController::class,'destroy']);
Route::get('/showItemInformationByItemId/{ItemId}', [ItemInformationController::class,'showByItemId']);

// Order List Routes
Route::post('/addOrderList', [OrderListController::class,'store']);
Route::get('/showOrderListById/{OrderListId}', [OrderListController::class,'show']);
Route::get('/showAllOrderList', [OrderListController::class,'showAllOrder']);
Route::put('/updateOrderList/{OrderListId}', [OrderListController::class,'update']);
Route::delete('/deleteOrderList/{OrderListId}', [OrderListController::class,'destroy']);  

// Item Photos Routes
Route::post('/addItemPhotos', [ItemPhotosController::class,'store']);
Route::get('/showItemPhotosById/{PhotoId}', [ItemPhotosController::class,'show']);
Route::get('/showAllItemPhotos', [ItemPhotosController::class,'showAllItmes']);
Route::put('/updateItemPhotos/{PhotoId}', [ItemPhotosController::class,'update']);
Route::delete('/deleteItemPhotos/{PhotoId}', [ItemPhotosController::class,'destroy']);   
Route::get('/showItemPhotosByItemId/{ItemId}', [ItemPhotosController::class,'showByItemId']);

// Order Routes
Route::get('/showOrderById/{OrderId}', [OrderController::class,'show']);
Route::get('/showOrderIfontmation', [OrderController::class,'showOrderIfontmation']);
Route::get('/showAllOrder', [OrderController::class,'showAllOrder']);
Route::put('/updateOrder/{OrderId}', [OrderController::class,'update']);
Route::delete('/deleteOrder/{OrderId}', [OrderController::class,'destroy']);
Route::post('/addOrder', [OrderController::class,'store']);

