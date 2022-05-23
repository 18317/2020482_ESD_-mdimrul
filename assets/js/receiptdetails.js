$(document).ready(function () {
	"use strict";

	function displayreceiptdetail() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/receiptdetailsclass.php",
			method: "POST",
			async: false,
			data: {
				"receiptrecord": 1,
			},
			success: function (result) {
				$('#receiptdetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}
	
	$(document).on('click', '#receiptdetaildata tbody tr .fa-eye', function () {
		$('.preloader').addClass('preloaderopen');
		$('#invoicedatetime, #invoiceid, #tbcustomername, #tbcustomermobile, #tbcustomeraddress, #invoicemodaltotal, #invoicemodaldiscount, #invoicemodalamount, #invoicemodalpaid, #invoicemodalbalance, #invoicetotalitem').text('');
		  
		var row = $(this).parents("tr:first");		
		var rowid = row.children("td:eq(0)").html();
			var name = row.children("td:eq(1)").html();
			var mobile = row.children("td:eq(2)").html();
			var address = row.children("td:eq(3)").html();
			var totalamount = row.children("td:eq(4)").html();
			var discount = row.children("td:eq(5)").html();
			var payamount = row.children("td:eq(6)").html();
			var paidamount = row.children("td:eq(7)").html();
			var remainingamount = row.children("td:eq(8)").html();			
			var date = row.children("td:eq(9)").html();		  
		$('#invoicedatetime').text(date);
		$('#invoiceid').text(rowid);
		$('#tbcustomername').text(name);
		$('#tbcustomermobile').text(mobile);
		$('#tbcustomeraddress').text(address);
		$('#invoicemodaltotal').text(totalamount);
		$('#invoicemodaldiscount').text(discount);
		$('#invoicemodalamount').text(payamount);
		$('#invoicemodalpaid').text(paidamount);
		remainingamount = remainingamount.split('">').pop().split('</span>')[0];
		$('#invoicemodalbalance').text(remainingamount);
		$.ajax({
			url: "class/receiptdetailsclass.php",
			method: "POST",
			async: false,
			data: {
				"receiptsinglerecord": 1,
				"invoiceid": rowid
			},
			success: function (result) {
				$('#singleinvoicedetails').html(result);
			}
		});
		$('#invoicetotalitem').text($('#singleinvoicedetails tbody tr').length);
		$('.preloader').removeClass('preloaderopen');
	});
	
	$(document).ready(function(){
		$("#tbsearchreceiptdata").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#receiptdetaildata tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);				
			});			
			
		});
	});

	displayreceiptdetail();

});
