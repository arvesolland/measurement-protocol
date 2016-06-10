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
  ga('require', 'ec');
  

  ga('ec:addImpression', {
	  'id': 'P12345',                   // Product details are provided in an impressionFieldObject.
	  'name': 'Android Warhol T-Shirt',
	  'category': 'Apparel/T-Shirts',
	  'brand': 'Google',
	  'variant': 'black',
	  'list': 'Search Results',
	  'position': 1                     // 'position' indicates the product position in the list.
	});

  ga('ec:addImpression', {
	  'id': 'P67890',
	  'name': 'YouTube Organic T-Shirt',
	  'category': 'Apparel/T-Shirts',
	  'brand': 'YouTube',
	  'variant': 'gray',
	  'list': 'Search Results',
	  'position': 2
	});

  ga('send', 'pageview');

</script>
<h1>Starting Ecommerce Demo</h1>

<a href="demo_product" onclick="onProductClick(); return !ga.loaded;">View Product: Android Warhol T-Shirt</a>

<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

<script type="text/javascript">
	// Called when a link to a product is clicked.
	function onProductClick() {
	  ga('ec:addProduct', {
	    'id': 'P12345',
	    'name': 'Android Warhol T-Shirt',
	    'category': 'Apparel',
	    'brand': 'Google',
	    'variant': 'black',
	    'position': 1
	  });
	  ga('ec:setAction', 'click', {list: 'Search Results'});

	  // Send click with an event, then send user to product page.
	  ga('send', 'event', 'UX', 'click', 'Results', {
	    hitCallback: function() {
	      document.location = '/demo_product';
	    }
	  });
	}

</script>

</body>
</html>