$(document).ready(function () {
	"use strict";
	$(document).on('change', '#ddcategory', function () {			
	var categoryname = $('#ddcategory :selected').text();
	$('#tbbrandname').val('');
	$('#tbcategory').val('');
	$('#tbcategory').val(categoryname);	
	});	
	
	$(document).on('click', '#btnaddbrand', function () {
		validate('#ddcategory');
		validate('#tbbrandname');
		if (!$('#branddetailform div').hasClass('is-invalid')) {
			$('.preloader').addClass('preloaderopen');
			$.ajax({
				url: "class/brandclass.php",
				method: 'POST',
				async: false,
				data: $('#branddetailform').serialize() + "&addbranddetail=1",
				success: function (response) {
					response = response.trim();
					if (response == "add") {
						notification('New Brand Add Successfully.', 'text-success', 'bg-success');
						displaybranddetail();
					} else if (response == "update") {
						notification('Brand Update Successfully.', 'text-success', 'bg-success');
						displaybranddetail();
					} else if (response == "duplicate") {
						notification('Category with this Brand already exit.', 'text-danger', 'bg-danger');
					} else {
						notification('Action not perform at this time', 'text-danger', 'bg-danger');
					}
					$('#branddetailform')[0].reset();
					$('#branddetailmodal').modal('hide');
					$('.preloader').removeClass('preloaderopen');
				}
			});
		}
	});

	$(document).on('click', '#btnaddprdmod', function () {
		$('form').trigger("reset");
		remove();
		$('#ddcategory').prop('selectedIndex',0);
		$('#branddetailmodal .modal-title').text('Add New Brand ');
		$('#branddetailmodal #btnaddbranddetail').text('Add');
		$('#branddetailmodal #btnaddbrand').text('Add');
		$('#ddcategory, #tbbrandname').prop("disabled", false);
		$('#ddstatus').prop('selectedIndex',0);
		$('#tbaction').val('add');
	});
	
	$(document).on('click', '#branddetaildata tbody tr .fa-edit', function () {
		$('form').trigger("reset");
		remove();
		var row = $(this).parents("tr:first");		
		var rowid = row.children("td:eq(0)").html();
		var catname = row.children("td:eq(1)").html();
		var brandname = row.children("td:eq(2)").html();
		var rowstatus = row.children("td:eq(3)").html();
		$('#branddetailmodal .modal-title').text('Update ' + catname);
		$('#branddetailmodal #btnaddbrand').text('Update');	
		$('#tbaction').val('update');
		$('#tbrowid').val(rowid);
		$('#ddcategory').prop('selectedIndex',0);
		$("#ddcategory option").filter(function() {return $(this).text() == catname;}).prop("selected", true);
		$('#ddcategory').prop("disabled",true);
		$('#tbbrandname').val(brandname).prop("disabled",true);
		$('#ddstatus').prop('selectedIndex',0);
		rowstatus = rowstatus.split('">').pop().split('</span>')[0];
		$("#ddstatus option").filter(function() {return $(this).text() == rowstatus;}).prop("selected", true);
	});
	

	function displaybranddetail() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/brandclass.php",
			method: "POST",
			async: false,
			data: {
				"brandrecord": 1,
			},
			success: function (result) {
				$('#branddetaildata').html(result);
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

	displaybranddetail();
	displayCategoryList();

$("#tbsearch").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#branddetaildata tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);				
			});		
		});


});