<!DOCTYPE html>
<html>
<head>
	<title>Checkout Page</title>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-79090004-1', 'auto');
  ga('require', 'ec');

   ga('ec:addProduct', {
	      'id': 'P12345',
		  'name': 'Android Warhol T-Shirt',
		  'category': 'Apparel',
		  'brand': 'Google',
		  'variant': 'black',
	      'price': '21.89',
	      'quantity': 2
	});
	ga('ec:setAction','checkout', {
	    'step': 1,            // A value of 1 indicates this action is first checkout step.
	    'option': 'credit_card'      // Used to specify additional info about a checkout stage, e.g. payment method.
	});

	 ga('send', 'pageview');   // Pageview for payment.html

</script>
<h1>Checkout Page</h1>
<button onClick="sendDataLayer('credit_card');">Pay By Credit Card</button>
<button onClick="sendDataLayer('atm_automatic');">Pay By ATM Automatic</button>
<button onClick="sendDataLayer('bca_klikpay');">Pay By BCA Klikpay</button>
<button onClick="sendDataLayer('mandiri_klickpay');">Pay By Mandiri Klikpay</button>
<button onClick="sendDataLayer('climb_clicks');">Pay By Climb Clicks</button>
<button onClick="sendDataLayer('transfer');">Pay By Transfer</button>

<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
<script type="text/javascript">
	
	function sendDataLayer(payment_method){
		
		var test_datalayer_string = '{"dimension1":"guest","event":"checkout","ecommerce":{"checkout":{"actionField":{"step":1,"option":"ALL PAYMENT","action":"checkout"},"products":[{"name":"Kuta Central Park ","id":"118","price":"288393","brand":"Kuta Central Park ","category":"4 Star","variant":"Bali","quantity":1,"dimension2":"2016-06-15","dimension3":"2016-06-16","dimension5":"MA1606008222","dimension6":"PENDING","metric1":1}]}}}';
		var test_client_id = "899621571.1464319615";
		var test_order_id = 'MA1606001144';
		//var payment_method = 'credit_card';
		var status = 0;
		jQuery.ajax({
                    url: "api/analyticsdata",
                    type: "POST",
                    data: { 'datalayer' : test_datalayer_string, 'client_id': test_client_id, 'ref_id': test_order_id, 'payment_method': payment_method, 'status': status },
                    success: function(data) {
                    	alert('Analytics data has now been stored in Web Service for later use.');
                        console.log(data);
                    }
                });
	}
	
</script>

<script type="text/javascript">
	function storeAnalyticsData(){
		//This function extracts neccessary datalayer information from checkout page, 
		//and creates an ajax request that can store this information for later use
		//Should be implemented on last part of checkout process that is on site
		
		var data_obj = null;
		var found = false;
		for (var prop in dataLayer) {
		   	if( !found && dataLayer[prop]['ecommerce']['purchase'] !== null && typeof dataLayer[prop]['ecommerce']['purchase'] === 'object'){
		  	   	//this is a datalayer object that contains the neccessary product information 
		  	   	data_obj = dataLayer[prop]['ecommerce']['purchase'];
		  	   	found = true;
		   	}
		  
		}

		if( data_obj !== null && typeof data_obj === 'object'){
		    console.log(data_obj);
		    //get order id
		    var order_id = data_obj['products'][0]['dimension5'];
			//get client id (analytics session)
			var client_id = ga.getAll()[0].get('clientId');
			//store data in API service
			jQuery.ajax({
			        url: "http://54.252.133.117api/analyticsdata",
			        type: "POST",
			        data: { 'datalayer' : data_obj, 'client_id': client_id, 'ref_id': order_id, 'payment_method': 'credit_card', 'status': status },
			        success: function(data) {
			            //console.log(data);
			        }
			 });
		}
	}

	
</script>

</body>
</html>