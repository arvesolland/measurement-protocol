function storeAnalyticsData(){
	//This function extracts neccessary datalayer information from checkout page, 
	//and creates an ajax request that can store this information for later use
	//Should be implemented on last part of checkout process that is on site
	
	var data_obj = null;
	var found = false;
	for (var prop in dataLayer) {
		if( !found && dataLayer[prop]['ecommerce'] !== null && typeof dataLayer[prop]['ecommerce'] !== 'undefined'){
		   	if( !found && dataLayer[prop]['ecommerce']['purchase'] !== null && typeof dataLayer[prop]['ecommerce']['purchase'] === 'object'){
		  	   	//this is a datalayer object that contains the neccessary product information 
		  	   	data_obj = dataLayer[prop]['ecommerce']['purchase'];
		  	   	found = true;
		   	}
	   }
	  
	}

	if (found){

		if( data_obj !== null && typeof data_obj === 'object'){
		    console.log(data_obj);
		    //set a random order id ( for testing only)
		    var order_id = Math.floor(Math.random() * 1000) + 1;
		    //get order id
		    if (data_obj['products'][0]['dimension5'] !== null && typeof data_obj['products'][0]['dimension5'] !== 'undefined' ){
		    	//order id found in product data
		    	order_id = data_obj['products'][0]['dimension5'];	
		    }else{
		    	console.log('No order id ( dimension5 ) was found in the product data, using random order id: '+ order_id);
		    }
		    
			//get client id (analytics session)
			var client_id = ga.getAll()[0].get('clientId');
			//store data in API service
			jQuery.ajax({
			        url: "https://connectionmasters.com.au/api/analyticsdata",
			        type: "POST",
			        data: { 'datalayer' : data_obj, 'client_id': client_id, 'ref_id': order_id, 'payment_method': 'credit_card', 'status': status },
			        success: function(data) {
			            console.log(data);
			        }
			 });
		}
	} else {
		console.log('Required Datalayer object not found');
	}
}