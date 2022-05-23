$(document).ready(function () {
	"use strict";

	//display price details
	function displaypricedetail() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/pricelistclass.php",
			method: "POST",
			async: false,
			data: {
				"productpricerecord": 1,
			},
			success: function (result) {
				$('#productpricedata').html(result);
			}
		});
		var tablerow = $('#productpricedata tbody tr').length;
		if(tablerow == 0)
			{
				$('#btnupdatepricelist').addClass('d-none');
			}
		
		$('.preloader').removeClass('preloaderopen');
	}
	
	//update product price list
$(document).on('click', '#btnupdatepricelist', function () {
	$('.preloader').addClass('preloaderopen');
 var productid = [];
  var tbpriceselling = [];
  $('.productid').each(function(){
   productid.push($(this).text());
  });
  $('.tbpriceselling').each(function(){
   tbpriceselling.push($(this).val());
  });
  $.ajax({
  url: "class/pricelistclass.php",
				method: 'POST',
				async: false,
   data:{updatesellingprice:'1',productid:productid, tbpriceselling:tbpriceselling},
   success: function (response) {
				response = response.trim();
	  if(response.indexOf('update') > -1)
		   {
			   notification('Price List Update Successfully.', 'text-success', 'bg-success');
		   }
	   else
		   {
			   notification('Action not perform at this time', 'text-danger', 'bg-danger');
		   }
			}	  
   });
	$('.preloader').removeClass('preloaderopen');
});
	
	$("#tbsearch").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#productpricedata tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);				
			});		
		});
	
		//on load function
	displaypricedetail();

});