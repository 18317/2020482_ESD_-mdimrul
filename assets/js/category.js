$(document).ready(function () {
	"use strict";
	
	$(document).on('click', '#btnaddcategory', function () {
		validate('#tbcategoryname');
		if (!$('#categorydetailform div').hasClass('is-invalid')) {
			$('.preloader').addClass('preloaderopen');
			$.ajax({
				url: "class/categoryclass.php",
				method: 'POST',
				async: false,
				data: $('#categorydetailform').serialize() + "&addcategorydetail=1",
				success: function (response) {
					response = response.trim();
					if (response == "add") {
						notification('New Category Add Successfully.', 'text-success', 'bg-success');
						displaycategorydetail();
					} else if (response == "update") {
						notification('Category Update Successfully.', 'text-success', 'bg-success');
						displaycategorydetail();
					} else if (response == "duplicate") {
						notification('Category already exit.', 'text-danger', 'bg-danger');
					} else {
						notification('Action not perform at this time', 'text-danger', 'bg-danger');
					}
					$('#categorydetailform')[0].reset();
					$('#categorydetailmodal').modal('hide');
					$('.preloader').removeClass('preloaderopen');
				}
			});
		}
	});

$(document).on('click', '#btnaddprdmod', function () {
	$('form').trigger("reset");
	remove();
	$('#tbcategoryname').prop("disabled",false);
	$('#categorydetailmodal .modal-title').text('Add New Category');
	$('#categorydetailmodal #btnaddcategorydetail').text('Add');
	$('#categorydetailmodal #btnaddcategory').text('Add');
	$('#ddstatus').prop('selectedIndex',0);
	$('#tbaction').val('add');
	});
	

	$(document).on('click', '#categorydetaildata tbody tr .fa-edit', function () {
		$('form').trigger("reset");
		remove();
		var row = $(this).parents("tr:first");
		var title = row.children("td:eq(1)").html();
		var rowid = row.children("td:eq(0)").html();
		var rowstatus = row.children("td:eq(2)").html();
		$('#categorydetailmodal .modal-title').text('Update ' + title);
		$('#categorydetailmodal #btnaddcategory').text('Update');
		$('#tbcategoryname').val(title).prop("disabled",true);
		$('#tbaction').val('update');
		$('#tbrowid').val(rowid);
		$('#ddstatus').prop('selectedIndex',0);
		rowstatus = rowstatus.split('">').pop().split('</span>')[0];
		$("#ddstatus option").filter(function() {return $(this).text() === rowstatus;}).prop("selected", true);
	});
	
	function displaycategorydetail() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/categoryclass.php",
			method: "POST",
			async: false,
			data: {
				"categoryrecord": 1,
			},
			success: function (result) {
				$('#categorydetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}

	displaycategorydetail();

$("#tbsearch").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#categorydetaildata tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);				
			});		
		});


});