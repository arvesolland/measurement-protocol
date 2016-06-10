<!DOCTYPE html>
<html>
<head>
	<title>Cart View Page</title>
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
	  'price': '29.20',
	  'quantity': 1
	});

	// Transaction level information is provided via an actionFieldObject.
	ga('ec:setAction', 'purchase', {
	  'id': 'ORDER123456',
	  'affiliation': 'Mattis and Arves Store - Online',
	  'revenue': '37.39',
	  'tax': '2.85',
	  'shipping': '5.34'
	  //'coupon': 'SUMMER2013'    // User added a coupon at checkout.
	});

	ga('send', 'pageview');     // Send transaction data with initial pageview.

</script>
<h1>Payment Complete Page</h1>
<a href="demo">Go To Start</a>

<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>


</body>
</html>