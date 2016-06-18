<?php


$app->get('/', function () use ($app) {
    //return $app->version();
    return view('welcome');
});

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

// $app->get('api/storedatalayer', function () use ($app) {
//     return 'storeOrder';
// });

$app->get('api/processorder', function () use ($app) {
    return 'processOrder';
});

$app->get('/testhit','AnalyticsdataController@sendAnalyticsHit');

$app->post('api/storedata','AnalyticsdataController@storeDatalayer');

$app->get('api/analyticsdata','AnalyticsdataController@index');
 
$app->get('api/analyticsdata/{id}','AnalyticsdataController@getAnalytcisdata');
 
$app->post('api/analyticsdata','AnalyticsdataController@saveAnalyticsdata');
 
$app->put('api/analyticsdata/{id}','AnalyticsdataController@updateAnalyticsdata');
 
$app->delete('api/analyticsdata/{id}','AnalyticsdataController@deleteAnalyticsdata');