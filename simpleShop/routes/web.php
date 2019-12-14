<?php

Route::get('/', 'HomeController@index');
Route::get('/overall', 'OverallReportController@index');
Route::get('/clients', 'ClientsReportController@index');
Route::get('/orders', 'OrdersController@index');

Route::post('/overallReport', 'OverallReportController@report');
Route::post('/clientsReport', 'ClientsReportController@report');
Route::post('/ordersList', 'OrdersController@getOrdersList');
Route::post('/saveOrderDetails', 'OrdersController@saveOrderDetails');
