$(document).ready(function () {
	"use strict";
	
	function gettodaysale() {
		$.ajax({
			url: "class/dashboardclass.php",
			method: "POST",
			async: false,
			data: {
				"todaysale": 1,
			},
			success: function (result) {
				result = result.trim();
				if(result.length == 0) $('#todaysale').text('0');
				else $('#todaysale').text(result);
			}
		});
	}
	
	function displayproductdetail() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/dashboardclass.php",
			method: "POST",
			async: false,
			data: {
				"productrecord": 1,
			},
			success: function (result) {
				$('#productdetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}
	
	function displaycurrentstock() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/dashboardclass.php",
			method: "POST",
			async: false,
			data: {
				"currentstockrecord": 1
			},
			success: function (result) {
				$('#stockdetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}
	

	gettodaysale();
	displayproductdetail();
	displaycurrentstock();
	
	
});