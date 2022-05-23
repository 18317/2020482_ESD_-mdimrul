$(document).ready(function () {
	"use strict";

	$(document).on('change', '#ddcategory', function () {
		var categoryid = $(this).val();
		$('#ddbrand').empty();				
		$('#tbbrand, #tbproductcode, #tbproductdescription, #tbproductunit').val('');		
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/productclass.php",
			method: 'POST',
			async: false,
			data: {
				"getbrand": 1,
				"categoryid": categoryid
			},
			success: function (response) {
				response = response.trim();
				$('#ddbrand').html(response);
				$('#tbcategory').val($('#ddcategory :selected').text());
			}
		});
		$('.preloader').removeClass('preloaderopen');
	});

	$(document).on('change', '#ddbrand', function () {
		$('#tbbrand').val($('#ddbrand :selected').text());
		$('#tbproductcode, #tbproductdescription, #tbproductunit').val('');	
	});
	
	$(document).on('click', '#btnaddprdmod', function () {		
		$("#ddcategory").val($("#ddcategory option:first").val());
		$("#ddbrand").empty();
		$("#tbproductunit").val($("#tbproductunit option:first").val());
		$('#tbproductcode').val('');
		$('#tbproductdescription').val('');
		$('#tbcategory').val('');
		$('#tbbrand').val('');
		$('#productdetailmodal .modal-title').text('Add New Product');
		$('#productdetailmodal #btnaddproductdetail').text('Add');
		$('#tbaction').val('add');
		$("#productdetailmodal select").prop("disabled",false);
		$('#tbrowid').val('');
	});

	$(document).on('click', '#btnaddproductdetail', function () {
		validate('#ddcategory');
		validate('#ddbrand');
		validate('#tbproductcode');
		validate('#tbproductunit');
		if (!$('#productdetailform div').hasClass('is-invalid')) {
			$('.preloader').addClass('preloaderopen');
			$.ajax({
				url: "class/productclass.php",
				method: 'POST',
				async: false,
				data: $('#productdetailform').serialize() + "&addproductdetail=1",
				success: function (response) {
					response = response.trim();
					if (response == "add") {
						notification('Product Add Successfully.', 'text-success', 'bg-success');
						displayproductdetail();
					} else if (response == "update") {
						notification('Product Update Successfully.', 'text-success', 'bg-success');
						displayproductdetail();
					} else if (response == "duplicate") {
						notification('Product already exit.', 'text-danger', 'bg-danger');
					} else {
						notification('Action not perform at this time', 'text-danger', 'bg-danger');
					}
					$('#productdetailform')[0].reset();
					$('#ddbrand option').remove();
					$('#productdetailmodal').modal('hide');
					$('.preloader').removeClass('preloaderopen');
				}
			});
		}
	});

	
	$(document).on("click", "#productdetaildata tbody tr .fa-trash", function () {
		$('form').trigger("reset");
		var row = $(this).parents("tr:first");
		var id = row.children("td:eq(0)").html();
		var prdname = row.children("td:eq(3)").html();
		$('#modaltext').text(prdname);
		$('#deleteid').val(id);
	});

	$(document).on('click', '#btnmodaldelete', function () {
		var deleteid = $('#deleteid').val();
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/productclass.php",
			method: 'POST',
			async: false,
			data: {
				"delete": 1,
				"deleteid": deleteid
			},
			success: function (response) {
				response = response.trim();
				if (response == "delete") {
					notification('Product Delete Successfully.', 'text-success', 'bg-success');
					$('#' + deleteid).closest('tr').remove();
				} else {
					notification('Action not perform at this time', 'text-danger', 'bg-danger');
				}
				$('#deleteform')[0].reset();
				$('#deletemodal').modal('hide');
				$('.preloader').removeClass('preloaderopen');

			}
		});
	});
	
	$(document).on("click", "#productdetaildata tbody tr .fa-edit", function () {
		$('form').trigger("reset");
		remove();
		var row = $(this).parents("tr:first");
		var rowid = row.children("td:eq(0)").html();
		var category = row.children("td:eq(1)").html();
		var brand = row.children("td:eq(2)").html();
		var productcode = row.children("td:eq(3)").html();
		var description = row.children("td:eq(4)").html();
		var unit = row.children("td:eq(5)").html();
		var rowstatus = row.children("td:eq(6)").html();
		$('#productdetailmodal .modal-title').text('Update ' + productcode);
		$('#productdetailmodal #btnaddproductdetail').text('Update');	
		$('#tbaction').val('update');
		$('#tbrowid').val(rowid);
		$('#ddcategory').prop({'selectedIndex':'0',"disabled":"true"});
		$("#ddcategory option").filter(function() {return $(this).text() == category;}).prop("selected", true);
		$("#ddbrand").empty();
		$("#ddbrand").prepend("<option selected>"+brand+"</option>").prop("disabled",true);		
		$('#tbproductcode').val(productcode);
		$('#tbproductdescription').val(description);
		$('#tbproductunit').val(unit);		
		$('#ddstatus').prop('selectedIndex',0);
		rowstatus = rowstatus.split('">').pop().split('</span>')[0];
		$("#ddstatus option").filter(function() {return $(this).text() == rowstatus;}).prop("selected", true);		
	});
 
	function displayproductdetail() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/productclass.php",
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

	function displayCategoryList() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/brandclass.php",
			method: "POST",
			async: false,
			data: {
				"CategoryList": 1,
			},
			success: function (result) {
				$('#ddcategory').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}
	
	$("#tbsearch").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#productdetaildata tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);				
			});		
		});
	
	
	displayCategoryList();
	displayproductdetail();

});
