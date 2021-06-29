<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee', 'Api\EmployeeController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/expense', 'Api\ExpenseController');

Route::post('/salary/paid/{id}', 'Api\SalaryController@salaryPay');
Route::get('/salary', 'Api\SalaryController@allSalary');
Route::get('/salary/view/{id}', 'Api\SalaryController@viewSalary');
Route::get('/salary/edit/{id}', 'Api\SalaryController@editSalary');
Route::post('/salary/update/{id}', 'Api\SalaryController@updateSalary');

Route::post('/stock/update/{id}', 'Api\ProductController@stockUpdate');

Route::apiResource('/customer', 'Api\CustomerController');

Route::get('/product/category/{id}', 'Api\PosController@getCategoryProduct');

Route::get('/pos/addToCart/{id}', 'Api\CartController@addToCart');
Route::get('/pos/showCart', 'Api\CartController@showToCart');

//Route::apiResource('/pos', 'Api\CartController');

Route::get('/pos/increment/{id}', 'Api\CartController@cartIncrement');
Route::get('/pos/decrement/{id}', 'Api\CartController@cartDecrement');

Route::get('/tax', 'Api\CartController@tax');

Route::post('/pos/order', 'Api\PosController@orderPayment');

Route::get('/pos/order/todaylist', 'Api\PosController@orderTodayList');
Route::get('/pos/order/viewTodayOrder/{id}', 'Api\PosController@orderTodayView');
Route::get('/pos/order/detailTodayOrder/{id}', 'Api\PosController@orderTodayDetail');

Route::post('/pos/search', 'Api\PosController@orderSearch');

Route::get('/pos/today/sales', 'Api\PosController@getTodaySales');
Route::get('/pos/today/incomes', 'Api\PosController@getTodayIncomes');
Route::get('/pos/today/dues', 'Api\PosController@getTodayDues');
Route::get('/pos/today/expenses', 'Api\PosController@getTodayExpenses');
Route::get('/pos/today/stockout', 'Api\PosController@getTodayStockout');