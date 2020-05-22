$(function () {
	"use strict";

	$(".preloader").fadeOut();







	// ============================================================== 
	// Theme options
	// ==============================================================     
	// ============================================================== 
	// sidebar-hover
	// ==============================================================

	$(".left-sidebar").hover(
		function () {
			$(".navbar-header").addClass("expand-logo");
		},
		function () {
			$(".navbar-header").removeClass("expand-logo");
		}
	);
	// this is for close icon when navigation open in mobile view
	$(".nav-toggler").on('click', function () {
		$("#main-wrapper").toggleClass("show-sidebar");
		$(".nav-toggler i").toggleClass("ti-menu");
	});
	$(".nav-lock").on('click', function () {
		$("body").toggleClass("lock-nav");
		$(".nav-lock i").toggleClass("mdi-toggle-switch-off");
		$("body, .page-wrapper").trigger("resize");
	});
	$(".search-box a, .search-box .app-search .srh-btn").on('click', function () {
		$(".app-search").toggle(200);
		$(".app-search input").focus();
	});

	// ============================================================== 
	// Right sidebar options
	// ==============================================================
	$(function () {
		$(".service-panel-toggle").on('click', function () {
			$(".customizer").toggleClass('show-service-panel');

		});
		$('.page-wrapper').on('click', function () {
			$(".customizer").removeClass('show-service-panel');
		});
	});
	// ============================================================== 
	// This is for the floating labels
	// ============================================================== 
	$('.floating-labels .form-control').on('focus blur', function (e) {
		$(this).parents('.form-group').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
	}).trigger('blur');

	// ============================================================== 
	//tooltip
	// ============================================================== 
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
	// ============================================================== 
	//Popover
	// ============================================================== 
	$(function () {
		$('[data-toggle="popover"]').popover()
	})

	// ============================================================== 
	// Perfact scrollbar
	// ============================================================== 
	$('.message-center, .customizer-body, .scrollable').perfectScrollbar({
		wheelPropagation: !0
	});

	/*var ps = new PerfectScrollbar('.message-body');
	var ps = new PerfectScrollbar('.notifications');
	var ps = new PerfectScrollbar('.scroll-sidebar');
	var ps = new PerfectScrollbar('.customizer-body');*/

	// ============================================================== 
	// Resize all elements
	// ============================================================== 
	$("body, .page-wrapper").trigger("resize");
	$(".page-wrapper").show();
	// ============================================================== 
	// To do list
	// ============================================================== 
	$(".list-task li label").click(function () {
		$(this).toggleClass("task-done");
	});

	//****************************
	/* This is for the mini-sidebar if width is less then 1170*/
	//**************************** 
	var setsidebartype = function () {
		var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
		if (width < 1170) {
			$("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
		} else {
			$("#main-wrapper").attr("data-sidebartype", "full");
		}
	};
	$(window).ready(setsidebartype);
	$(window).on("resize", setsidebartype);
	//****************************
	/* This is for sidebartoggler*/
	//****************************
	$('.sidebartoggler').on("click", function () {
		$("#main-wrapper").toggleClass("mini-sidebar");
		if ($("#main-wrapper").hasClass("mini-sidebar")) {
			$(".sidebartoggler").prop("checked", !0);
			$("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
		} else {
			$(".sidebartoggler").prop("checked", !1);
			$("#main-wrapper").attr("data-sidebartype", "full");
		}
	});
});

function buscar_video(url) {

	if (url == '') {
		toastr.error('Ingrese una url de Video válida ', 'Videos');
		return false;
	}

	var IdVideo = getParameterByName('v', url);
	if (IdVideo == '') {
		toastr.error('La url no posee el parámetro correcto ', 'Videos');
		return false;
	}
	var youTubeURL = 'https://www.googleapis.com/youtube/v3/videos?id=' + IdVideo + '&part=snippet&key=AIzaSyCXDz8DxWsZEJwZffnXSTOZviYIi7k2vDE'; //&key=<YOUR_API_KEY>&
	//jqueryGritter(youTubeURL,'','info','');
	$.ajax({
		'async': false,
		'global': false,
		'url': youTubeURL,
		'dataType': "jsonp",
		'success': function (data) {
			console.log(data);
			//jqueryGritter(data.items[0].snippet.title,'Titulo Cargado','info','');
			$('#titulo_video').val(data.items[0].snippet.title);
			$('#detalle_video').val(data.items[0].snippet.description);
			$('#video_post').html('<img class="img-responsive" src="' + data.items[0].snippet.thumbnails.high.url + '"/>');
		}
	});
}


function getParameterByName(name, url) {
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	var regexS = "[\\?&]" + name + "=([^&#]*)";
	var regex = new RegExp(regexS);
	var results = regex.exec(url);
	if (results == null)
		return "";
	else
		return decodeURIComponent(results[1].replace(/\+/g, " "));
}
