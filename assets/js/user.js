$(document).ready(function () {
	"use strict";
	
	$(document).on('click', '#btnadduser', function () {
		validate('#tbfullname');
		validate('#tbusername');
		validate('#tbpassword');
		validate('#ddusertype');
		if (!$('#userdetailform div').hasClass('is-invalid')) {
			$('.preloader').addClass('preloaderopen');
			$.ajax({
				url: "class/userclass.php",
				method: 'POST',
				async: false,
				data: $('#userdetailform').serialize() + "&adduser=1",
				success: function (response) {
					response = response.trim();
					if (response == "add") {
						notification('New User Add Successfully.', 'text-success', 'bg-success');
					} else if (response == "update") {
						notification('User Update Successfully.', 'text-success', 'bg-success');
					} else if (response == "Duplicate") {
						notification('User already exit.', 'text-danger', 'bg-danger');
					} else {
						notification('Action not perform at this time', 'text-danger', 'bg-danger');
					}
					$('#userdetailform')[0].reset();
					$('#userdetailmodal').modal('hide');
					$('.preloader').removeClass('preloaderopen');
					displayuserdetail();
				}
			});
		}
	});

$(document).on('click', '#btnadd', function () {
	$('form').trigger("reset");
	remove();
	$('.modal-title').text('Add New User');
	$('#btnadduser').text('Add');
	$('#tbaction').val('add');
	});
	

	$(document).on('click', '#userdetaildata tbody tr .fa-edit', function () {
		$('form').trigger("reset");
		remove();
		var row = $(this).parents("tr:first");
		var rowid = row.children("td:eq(0)").html();
		var name = row.children("td:eq(1)").html();
		var username = row.children("td:eq(2)").html();
		var password = row.children("td:eq(3)").html();
		var usertype = row.children("td:eq(4)").html();
		var rowstatus = row.children("td:eq(5)").html();		
		$('.modal-title').text('Update User');
		$('#btnadduser').text('Update');
		$('#tbusername').val(username).prop("disabled",true);
		$('#tbfullname').val(name);
		$('#tbpassword').val(password);
		$('#tbaction').val('update');
		$('#tbrowid').val(rowid);
		$('#ddstatus, #ddusertype').prop('selectedIndex',0);		
		$("#ddusertype option").filter(function() {return $(this).text() === usertype;}).prop("selected", true);		
		rowstatus = rowstatus.split('">').pop().split('</span>')[0];
		$("#ddstatus option").filter(function() {return $(this).text() === rowstatus;}).prop("selected", true);
	});
	
	function displayuserdetail() {
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/userclass.php",
			method: "POST",
			async: false,
			data: {
				"userrecord": 1,
			},
			success: function (result) {
				$('#userdetaildata').html(result);
			}
		});
		$('.preloader').removeClass('preloaderopen');
	}

	displayuserdetail();

$("#tbsearch").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#userdetaildata tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);				
			});		
		});
	
	
	$(document).on("click", "#userdetaildata tbody tr .fa-trash", function () {
		$('form').trigger("reset");
		var row = $(this).parents("tr:first");
		var id = row.children("td:eq(0)").html();
		var name = row.children("td:eq(1)").html();
		$('#modaltext').text(name);
		$('#deleteid').val(id);
	});

	$(document).on('click', '#btnmodaldelete', function () {
		var deleteid = $('#deleteid').val();
		$('.preloader').addClass('preloaderopen');
		$.ajax({
			url: "class/userclass.php",
			method: 'POST',
			async: false,
			data: {
				"delete": 1,
				"deleteid": deleteid
			},
			success: function (response) {
				response = response.trim();
				if (response == "delete") {
					notification('User Delete Successfully.', 'text-success', 'bg-success');
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
	
	
	
	//setting
	
	
	$(document).on('click', '#btnsettingupdate', function () {
		validate('#tbfullname');
		if (!$('#settingform div').hasClass('is-invalid')) {
			$('.preloader').addClass('preloaderopen');
			$.ajax({
				url: "class/userclass.php",
				method: 'POST',
				async: false,
				data: $('#settingform').serialize() + "&updatesetting=1",
				success: function (response) {
					response = response.trim();
					if (response == "update") {
						location.reload();
						notification('Setting update Successfully', 'text-success', 'bg-success');
					} else{
						notification('Action not performed at this time', 'text-danger', 'bg-danger');
					}
					$('#settingform')[0].reset();					
				}
			});
		}
		$('.preloader').removeClass('preloaderopen');
	});
});
