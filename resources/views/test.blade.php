<!DOCTYPE html>
<html>
<head>
	<title>Test Page</title>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-79090004-1', 'auto');
  ga('send', 'pageview');

</script>

<button onClick="sendDataLayer();">Pay By Credit Card</button>

<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
<script type="text/javascript">
	function sendDataLayer(){
		console.log('sendDataLayer');
		var test_datalayer_string ='{"event":"purchase","dimension1":"guest","dimension4":"ALL PAYMENT","ecommerce":{"purchase":{"actionField":{"id":"MA1606001144","affiliation":"Online Store","revenue":"994368","tax":0,"shipping":0,"option":"ALL PAYMENT","coupon":"","action":"purchase"},"products":[{"name":"Fragrance Hotel Bugis","id":"957","price":"994368","brand":"Fragrance Hotel Bugis","category":"2 Star","variant":"Singapore","quantity":1,"coupon":"","dimension2":"2016-06-06","dimension3":"2016-06-07","dimension5":"MA1606001144","dimension6":"PENDING","metric1":1}]}}}';
		var test_client_id = "899621571.1464319615";
		var test_order_id = 'MA1606001144';
		var payment_method = 'credit_card';
		var status = 0;
		jQuery.ajax({
                    url: "api/analyticsdata",
                    type: "POST",
                    data: { 'datalayer' : test_datalayer_string, 'client_id': test_client_id, 'ref_id': test_order_id, 'payment_method': payment_method, 'status': status },
                    success: function(data) {
                        
                        //data = jQuery.parseJSON(data);
                        console.log(data);
                        //alert(data.message)
                        //location.reload();
                        
                    }
                });
	}
	//ga.getAll()[0].get('clientId'); //"899621571.1464319615"
	//ga.getAll()[0].get('trackingId'); //"UA-  -1"
	//var full_datalayer_string = '"[{"dimension1":"guest","event":"checkout","ecommerce":{"checkout":{"actionField":{"step":1,"option":"ALL PAYMENT","action":"checkout"},"products":[{"name":"Kuta Central Park ","id":"118","price":"288393","brand":"Kuta Central Park ","category":"4 Star","variant":"Bali","quantity":1,"dimension2":"2016-06-13","dimension3":"2016-06-14","dimension5":"MA1606005807","dimension6":"PENDING","metric1":1}]}}},{"event":"purchase","dimension1":"guest","dimension4":"ALL PAYMENT","ecommerce":{"purchase":{"actionField":{"id":"MA1606005807","affiliation":"Online Store","revenue":"288393","tax":0,"shipping":0,"option":"ALL PAYMENT","coupon":"","action":"purchase"},"products":[{"name":"Kuta Central Park ","id":"118","price":"288393","brand":"Kuta Central Park ","category":"4 Star","variant":"Bali","quantity":1,"coupon":"","dimension2":"2016-06-13","dimension3":"2016-06-14","dimension5":"MA1606005807","dimension6":"PENDING","metric1":1}]}}},{"gtm.start":1465516317892,"event":"gtm.js"},{"event":"gtm.dom"},{"event":"gtm.load"},{"gtm.element":{},"gtm.elementClasses":"","gtm.elementId":"full-name","gtm.elementTarget":"","event":"gtm.click","gtm.elementUrl":""},{"gtm.element":{},"gtm.elementClasses":"","gtm.elementId":"email","gtm.elementTarget":"","event":"gtm.click","gtm.elementUrl":""},{"gtm.element":{},"gtm.elementClasses":"","gtm.elementId":"phone-number","gtm.elementTarget":"","event":"gtm.click","gtm.elementUrl":""},{"gtm.element":{},"gtm.elementClasses":"btn-payment-step button-next","gtm.elementId":"","gtm.elementTarget":"","event":"gtm.click","gtm.elementUrl":""},{"gtm.element":{},"gtm.elementClasses":"btn-payment-step button-next","gtm.elementId":"","gtm.elementTarget":"","event":"gtm.click","gtm.elementUrl":""},{"gtm.element":{},"gtm.elementClasses":"","gtm.elementId":"","gtm.elementTarget":"","event":"gtm.click","gtm.elementUrl":"https://www.misteraladin.com/checkout?uniqueid=139bacf3-2e9d-11e6-8a88-065873a38165#tab-content-atm"}]"';
	var test_datalayer_string ='{"event":"purchase","dimension1":"guest","dimension4":"ALL PAYMENT","ecommerce":{"purchase":{"actionField":{"id":"MA1606001144","affiliation":"Online Store","revenue":"994368","tax":0,"shipping":0,"option":"ALL PAYMENT","coupon":"","action":"purchase"},"products":[{"name":"Fragrance Hotel Bugis","id":"957","price":"994368","brand":"Fragrance Hotel Bugis","category":"2 Star","variant":"Singapore","quantity":1,"coupon":"","dimension2":"2016-06-06","dimension3":"2016-06-07","dimension5":"MA1606001144","dimension6":"PENDING","metric1":1}]}}}';
	var test_datalayer_object = JSON.parse(test_datalayer_string);
	//var full_datalayer_object = JSON.parse(full_datalayer_string);
	console.log(test_datalayer_object);
</script>

</body>
</html>