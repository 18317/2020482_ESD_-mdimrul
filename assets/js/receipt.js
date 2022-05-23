$(document).ready(function () {
	"use strict";
	
	function getrecptno() {
		$.ajax({
			url: "class/receiptclass.php",
			method: "POST",
			async: false,
			data: {
				"recptno": 1,
			},
			success: function (result) {
				result = result.trim();
				$('#invoiceno').text(result);
			}
		});
	}
	
	function displayproduct(dropdown) {
		emptyactiverow();
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/receiptclass.php",
			method: 'POST',
			async: false,
			data: {
				"getproductname": 1
			},
			success: function (result) {
				result = result.trim();
				$(dropdown).html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
		sumtotalprice();
	}
	
	function emptyactiverow()
	{
		$('.rowactive .recproductstock, .rowactive .recunits, .rowactive .recprice, .rowactive .recproductlisttext').text('');
		$('.rowactive .rectotalprice, .rowactive .recfinalprice, .rowactive .recproductquantity').val('');
	}	
	
	$(document).on('click blur focus', '#receiptdata tbody tr', function () {
		$('#receiptdata tbody tr').removeClass('rowactive');
		$(this).addClass('rowactive');
	});

	$(document).on('click', '.rowactive .btnrecdelete', function () {
		$(this).closest('tr').remove();
		sumtotalprice();
	});
	
	$(document).on('change', '.rowactive .recproductlist', function () {
		emptyactiverow();
		var prodid = $(this).val();
		if (prodid != "") {					
		var itemrow = $('#receiptdata tbody tr').length;		
			var lastval = $("#receiptdata tbody tr:last .recproductlist").val();
			if(lastval == null) itemrow--;
			$('#invoicetotalitem').text(itemrow);			
			if (!$(this).closest('tr').next().length) {				
				$('#receiptdata tr:last').after('<tr><td><select class="recproductlist form-control"></select><span class="recproductlisttext d-none"></span></td><td class="recproductdetails"></td><td class="recproductdescrip"></td><td class="recproductstock"></td><td><input type="number" class="form-control recproductquantity" min="1" maxlength="5"></td><td class="recunits" id="recproductunit"></td><td class="recprice" id="recproductprice"></td><td><input type="text" class="form-control recfinalprice numeric" maxlength="4"></td><td><input type="text" class="form-control rectotalprice" readonly tabindex="-1"></td><td class="recdelete text-center p-0 m-0"></td></tr>');				
				$(".recproductlist").select2( {placeholder: "Select Product"} );
				displayproduct('#receiptdata tr:last .recproductlist');
			}
			$('.preloader').addClass('preloaderopen');
			var recprdname = $('.rowactive .recproductlist :selected').text();
			$.ajax({
				url: "class/receiptclass.php",
				method: "POST",
				async: false,
				data: {
					"getproddetail": 1,
					"prodid": prodid
				},
				dataType: "JSON",
				success: function (result) {
					var prddetail, cat, brand = ''; 
					if(result.category != null) cat = "<span class='reccategorylisttext'>"+ result.category + "</span><span class='reccategorylist d-none'>"+ result.categoryid + "</span>";
					if(result.brand != null) brand =  " - <span class='recbrandlisttext'>" + result.brand + "</span><span class='recbrandlist d-none'>"+ result.brandid + "</span>";
					prddetail = cat + brand;
					$('.rowactive .recproductlisttext').text(recprdname);
					$('.rowactive .recproductdetails').html(prddetail);
					$('.rowactive .recproductdescrip').text(result.description);
					$('.rowactive .recproductstock').text(result.stock);
					$('.rowactive .recunits').text(result.units);
					$('.rowactive .recprice').text(result.selling);
					$('.rowactive .recfinalprice').val(result.selling);
					$('.rowactive .rectotalprice').val(result.selling);
					$('.rowactive .recproductquantity').val('1');
					$('.rowactive .recdelete').html('<button type="button" class="btn btn-danger btnrecdelete" tabindex="-1"><i class="fa fa-minus"></i></button>');
				}
			});
			$('.preloader').removeClass('preloaderopen');
			sumtotalprice();
		}
	});
	
	function sumtotalprice() {
		$("#receiptamountdiv2 input").val('');
		var totalsum = 0, textboxvalue = 0;
		$("#receiptdata .rectotalprice").each(function () {
			textboxvalue = $(this).val();
			if ($.isNumeric(textboxvalue)) {
				totalsum += parseFloat(textboxvalue);
			}
		});
		$("#tbtotalamount").val(totalsum);
		$("#tbpayableamount").val(totalsum);
		$('#tbdiscount').val(0);
	}

	$(document).on('blur', '.rowactive .recproductquantity , .rowactive .recfinalprice', function () {
		var rowstk = parseFloat($('.rowactive .recproductstock').text());
		var rowqu = parseFloat($('.rowactive .recproductquantity').val());
		var rowpr = parseFloat($('.rowactive .recfinalprice').val());
		if (isNaN(rowqu)) rowqu = 0;
		if (isNaN(rowstk)) rowstk = 0;
		if (isNaN(rowpr)) rowpr = 0;
		if (rowqu > rowstk) {
			notification('Quantity greater than Stock', 'text-danger', 'bg-danger');
			$('.rowactive .recproductquantity, .rowactive .recfinalprice, .rowactive .rectotalprice').val('0');
		} else {
			if (rowqu != null && rowpr != null) {
				var rowtot = rowqu * rowpr;
				$('.rowactive .rectotalprice').val(rowtot.toFixed(2));

			} else {
				$('.rowactive .rectotalprice').val('');
			}
		}
		sumtotalprice();
	});
	
	$(document).on('blur', '#tbdiscount', function () {
		var totalamount = $('#tbtotalamount').val();
		var disc = $(this).val();
		var discount = totalamount - disc;
		$('#tbpayableamount').val(discount);
	});
		
	$(document).on('click', '#btncreatereceipt', function () {
		var tbrow = $('#receiptdata tbody tr').length; 
		if(tbrow > 1)
			{
				$('.preloader').addClass('preloaderopen');					
		var recproductlist = [];
		var recproductlisttext = [];
		var reccategorylist = [];
		var recbrandlist = [];
		var recproductdetails = [];
		var recproductdescrip = [];
		var recproductstock = [];
		var recproductquantity = [];
		var recunits = [];
		var recprice = [];
		var recfinalprice = [];
		var rectotalprice = [];
		var invoiceid = parseInt($('#invoiceno').text());
		var totalamount = $('#tbtotalamount').val();
		var discount = $('#tbdiscount').val();
		var payableamount = $('#tbpayableamount').val();
		$('.recproductlist').each(function () {
			recproductlist.push($(this).val());
		});
		$('.recproductlisttext').each(function () {
			recproductlisttext.push($(this).text());
		});
		$('.reccategorylist').each(function () {
			reccategorylist.push($(this).text());
		});
		$('.recbrandlist').each(function () {
			recbrandlist.push($(this).text());
		});
		$('.recproductdetails').each(function () {
			recproductdetails.push($(this).text());
		});
		$('.recproductdescrip').each(function () {
			recproductdescrip.push($(this).text());
		});
		$('.recproductstock').each(function () {
			recproductstock.push($(this).text());
		});
		$('.recproductquantity').each(function () {
			recproductquantity.push($(this).val());
		});
		$('.recunits').each(function () {
			recunits.push($(this).text());
		});
		$('.recprice').each(function () {
			recprice.push($(this).text());
		});
		$('.recfinalprice').each(function () {
			recfinalprice.push($(this).val());
		});
		$('.rectotalprice').each(function () {
			rectotalprice.push($(this).val());
		});
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/receiptclass.php",
			method: 'POST',
			async: false,
			data: {
				savereceipt: '1',
				invoiceid: invoiceid,
				recproductlist: recproductlist,
				recproductlisttext: recproductlisttext,
				reccategorylist: reccategorylist,
				recbrandlist: recbrandlist,
				recproductdetails: recproductdetails,				
				recproductdescrip: recproductdescrip,				
				recproductstock: recproductstock,				
				recproductquantity: recproductquantity,
				recunits: recunits,
				recprice: recprice,
				recfinalprice: recfinalprice,
				rectotalprice: rectotalprice,	
				totalamount: totalamount,
				discount: discount,
				payableamount: payableamount,
			},
			success: function (response) {
				response = response.trim();
				if (response.indexOf('done') > -1) {
					notification('Receipt Create Successfully.', 'text-success', 'bg-success');
					setTimeout(function() { location.reload();}, 2000);					
				} else {
					notification('Action not perform at this time', 'text-danger', 'bg-danger');
				}
			}
		});
		$('.preloader').removeClass('preloaderopen');
		$('#productdetaildata tbody tr').removeClass('rowactive');
		$('#productdetaildata input[type="text"]').val('');
		$('#productdetailmodal').modal('hide');
		$('.preloader').removeClass('preloaderopen');
			}
		else {
			notification('Please Add atleast 1 Product.', 'text-danger', 'bg-danger');
		}
	});

	$(document).on('click', '#btnviewreceipt', function () {
		displayreceiptdetail();
		$('#tbsearchtodate, #tbsearchfromdate').val('');
		$('#invoicehistorymodal').modal('show');
	});
	
	function displayreceiptdetail() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/receiptclass.php",
			method: "POST",
			async: false,
			data: {
				"receiptrecord": 1,
				"defaultrecord": 1
			},
			success: function (result) {
				$('#receiptdetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}
	
	$(document).on('click', '#btnsearchinvoice', function () {
		var todate = $('#tbsearchtodate').val();
		var fromdate = $('#tbsearchfromdate').val();	
		
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/receiptclass.php",
			method: "POST",
			async: false,
			data: {
				"receiptrecord":1,
				"customrecord": 1,
				"todate" : todate,
				"fromdate" : fromdate
			},
			success: function (result) {
				$('#receiptdetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');		
	});
	
	$(document).on('click', '#receiptdetaildata tbody tr .fa-eye', function () {
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
			url: "class/receiptclass.php",
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
		
	$(document).ready(function(){
		$("#tbsearchreceiptdata").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#receiptdetaildata tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);				
			});		
		});
		
	
	});

	getrecptno();
	displayproduct('.recproductlist');
	
	
});