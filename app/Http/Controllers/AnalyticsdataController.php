<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Analyticsdata;
use Illuminate\Http\Request;

class AnalyticsdataController extends Controller
{
     public function index(){
 
        $analyticsdata  = Analyticsdata::all();
 
        return response()->json($analyticsdata);
 
    }

    public function storeDatalayer(Request $request){
 
        
        print_r($request['datalayer']);
        print_r($request['ref_id']);
        print_r($request['client_id']);
        print_r($request['payment_method']);
        
 
        return;
        //return response()->json($analyticsdata);
 
    }
 
    public function getAnalytcisdata($id){
 
        $analyticsdata  = Analyticsdata::find($id);
 
        return response()->json($analyticsdata);
    }
 
    public function saveAnalyticsdata(Request $request){
 
        $analyticsdata = Analyticsdata::create($request->all());
 
        return response()->json($analyticsdata);
 
    }
 
    public function deleteAnalyticsdata($id){
        $analyticsdata  = Analyticsdata::find($id);
 
        $analyticsdata->delete();
 
        return response()->json('success');
    }
 
    public function updateAnalyticsdata(Request $request,$id){
        $analyticsdata  = Analyticsdata::find($id);
 
        $analyticsdata->ref_id = $request->input('order_id');
        $analyticsdata->client_id = $request->input('client_id');
        $analyticsdata->payment_method = $request->input('payment_method');
        $analyticsdata->datalayer = $request->input('datalayer');
        $analyticsdata->status = $request->input('status');
 
        $analyticsdata->save();
 
        return response()->json($analyticsdata);
    }
}
