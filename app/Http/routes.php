<?php


$app->get('/', function () use ($app) {
    //return $app->version();
    return view('welcome');
});

$app->get('/test', function () use ($app) {
    //return $app->version();
    return view('test');
});

// $app->get('api/storedatalayer', function () use ($app) {
//     return 'storeOrder';
// });

$app->get('api/processorder', function () use ($app) {
    return 'processOrder';
});


$app->post('api/storedata','AnalyticsdataController@storeDatalayer');

$app->get('api/analyticsdata','AnalyticsdataController@index');
 
$app->get('api/analyticsdata/{id}','AnalyticsdataController@getAnalytcisdata');
 
$app->post('api/analyticsdata','AnalyticsdataController@saveAnalyticsdata');
 
$app->put('api/analyticsdata/{id}','AnalyticsdataController@updateAnalyticsdata');
 
$app->delete('api/analyticsdata/{id}','AnalyticsdataController@deleteAnalyticsdata');