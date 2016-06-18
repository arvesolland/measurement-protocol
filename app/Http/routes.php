<?php
$app->get('/', function () use ($app) {
    return view('welcome');
});

//These are the important routes to use here....
$app->get('api/processorder/{id}','AnalyticsdataController@processOrder');
$app->post('api/analyticsdata','AnalyticsdataController@saveAnalyticsdata');
$app->post('api/storedata','AnalyticsdataController@saveAnalyticsdata'); //same action - additional route


//These routes are just for testing
$app->get('/demo', function () use ($app) {
	return view('demo');
});

$app->get('/demo_product', function () use ($app) {
	return view('demo_product');
});

$app->get('/demo_cart', function () use ($app) {
	return view('demo_cart');
});

$app->get('/demo_checkout', function () use ($app) {
	return view('demo_checkout');
});

$app->get('/demo_payment', function () use ($app) {
	return view('demo_payment');
});



$app->get('/testhit','AnalyticsdataController@sendAnalyticsHit');



$app->get('api/analyticsdata','AnalyticsdataController@index');
 
$app->get('api/analyticsdata/{id}','AnalyticsdataController@getAnalytcisdata');
 

 
$app->put('api/analyticsdata/{id}','AnalyticsdataController@updateAnalyticsdata');
 
$app->delete('api/analyticsdata/{id}','AnalyticsdataController@deleteAnalyticsdata');