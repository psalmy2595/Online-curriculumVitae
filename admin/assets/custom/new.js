/*JS function that adds new field*/
































/*Modal functions*/


//JQuery function to set Customer id value
$(document).ready(function(){
	$(".dltBtn").click(function(e){
		e.preventDefault();

		try{
			var d = $(this).data('all');
			var customer_id = d.id;

			$("#delModal [name='customer_id']").val(customer_id);

			$("#delModal").modal('show');
		}
		catch(err){
			alert(err);
		}
	});
});

//JQuery function to set Advert id value
$(document).ready(function(){
	$(".dltCat").click(function(e){
		e.preventDefault();

		try{
			var d = $(this).data('all');
			var category_id = d.id;
			console.log(category_id);

			$("#delModal [name='category_id']").val(category_id);

			$("#delModal").modal('show');
		}
		catch(err){
			alert(err);
		}
	});
});

//JQuery function to set Advert id value and delete
$(document).ready(function(){
	$(".dltAds").click(function(e){
		e.preventDefault();

		try{
			var d = $(this).data('all');
			var ads_id = d.id;
			

			$("#delModal [name='ads_id']").val(ads_id);

			$("#delModal").modal('show');
		}
		catch(err){
			alert(err);
		}
	});
});

//JQuery function to set Advert id value and activate
$(document).ready(function(){
	$(".actAds").click(function(e){
		e.preventDefault();

		try{
			var d = $(this).data('all');
			var ads_id = d.id;
			

			$("#actModal [name='ads_id']").val(ads_id);

			$("#actModal").modal('show');
		}
		catch(err){
			alert(err);
		}
	});
});

//JQuery function to set Advert id value and De-activate
$(document).ready(function(){
	$(".deactAds").click(function(e){
		e.preventDefault();

		try{
			var d = $(this).data('all');
			var ads_id = d.id;
			

			$("#deactModal [name='ads_id']").val(ads_id);

			$("#deactModal").modal('show');
		}
		catch(err){
			alert(err);
		}
	});
});

