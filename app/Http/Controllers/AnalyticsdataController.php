<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Analyticsdata;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class AnalyticsdataController extends Controller
{
     public function index(){
        $analyticsdata  = Analyticsdata::all();
        return response()->json($analyticsdata);
    }

    

    public function processOrder(String $id){

        $analyticsdata = Analyticsdata::where('ref_id', '=', $id)->where('status', '=', 0)->first();
        if ($analyticsdata){
            $this->sendAnalyticsHit($analyticsdata);
             //update database to set send status to 1
            $analyticsdata->status = true;
            $analyticsdata->save();
            return response()->json('Order ID Processed - Hit sent to Google Analytics');    
        }
        return response()->json('Error: Order id not found');
    }
 
    public function getAnalytcisdata($id){
 
        $analyticsdata  = Analyticsdata::find($id);
 
        return response()->json($analyticsdata);
    }
 
    public function saveAnalyticsdata(Request $request){

        $analyticsdata = new Analyticsdata;
        $analyticsdata->ref_id = $request->ref_id;
        $analyticsdata->client_id = $request->client_id;
        $analyticsdata->payment_method = $request->payment_method;
        $analyticsdata->datalayer = json_encode($request->datalayer);
        $analyticsdata->status = 0;
        $analyticsdata->save();
 
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

    public function getSampleAnalyticsDataArray(){
        //Sample Array
        $hit_payload_array = [];
        $hit_payload_array['v'] = 1;
        $hit_payload_array['tid'] = 'UA-79090004-1'; //Analytics ID
        $hit_payload_array['cid'] = '5551233'; //Client ID
        $hit_payload_array['t'] = 'event'; //type
        $hit_payload_array['ec'] = 'Ecommerce'; //Event Category
        $hit_payload_array['ea'] = 'Payment Confirmation foo'; //Event Action

        //Custom Dimensions / Metrics
        $hit_payload_array['cd1'] = 'guest'; //Custom Dimenstion 1
        $hit_payload_array['cd4'] = 'Credit Card'; //Custom Dimenstion 4
        
        //Transaction Values
        $hit_payload_array['ti'] = 'MA1606001215'; //Transaction ID
        $hit_payload_array['ta'] = 'Online Store'; //Transaction Affilliation
        $hit_payload_array['tr'] = '303620'; //Transaction Revenue Amount
        $hit_payload_array['tt'] = 0; //Transaction Tax
        $hit_payload_array['ts'] = 0; //Transaction Shipping Amount
        $hit_payload_array['tcc'] = ''; //Transaction Coupon Code

        //Document Return values
        $hit_payload_array['dh'] = 'misteraladin.com'; //Document Host
        $hit_payload_array['dp'] = '/payment_return_path'; //Document Path
        $hit_payload_array['dt'] = 'Payment Completed foo'; //Document Title

        //Product Values
        $hit_payload_array['pa'] = 'purchase'; //Product Action

        //Individual Products
        $hit_payload_array['pr1id'] = '118'; //Product 1 - ID
        $hit_payload_array['pr1nm'] = 'Kuta Central Park'; //Product 1 - Name
        $hit_payload_array['pr1ca'] = '4 Star'; //Product 1 - Category
        $hit_payload_array['pr1br'] = 'Kuta Central Park'; //Product 1 - Brand
        $hit_payload_array['pr1va'] = 'Bali'; //Product 1 - Variant
        $hit_payload_array['pr1pr'] = '303620'; //Product 1 - Price
        $hit_payload_array['pr1qt'] = '1'; //Product 1 - Qty
        $hit_payload_array['pr1ps'] = '1'; //Product 1 - Position
        $hit_payload_array['pr1cc'] = ''; //Product 1 - Coupon Code

        //Product Custom Dimensions
        $hit_payload_array['pr1cd2'] = '2016-06-06'; //Product 1 - Custom dimension 2
        $hit_payload_array['pr1cd3'] = '2016-06-07'; //Product 1 - Custom dimension 3
        $hit_payload_array['pr1cd5'] = 'MA1606001215'; //Product 1 - Custom dimension 5
        $hit_payload_array['pr1cd6'] = 'PENDING'; //Product 1 - Custom dimension 6

        //Product Custom Metrics
        $hit_payload_array['pr1cm1'] = 1; //Product 1 - Custom metric 1

        return $hit_payload_array;
    }

    public function buildHitPayloadStringFromDataLayer(Analyticsdata $analyticsdata_record){
        //sample data
        $analyticsData = [];
        $analyticsdata['client_id'] = '899621571.1464319615';
        $analyticsdata['ref_id'] = 'MA1606008222';
        $analyticsdata['payment_method'] = 'Credit Card';  
        
        //real data
        $analyticsdata['client_id'] = $analyticsdata_record->client_id;
        $analyticsdata['ref_id'] = $analyticsdata_record->ref_id;
        $analyticsdata['payment_method'] = $analyticsdata_record->payment_method;     

        //test data 
        $datalayer_json = '{"dimension1":"guest","event":"checkout","ecommerce":{"checkout":{"actionField":{"step":1,"option":"ALL PAYMENT","action":"checkout"},"products":[{"name":"Kuta Central Park ","id":"118","price":"288393","brand":"Kuta Central Park ","category":"4 Star","variant":"Bali","quantity":1,"dimension2":"2016-06-15","dimension3":"2016-06-16","dimension5":"MA1606008222","dimension6":"PENDING","metric1":1}]}}}';
        //real data
        $datalayer_array = json_decode($datalayer_json);
        
        print 'Stored Datalayer Info:';
        print '<pre>';
        print_r($datalayer_array);
        print '</pre>';
        
        //Now to build the array with analytics data to send to Google Analytics
        $hit_payload_array = [];
        $hit_payload_array['v'] = 1;
        $hit_payload_array['tid'] = 'UA-79090004-1'; //Analytics ID
        $hit_payload_array['t'] = 'event'; //type
        $hit_payload_array['ec'] = 'Ecommerce'; //Event Category - Can be customised
        $hit_payload_array['ea'] = 'Payment Confirmation'; //Event Action - Can be customised
        
        $hit_payload_array['cid'] = $analyticsdata['client_id']; //Client ID
        //Custom Dimensions / Metrics
        $hit_payload_array['cd1'] = $datalayer_array->dimension1; //Custom Dimenstion 1
        $hit_payload_array['cd4'] = $analyticsdata['payment_method']; //Custom Dimenstion 4

         //Document Return values - these can all be customised to suit goals/events in Analytics
        $hit_payload_array['dh'] = 'misteraladin.com'; //Document Host
        $hit_payload_array['dp'] = '/payment_return_path'; //Document Path
        $hit_payload_array['dt'] = 'Payment Completed'; //Document Title

        //Product Values
        $hit_payload_array['pa'] = 'purchase'; //Product Action

        foreach($datalayer_array->ecommerce->checkout->products as $index => $product){
            //Individual Products
            $prodkey = $index+1;
            $hit_payload_array['pr'.$prodkey.'id'] = $product->id; //Product 1 - ID
            $hit_payload_array['pr'.$prodkey.'nm'] = $product->name; //Product 1 - Name
            $hit_payload_array['pr'.$prodkey.'ca'] = $product->category; //Product 1 - Category
            $hit_payload_array['pr'.$prodkey.'br'] = $product->brand; //Product 1 - Brand
            $hit_payload_array['pr'.$prodkey.'va'] = $product->variant; //Product 1 - Variant
            $hit_payload_array['pr'.$prodkey.'pr'] = $product->price; //Product 1 - Price
            $hit_payload_array['pr'.$prodkey.'qt'] = $product->quantity; //Product 1 - Qty
            $hit_payload_array['pr'.$prodkey.'ps'] = $prodkey; //Product 1 - Position
            $hit_payload_array['pr'.$prodkey.'cc'] = ''; //Product 1 - Coupon Code

            //Product Custom Dimensions
            $hit_payload_array['pr'.$prodkey.'cd2'] = $product->dimension2; //Product 1 - Custom dimension 2
            $hit_payload_array['pr'.$prodkey.'cd3'] = $product->dimension3; //Product 1 - Custom dimension 3
            $hit_payload_array['pr'.$prodkey.'cd5'] = $product->dimension5; //Product 1 - Custom dimension 5
            $hit_payload_array['pr'.$prodkey.'cd6'] = $product->dimension6; //Product 1 - Custom dimension 6

            //Product Custom Metrics
            $hit_payload_array['pr1cm1'] = $product->metric1; //Product 1 - Custom metric 1
        }
        

        //Create a string from the array
        $hit_payload_string = '';
        foreach ($hit_payload_array as $key => $value) {
            $hit_payload_string .= $key.'='.str_replace(' ','%20',$value).'&';
        }
        return $hit_payload_string;

    }

    public function sendAnalyticsHit(Analyticsdata $analyticsdata_record){

        $hit_payload = $this->buildHitPayloadStringFromDataLayer($analyticsdata_record);
        
        print 'Generated Hit payload to be sent to google analytics:';
        print '<pre>'.$hit_payload.'</pre>';
        //$hit_payload = 'v=1&t=event&tid=UA-79090004-1&cid=5551233&dh=54.252.133.117&ti=T12345&ta=Mister%20Aladdin&tr=1000.00&tt=100.00&ts=0&tcc=SUMMER2013&pa=purchase&pr1id=P12345&pr1nm=Arves%20Module&pr1ca=Software&pr1br=Invenire&pr1va=Zip&pr1ps=1&dp=document_path_here&dt=doc_title&ec=Ecommerce&ea=Payment%20Confirmation 1';
        
        $client = new Client([
            'base_uri' => 'https://www.google-analytics.com/collect',
            'timeout'  => 5.0,
        ]);
        $response = $client->post('www.google-analytics.com/collect',[
            'body' => $hit_payload
        ]);

        print 'Google Analytics Response:';
        print '<pre>';
        print_r($response);
        print '</pre>';

        return true;
       
        

    }
}
