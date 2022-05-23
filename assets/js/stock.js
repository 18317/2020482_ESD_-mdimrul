$(document).ready(function () {
	"use strict";
	var date = new Date();
	var today = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
	date.setDate(date.getDate() - 1);
	var yesterday = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
	
	function displaystockdetail(day) {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/stockclass.php",
			method: "POST",
			async: false,
			data: {
				"stockrecord": 1,
				"day": day,
			},
			success: function (result) {
				$('#prevproductdetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}

	function displaycurrentstock() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/stockclass.php",
			method: "POST",
			async: false,
			data: {
				"currentstockrecord": 1
			},
			success: function (result) {
				$('#prevproductdetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}

	$(document).on('click', '#btnviewstock', function () {
		$('#stockdate').text('In Stock');
		displaycurrentstock();
	});

	$(document).on('click', '#btntodaystock', function () {
		$('#stockdate').text(today);
		displaystockdetail(today);
	});

	$(document).on('click', '#btnyeststock', function () {
		$('#stockdate').text(yesterday);
		displaystockdetail(yesterday);
	});
		
	$(document).on('click', '#btnaddprdmod', function () {
		$('#productdetaildata input[type="text"]').val('');
		$("#tbtotalamount").text('0');
	});

	$(document).on('click', '#btnaddstock', function () {
		$('.preloader').addClass('preloaderopen');
		var productid = [];
		var productcategory = [];
		var productbrand = [];
		var productname = [];
		var productsize = [];
		var tbquantity = [];
		var tbunitprice = [];
		var tbtotalprice = [];
		var tbsellername = [];
		$('.productid').each(function () {
			productid.push($(this).text());
		});
		$('.productcategory').each(function () {
			productcategory.push($(this).text());
		});
		$('.productbrand').each(function () {
			productbrand.push($(this).text());
		});
		$('.productname').each(function () {
			productname.push($(this).text());
		});
		$('.productsize').each(function () {
			productsize.push($(this).val());
		});
		$('.tbquantity').each(function () {
			tbquantity.push($(this).val());
		});
		$('.tbunitprice').each(function () {
			tbunitprice.push($(this).val());
		});
		$('.tbtotalprice').each(function () {
			tbtotalprice.push($(this).val());
		});
		$('.tbsellername').each(function () {
			tbsellername.push($(this).val());
		});
		
		
		$.ajax({
			url: "class/stockclass.php",
			method: 'POST',
			async: false,
			data: {
				stockadd: '1',
				productid: productid,
				productcategory: productcategory,
				productbrand: productbrand,
				productname: productname,
				productsize: productsize,
				tbquantity: tbquantity,
				tbunitprice: tbunitprice,
				tbtotalprice: tbtotalprice,
				tbsellername: tbsellername
			},
			success: function (response) {
				response = response.trim();
				if (response.indexOf('done') > -1) {
					notification('Stock Add Successfully.', 'text-success', 'bg-success');
				} else {
					notification('Action not perform at this time', 'text-danger', 'bg-danger');
				}
			}

		});
		$('#productdetaildata tbody tr').removeClass('rowactive');
		$('#productdetaildata input[type="text"]').val('');
		$('#productdetailmodal').modal('hide');
		$('.preloader').removeClass('preloaderopen');
	});


	function displayproductdetail() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/stockclass.php",
			method: "POST",
			async: false,
			data: {
				"productrecord": 1,
			},
			success: function (result) {
				$('#productdetaildata').html(result);
			}
		});
		var tablerow = $('#productdetaildata tbody tr').length;
		if (tablerow == 0) {
			$('#productdetailmodal .modal-footer').addClass('d-none');
		}
		$('.preloader').removeClass('preloaderopen');
	}

	$(document).on('click blur focus', '#productdetaildata tbody tr', function () {
		$('#productdetaildata tbody tr').removeClass('rowactive'); 
		$(this).addClass('rowactive');
	});
	
	$(document).on('blur', '.rowactive ', function () {
		var rowqu = $('.rowactive .tbquantity').val();
		var rowun = $('.rowactive .tbunitprice').val();
		if (rowqu != "" && rowun != "") {
			var rowtot = rowqu * rowun;
			$('.rowactive .tbtotalprice').val(rowtot.toFixed(2));
		} else {
			$('.rowactive .tbtotalprice').val('');
		}

		var totalsum = 0;

		$("#productdetaildata .tbtotalprice").each(function () {
			var textboxvalue = $(this).val();
			if ($.isNumeric(textboxvalue)) {
				totalsum += parseFloat(textboxvalue);
			}
		});
		$("#tbtotalamount").text(totalsum.toFixed(2));
	});
	
	$("#tbsearch1").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#productdetaildata tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);				
			});		
		});
	$("#tbsearch2").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#prevproductdetaildata tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);				
			});		
		});

	displayproductdetail();

});