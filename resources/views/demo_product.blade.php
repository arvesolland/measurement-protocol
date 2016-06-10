<!DOCTYPE html>
<html>
<head>
	<title>Product View Page</title>
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
	  'variant': 'black'
	});

	ga('ec:setAction', 'detail');

  ga('send', 'pageview');

</script>
<h1>Product View Page</h1>
<!-- <a href="demo_cart">Add Product to cart</a> -->

<a href="demo_cart" onclick="addToCart(); return !ga.loaded;">Add Product to Cart</a>

<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

<script type="text/javascript">
	// Called when a product is added to a shopping cart.
	function addToCart(product) {
	  ga('ec:addProduct', {
	      'id': 'P12345',
		  'name': 'Android Warhol T-Shirt',
		  'category': 'Apparel',
		  'brand': 'Google',
		  'variant': 'black'
	      'price': '21.89',
	      'quantity': 2
	  });
	  ga('ec:setAction', 'add');
	  ga('send', 'event', 'UX', 'click', 'add to cart');     // Segnd data using an event.

	  ga('send', 'event', 'UX', 'click', 'add to cart', {
	    hitCallback: function() {
	      document.location = '/demo_cart';
	    }
	  });
	}

</script>

</body>
</html>