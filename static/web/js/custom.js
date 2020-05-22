/*
  Version: 1.0
  Author: BanyanTheme
  Website: https://banyanthemes.com/
*/

"use strict";

$(document).ready(function () {
	/// buscador
toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": true,
			"progressBar": false,
			"positionClass": "toast-top-center",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};

// $("#search").keyup(function () {
$("span.icon").click(function(){

if ($('#search').val().length > 4) {
	$("#form_search").submit()
}else{
	toastr["info"]("Ingrese al menos 5 caracteres: ", "Atención");
} 		



// $(this).val()
// console.log('--------');
// console.log($("#search").val());

// 		if ($('#search').val().length > 4) {

// 			var base_url = $(this).data('base_url');
// 			var dato = new FormData();
// 			dato.append('cadena', $("#search").val());

// 			$.ajax({
// 				type : "POST",
// 				contentType:false,
// 				dataType:'json',
// 				data: dato,
// 				processData:false,
// 				cache:false,
// 				beforeSend: function () {
// 					// $(".preloader").fadeIn();
// 				},
// 				url: $("body").data('base_url') + 'Home/buscador_ajax',
// 				success: function (result) {

// console.log('result');
// console.log(result);
// 				},
// 				error: function (xhr, errmsg, err) {
// 					console.log(xhr.status + ": " + xhr.responseText);
// 				}
// 			});
// 			//            $('#search').val($(this).val());
// 		}else{
// 			toastr["info"]("No hemos encontrado resultados para: " +$('#search').val(), "Atención");
		//} 
	});









	// Page preloader    	
	$("#fakeloader").fakeLoader({
		timeToHide: 1000,
		zIndex: "999999", //Default zIndex
		bgColor: "#ffffff",
		spinner: "spinner1"
	});

	// show body after site load
	$('body').show();

	/*mag popup*/
	$('.video').magnificPopup({
		type: 'iframe',


		iframe: {
			markup: '<div class="mfp-iframe-scaler">' +
				'<div class="mfp-close"></div>' +
				'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
				'<div class="mfp-title">Some caption</div>' +
				'</div>'
		},
		callbacks: {
			markupParse: function (template, values, item) {
				values.title = item.el.attr('title');
			}
		}

	});

	//counter
	$('.counter').counterUp({
		delay: 10,
		time: 5000
	});

	// Main slider
	var owl = $('.main-slider');

	// Carousel initialization
	owl.owlCarousel({
		items: 1,
		loop: true,
		margin: 0,
		autoplay: true,
		autoplayTimeout: 3000,
		animateIn: 'fadeIn',
		animateOut: 'slideOutLeft',
		autoplayHoverPause: true
	});

	// add animate.css class(es) to the elements to be animated
	function setAnimation(_elem, _InOut) {
		// Store all animationend event name in a string.
		// cf animate.css documentation
		var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

		_elem.each(function () {
			var $elem = $(this);
			var $animationType = 'animated ' + $elem.data('animation-' + _InOut);

			$elem.addClass($animationType).one(animationEndEvent, function () {
				$elem.removeClass($animationType); // remove animate.css Class at the end of the animations
			});
		});
	}

	// Fired after current slide has been changed
	owl.on('changed.owl.carousel', function (event) {

		var $currentItem = $('.item', owl).eq(event.item.index);
		var $elemsToanim = $currentItem.find("[data-animation-in]");
		setAnimation($elemsToanim, 'in');
	})


	//Testimonial Carousel
	$(".team-members").owlCarousel({

		items: 3,
		loop: true,
		margin: 10,
		autoplay: true,
		autoplayTimeout: 2000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			320: {
				items: 1,
			},
			480: {
				items: 2,
			},
			768: {
				items: 3,
			}
		}
	});

	//clients slider Carousel
	$(".clients-slider").owlCarousel({
		items: 5,
		loop: true,
		margin: 10,
		autoplay: true,
		autoplayTimeout: 2000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			320: {
				items: 1,
			},
			480: {
				items: 2,
			},
			768: {
				items: 4,
			}
		}
	});

	//Testimonial slider Carousel
	$(".testimonial-slider").owlCarousel({
		items: 1,
		loop: true,
		margin: 10,
		autoplay: true,
		autoplayTimeout: 2000,
		autoplayHoverPause: true,
	});

	//About Us slider Carousel
	$(".about-us-slider").owlCarousel({
		items: 1,
		loop: true,
		margin: 10,
		autoplay: true,
		autoplayTimeout: 2000,
		autoplayHoverPause: true,
	});

	//clients slider Carousel
	$(".portfolio-slider-2").owlCarousel({
		items: 4,
		loop: true,
		margin: 0,
		autoplay: true,
		autoplayTimeout: 2000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			320: {
				items: 1,
			},
			480: {
				items: 2,
			},
			768: {
				items: 4,
			}
		}
	});

	//Sticky menu
	$(".bussiness-main-menu-1x").sticky({
		topSpacing: 0
	});




	new WOW().init();

	// Add Bar Charts 
	//        var ctx = document.getElementById("myChart");
	//        var myChart = new Chart(ctx, {
	//            type: 'bar',
	//            data: {
	//                labels: ["2014", "2015", "2016", "2017", "2018"],
	//                datasets: [{
	//                    label: ' Yearly Statistics',
	//                    data: [1, 2, 1.5, 2, 3],
	//                    backgroundColor: [
	//                        'rgba(3, 61, 117, 1)',
	//                        'rgba(3, 61, 117, 1)',
	//                        'rgba(3, 61, 117, 1)',
	//                        'rgba(3, 61, 117, 1)',
	//                        'rgba(3, 61, 117, 1)'
	//                    ],
	//                    borderColor: [
	//                        'rgba(3, 61, 117,1)',
	//                        'rgba(3, 61, 117, 1)',
	//                        'rgba(3, 61, 117, 1)',
	//                        'rgba(3, 61, 117, 1)',
	//                        'rgba(3, 61, 117, 1)'
	//                    ],
	//                    borderWidth: 1
	//                }]
	//            },
	//            options: {
	//                scales: {
	//                    yAxes: [{
	//                        ticks: {
	//                            beginAtZero:true
	//                        }
	//                    }]
	//                }
	//            }
	//        });       







}); // End load document
