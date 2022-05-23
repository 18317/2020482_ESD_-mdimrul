$(document).ready(function () {
	"use strict";

	$(document).on('click', '#btnsearchstock', function () {
		var todate = $('#tbsearchtodate').val();
		var fromdate = $('#tbsearchfromdate').val();
		displaystockdetail(todate, fromdate);	
	});
	
	$(document).on('click', '#btnsearchinvoice', function () {
		var todate = $('#tbsearchtodate').val();
		var fromdate = $('#tbsearchfromdate').val();
		displayreceiptdetail(todate, fromdate);	
	});
	
	//display stock report
	function displaystockdetail(todate, fromdate) {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/reportclass.php",
			method: "POST",
			async: false,
			data: {
				"stockrecord": 1,
				"todate" : todate,
				"fromdate" : fromdate
			},
			success: function (result) {
				$('#stockdetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}

	//display receipe report
	function displayreceiptdetail(todate, fromdate) {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/reportclass.php",
			method: "POST",
			async: false,
			data: {
				"receiptrecord": 1,
				"todate" : todate,
				"fromdate" : fromdate
			},
			success: function (result) {
				$('#invoicedetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}

	$(document).on('click', '#invoicedetaildata tbody tr .fa-eye', function () {
		$('.preloader').addClass('preloaderopen');
		$('#invoicedetaildatetime, #invoicedetailinvoiceno, #invoicedetailtbtotalamount, #invoicedetailtbdiscount, #invoicemodaldiscount, #invoicedetailtbpayableamount, #invoicedetailtotalitem').text('');
		var row = $(this).parents("tr:first");		
		var rowid = row.children("td:eq(0)").html();
			var totalamount = row.children("td:eq(1)").html();
			var discount = row.children("td:eq(2)").html();
			var payamount = row.children("td:eq(3)").html();			
			var date = row.children("td:eq(4)").html();	
		$('#invoicedetaildatetime').text(date);
		$('#invoicedetailinvoiceno').text(rowid);
		$('#invoicedetailtbtotalamount').text(totalamount);
		$('#invoicedetailtbdiscount').text(discount);
		$('#invoicedetailtbpayableamount').text(payamount);
		$.ajax({
			url: "class/reportclass.php",
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
		$('#invoicedetailtotalitem').text($('#singleinvoicedetails tbody tr').length);
		$('.preloader').removeClass('preloaderopen');
	});

});
