//$(function() {
  //  "use strict";
    $(function() {
            $(".preloader").fadeOut();
		//$('body').css({overflowY:'auto'});
        }),

        jQuery(document).on("click", ".mega-dropdown", function(i) {
            i.stopPropagation();
        });


$(document).ready(function () {
        var url = window.location;
        var element = $('#menubar ul a').filter(function () {
            return this.href == url || url.href.indexOf(this.href) == 0;
        });
        $(element).parentsUntil('#menubar ul', 'li').addClass('menuactive');	
    });

$(function () {
    setsidebarNavigation();
});

function setsidebarNavigation() {
	var currurl = window.location.pathname;
var index = currurl.lastIndexOf("/") + 1;
var filename = currurl.substr(index);
    $(".pagesidebar a").each(function () {
        var href = $(this).attr('href');
        if (filename.substring(0, href.length) === href) {
            $(this).closest('a').addClass('active');
        }		
		if(filename == "category.php" || filename == "brand.php" || filename == "products.php" || filename == "stock.php" || filename == "pricelist.php")
		   {
			   $('#menubar #inventorymenu').addClass('menuactive');
		   $('#inventorysidebar').removeClass('d-none');
			   $('#settingsidebar').addClass('d-none');
			   $('#reportsidebar').addClass('d-none');
		   }
		else if(filename == "setting.php" || filename == "userdetail.php")
		   {
			   $('#menubar #settingmenu').addClass('menuactive');
		   $('#inventorysidebar').addClass('d-none');
		   $('#settingsidebar').removeClass('d-none');
			   $('#reportsidebar').addClass('d-none');
		   }
		else if(filename == "stockreport.php" || filename == "invoicereport.php")
		   {
			   $('#menubar #reportmenu').addClass('menuactive');
		   $('#inventorysidebar').addClass('d-none');
		   $('#settingsidebar').addClass('d-none');
		   $('#reportsidebar').removeClass('d-none');
		   }
		
		
		   
    });
}



    var i = function() {
        (window.innerWidth > 0 ? window.innerWidth : this.screen.width) < 1170 ? ($("body").addClass("mini-sidebar"),
            $(".navbar-brand span").hide(), $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible"),
            $(".sidebartoggler i").addClass("ti-menu")) : ($("body").removeClass("mini-sidebar"),
            $(".navbar-brand span").show());
        var i = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 1;
        (i -= 70) < 1 && (i = 1), i > 70 && $(".page-wrapper").css("min-height", i + "px");
    };


    $(window).ready(i), $(window).on("resize", i), $(".sidebartoggler").on("click", function() {
            $("body").hasClass("mini-sidebar") ? ($("body").trigger("resize"), $(".scroll-sidebar, .slimScrollDiv").css("overflow", "hidden").parent().css("overflow", "visible"),
                $("body").removeClass("mini-sidebar"), $(".navbar-brand span").show()) : ($("body").trigger("resize"),
                $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible"),
                $("body").addClass("mini-sidebar"), $(".navbar-brand span").hide());
        }),


        $(function() {
            $("#sidebarnav").metisMenu();
        }),

        $(".scroll-sidebar").slimScroll({
            position: "left",
            size: "5px",
            height: "100%",
            color: "#dcdcdc"
        });

/*email*/
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

function emailcheck(eid) {
	if ($(eid).val() != "") {
		if (!filter.test($(eid).val())) {
			if ($(eid).closest(".form-group").find('.invalid-feedback').length == 0) {
				$(eid).closest(".form-group").append("<span class='invalid-feedback animated fadeInDown'> Please Enter Email in Correct Format.</span>");
			}
			$(eid).closest(".form-group").addClass("is-invalid");
			return false;
		} else {
			$(eid).closest(".form-group").removeClass("is-invalid");
			$(eid).closest(".form-group").find(".invalid-feedback").remove();
		}
	}
}

function remove() {
		$('form div').removeClass("is-invalid");
		$('form').closest("div").find(".invalid-feedback").remove();
	}


$(document).on('blur', '.emailcheck', function () {
	emailcheck('.emailcheck');

});

function notification(message, classadd, bg) {
	$('#notificationmodal').modal('show');
	$('#notifymessage, #progressbar').removeClass();
	$('#notifymessage').text(message).addClass(classadd);
	$('#progressbar').addClass(bg);
	move();
	var count = 2;
	var counter = setInterval(timer, 800); //1000 will  run it every 1 second
	function timer() {
		count = count - 1;
		if (count < 0) {
			clearInterval(counter);
			return;
		}

		if (count == 0) {
			$('#notificationmodal').modal('hide');
		}
	}
	$("html, body").animate({
		scrollTop: 0
	}, "slow");
}

function move() {
	var elem = document.getElementById("progressbar");
	var width = 1;
	var id = setInterval(frame, 15);

	function frame() {
		if (width >= 100) {
			clearInterval(id);

		} else {
			width++;
			elem.style.width = width + '%';
		}
	}
}

function validateselect(textboxid) {
	if ($(textboxid).val() == "" || $(textboxid).val() == null) {
		alert('empty');
	}
	else
		{
			alert($(this).val());
		}
	return false;
}

function validate(textboxid) {
		if ($(textboxid).val() == "" || $(textboxid).val() == null) {
			if ($(textboxid).closest(".form-group").find('.invalid-feedback').length == 0) {
				$(textboxid).closest(".form-group").append("<span class='invalid-feedback animated fadeInDown'>Required Field</span>");
			}
			$(textboxid).closest(".form-group").addClass("is-invalid");
			$(textboxid).focus();
			return false;
		} else {
			$(textboxid).closest(".form-group").removeClass("is-invalid");
			$(textboxid).closest("div").find(".invalid-feedback").remove();
		}
	}

function validatemessage(textboxid, message) {
	if ($(textboxid).val() == "" || $(textboxid).val() == null) {
		if ($(textboxid).closest("div").find('.invalid-feedback').length == 0) {
			$(textboxid).closest("div").append("<span class='invalid-feedback animated fadeInDown'>"+message+"</span>");
		}
		$(textboxid).closest(".div").addClass("is-invalid");
		//$(textboxid).focus();
		return false;
	} else {
		$(textboxid).closest("div").removeClass("is-invalid");
		$(textboxid).closest("div").find(".invalid-feedback").remove();
	}
}

function validatetextbox(textboxid, message) {
		if ($(textboxid).closest("div").find('.invalid-feedback').length == 0) {
			$(textboxid).closest("div").append("<span class='invalid-feedback animated fadeInDown'>"+message+"</span>");
		}
		$(textboxid).closest("div").addClass("is-invalid");
		//$(textboxid).focus();
		return false;
	}

var specialKeys = new Array();
	specialKeys.push(8); //Backspace
	
$(document).on('keypress', '.numeric ', function (e) {
			var keyCode = e.which ? e.which : e.keyCode;
			var ret = ((keyCode >= 48 && keyCode <= 57) || keyCode == 45 || keyCode == 46 || specialKeys.indexOf(keyCode) != -1);
			return ret;
		});
		

$('.uppercase').keyup(function(){
    this.value = this.value.toUpperCase();
});

$('.modal').on('shown.bs.modal', function (e) {
		$(".modal .modal-body").scrollTop(0);
});


