$(document).ready(function(){

	
	var owl = $(".owl-carousel");
 
  owl.owlCarousel({
		center:false,
		items:4,
		nav:true,
		dots:false,
		loop:( $('.owl-carousel .items').length > 4 ),
		navElement:'i',
		navText: [$('.am-next'),$('.am-prev')],
	//	navText: ['	<button class="am-next btn btn-outline-secondary">Siguiente</button>','	<button class="am-next btn btn-outline-secondary">Siguiente</button>'],
		autoplay:true,

		margin:15,
		mouseDrag: true,
			singleItem: true,

		responsiveClass:true,
			responsive:{
			0:{
				items:1,
				nav:true
				},
			600:{
				items:4,
				nav:true
				},
			1000:{
				items:4,
				nav:true,
				}
			},
		
	});

})	

