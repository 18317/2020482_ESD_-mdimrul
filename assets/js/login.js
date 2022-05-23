$(function () {
	"use strict";
//for login credetnails
	$(document).on('click', '#btnsignin', function () {
		validate('#signinusername');
		validate('#signinpassword');
		if (!$('#loginform div').hasClass('is-invalid')) {
			$('.preloader').addClass('serverwait');
		$.ajax({
			url: "class/loginclass.php",
			method: 'POST',
			async: false,
			data: $('#loginform').serialize() + "&login=1",
			success: function (response) {
				response = response.trim();
				if (response == "login") {
					window.location='dashboard.php';
				}
				else if (response == "incorrect") {
					notification('UserName/Password Incorrect', 'text-danger', 'bg-danger');
					$('#loginform')[0].reset();
				} else if (response == "error") {
					notification('Action not perform at this time', 'text-danger', 'bg-danger');
				}
			}
		});
			$('.preloader').removeClass('serverwait');
			}
	});

});