
	<footer class="business-footer-2x">
		<div class="business-footer-content-2">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="business-footer-address-left">
							<a href="<?php echo base_url()?>home"><img style="max-width:100px" src="<?php echo base_url()?>static/web/images/logos/LC_logo.png" alt="Logo"></a><br>
						</div>
					</div>
					<div class="col-md-9">
						<div class="business-footer-address-left">
							<ul>
								<li><a href="<?php echo base_url('Links')?>">Links de Interes</a></li>
								<li><a href="<?php echo base_url('Contacto')?>">Contacto</a></li>
								<li><a  href="<?= base_url('Publicaciones/1/Normativas')?>">Normativas</a></li>
								<li><a href="<?php echo base_url('Noticias')?>">Noticias</a></li>
								<li><a href="<?php echo base_url('Legislaturas')?>">Legislaturas</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-12 footer-info">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div class="footer-info-left">
										<p>&#169; <?= date('Y')?> - Legislaturas Conectadas</p>
									</div>
								</div>

								<div class="col-md-6">
									<div class="pull-right">
										<ul class="top-nav-social footernav">
											<li><a target="_blank" class="facebook" href="https://www.facebook.com/legislaturas.conectadas.arg/"> <i class="fa fa-facebook"></i> </a></li>
											<li><a target="_blank" class="twitter" href="https://twitter.com/lconectadas?lang=es"> <i class="fa fa-twitter"></i> </a></li>
											<li><a target="_blank" class="instagram" href="https://www.instagram.com/legislaturasconectadas/?hl=es-la"> <i class="fa fa-instagram"></i> </a></li>
											<li><a href="https://www.youtube.com/channel/UC5ACdrMW0Q8GubYtDoD2Gqg" class="youtube" target="_blank"> <i class="fa fa-youtube"></i> </a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</footer>




	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?ver=<?= time()?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js?ver=<?= time()?>" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?= base_url()?>static/web/js/bootstrap.min.js?ver=<?= time()?>"></script>

	<!-- Wow Script -->
	<script src="<?= base_url()?>static/web/js/wow.min.js?ver=<?= time()?>"></script>
	<!-- Counter Script -->
	<script src="<?= base_url()?>static/web/js/waypoints.min.js?ver=<?= time()?>"></script>
	<script src="<?= base_url()?>static/web/js/jquery.counterup.min.js?ver=<?= time()?>"></script>
	<!-- Masonry Portfolio Script -->
	
<!--	script para ordenar las leyes segun su categoria, si no hay no lo cargo para que no de error-->
<?php if(isset($pos)): ?>
	<script src="<?= base_url()?>static/web/js/jquery.filterizr.min.js?ver=<?= time()?>"></script>
	<script src="<?= base_url()?>static/web/js/filterizer-controls.js?ver=<?= time()?>"></script>
<?php endif;?>
	<!-- OWL Carousel js-->
	<script src="<?= base_url()?>static/web/js/owl.carousel.min.js?ver=<?= time()?>"></script>
	<!-- Lightbox js -->
	<!--	<script src="<?php //echo  base_url()?>static/web/inc/lightbox/js/jquery.fancybox.pack.js"></script>-->
	<!-- Google map js -->
	<!--
	<script  src="<?= base_url()?>sttps://maps.googleapis.com/maps/api/js?key=AIzaSyCa6w23do1qZsmF1Xo3atuFzzMYadTuTu0"></script>	
	<script src="<?= base_url()?>static/web/js/map.js"></script>
-->
	<!-- loader js-->
	<script src="<?= base_url()?>static/web/js/fakeLoader.min.js?ver=<?= time()?>"></script>
	<!-- Scroll bottom to top -->
	<script src="<?= base_url()?>static/web/js/scrolltopcontrol.js?ver=<?= time()?>"></script>
	<!-- menu -->
	<script src="<?= base_url()?>static/web/js/bootstrap-4-navbar.js?ver=<?= time()?>"></script>
	<!-- Stiky menu -->
	<script src="<?= base_url()?>static/web/js/jquery.sticky.js?ver=<?= time()?>"></script>
	<!-- youtube popup video -->
	<script src="<?= base_url()?>static/web/js/jquery.magnific-popup.min.js?ver=<?= time()?>"></script>
	<script src="<?= base_url()?>static/web/js/chart.js?ver=<?= time()?>"></script>
	
	
<!--	notificaciones-->
  <script src="<?= base_url() ?>static/manager/assets/libs/toastr/build/toastr.min.js?ver=<?= time()?>"></script>

<!--// mapa interactivo-->

	<script src="<?= base_url()?>static/manager/assets/libs/pais/jquery-jvectormap-2.0.3.min.js?ver=<?= time()?>"></script>
	<script src="<?= base_url()?>static/manager/assets/libs/pais/jquery-jvectormap-ar-mill.js?ver=<?= time()?>"></script>
<!--	<script src="<?= base_url()?>static/manager/assets/libs/pais/sudamerica1.js?ver=<?= time()?>"></script>-->


	<script src="<?= base_url()?>static/web/js/custom.js?ver=<?= time()?>"></script>


  <div id="world-map" style="width: 600px; height: 400px"></div>
  <script>
		jQuery.fn.vectorMap('addMap', 'sudamerica_mills', {
	"insets": [{
		"width": 400,
		"top": 0,
		"height": 905.8723093907364,
		"bbox": [{
			"y": -1391900.644539083,
			"x": -12188330.527048683
		}, {
			"y": 6974170.643481547,
			"x": -3876492.223609794
		}],
		"left": 0
	}],
	"paths": {
		"PY": {
					"CO": {
			"path": "M382.29,58.03l1.56,1.88l0.98,-0.25l2.33,-1.73l0.19,-1.72l1.79,-1.65l-1.04,-2.95l-0.78,-1.05l-0.8,-1.99l-0.67,-0.67l0.8,-1.35l0.99,1.69l1.67,1.23l1.6,1.76l0.66,1.21l0.85,0.55l-0.61,0.55l-0.15,0.73l0.42,0.74l0.73,0.4l1.24,-0.35l0.59,-1.11l-0.36,-3.74l-0.58,-1.95l-1.11,-1.22l2.52,-1.13l4.97,-3.58l1.8,-3.44l1.22,-1.13l1.32,-0.71l1.84,0.16l1.66,-0.66l0.45,-1.32l-0.86,-2.26l0.99,-3.06l-0.02,-1.6l0.61,-0.86l-0.23,-0.83l-0.47,-0.08l0.57,-0.7l0.72,-2.4l0.5,-0.9l1.92,-1.37l0.46,-0.73l3.88,-3.31l0.74,-0.51l4.13,1.29l-0.32,0.28l-0.23,1.24l0.86,1.06l1.13,0.18l0.71,-0.74l1.56,-3.51l0.25,-1.96l0.51,-0.5l0.81,-0.19l3.06,0.77l1.53,0.07l4.63,-0.37l7.08,-5.05l3.26,-1.08l2.13,-1.09l1.48,-2.23l0.37,-1.53l0.73,-0.46l1.16,-0.09l0.7,-0.9l2.26,-1.24l2.45,-0.14l2.61,1.11l1.18,1.92l0.17,1.15l-2.04,2.08l-0.88,0.44l-6.86,2.03l-3.47,5.68l-2.36,1.01l-2.99,3.45l-2.24,4.36l-1.65,8.53l-4.17,6.75l-0.05,0.91l0.7,0.41l1.73,-0.32l1.57,-0.75l1.08,1.47l1.73,0.21l1.53,5.67l3.03,3.09l0.28,1.03l0.37,2.2l-1.05,1.57l-0.28,5.55l0.35,0.84l0.7,0.64l2.22,0.57l1.42,3.15l1.16,0.98l1.59,0.53l3.22,-0.51l5.94,0.56l1.52,-0.12l3.19,-1.13l0.89,0.08l3.23,1.33l3.11,0.24l8.1,9.77l0.58,0.26l0.74,-0.25l1.13,0.56l1.03,-0.25l1.18,-0.78l1.68,-0.15l2.44,0.5l3.24,-0.0l4.0,-0.5l2.46,-0.54l0.98,-0.57l3.23,0.55l0.85,0.61l0.46,1.64l-0.34,0.94l-1.24,1.23l-0.71,1.63l-0.13,1.75l-0.56,1.19l-1.19,1.0l-0.44,1.27l0.23,1.82l-0.61,7.54l0.53,0.81l0.35,2.99l1.52,4.17l0.71,1.15l1.29,1.0l2.13,3.14l-0.36,0.75l-5.79,5.18l-0.45,0.76l0.03,0.74l0.56,0.35l0.98,-0.42l1.57,0.43l0.66,1.25l4.09,3.45l-0.07,1.32l1.17,2.57l-0.12,0.84l1.66,3.72l0.07,0.9l1.15,2.95l0.01,1.28l-1.7,0.4l0.02,-4.85l-0.37,-1.18l-2.84,-4.69l-0.9,-0.57l-0.84,-0.04l-1.3,0.64l-3.15,3.42l-1.23,0.42l-0.83,-0.34l-1.13,-1.95l-0.94,-0.54l-0.78,0.46l-0.53,1.5l0.58,1.21l-13.01,0.01l-2.73,-0.63l-3.63,0.78l-0.43,0.4l-0.04,7.83l0.53,0.38l0.58,-0.2l4.28,0.47l1.36,-0.17l0.52,0.34l1.04,1.68l0.07,2.24l-1.95,-0.23l-1.53,-0.92l-4.05,1.48l-2.91,0.34l-0.36,0.39l-0.16,8.83l0.4,0.81l1.46,1.46l3.45,2.29l0.41,1.31l-0.22,1.57l0.91,2.04l1.07,0.93l-0.03,0.91l0.57,1.24l-6.52,35.85l-2.02,-1.67l-0.8,-1.87l-1.34,-1.01l-2.43,0.56l-1.95,-0.86l7.71,-12.05l0.15,-0.77l-0.67,-0.91l-1.66,-0.57l-2.19,-1.44l-2.71,-1.02l-0.69,-0.74l-3.29,-1.68l-1.92,0.47l-1.09,0.84l-2.1,0.23l-1.96,-1.3l-2.57,-0.87l-0.78,0.26l-2.04,1.82l-0.94,0.05l-1.83,0.85l-2.05,0.32l-2.9,-0.91l-1.1,0.49l-2.39,0.05l-0.67,-0.68l-1.79,-0.66l-0.14,-0.55l0.53,-1.63l-0.9,-3.15l-0.53,-0.68l-1.58,-0.08l-1.53,-0.94l-0.23,-0.43l0.32,-1.31l-0.33,-1.05l-1.79,-2.55l-1.0,-0.53l-1.48,-0.19l-2.25,-1.97l-2.36,-0.75l-0.88,-1.2l-1.1,-3.4l-2.43,-2.59l-1.65,-0.86l-0.51,-1.08l-1.95,-0.35l-2.39,-1.67l-1.12,-0.11l-0.83,0.71l-1.87,-0.71l-1.81,-1.2l-2.0,-0.37l-1.13,-0.68l-2.27,-2.35l-2.6,-1.21l-0.77,-0.07l-1.02,0.6l-0.42,0.57l-0.11,1.15l-0.53,0.2l-2.73,-0.44l-0.54,0.36l-0.64,-0.06l-3.31,-1.25l-2.26,-0.1l-1.1,-0.36l-0.8,-2.85l-2.15,-1.04l-0.63,-1.31l-1.83,-0.07l-2.4,-0.85l-3.25,-1.74l-2.39,-1.83l-2.03,-1.02l-2.09,-2.02l-0.43,-0.89l-1.37,-1.0l0.6,-1.14l1.73,-1.01l2.43,0.84l0.53,-0.31l0.32,-1.81l-0.93,-1.77l0.38,-3.3l0.62,-0.73l1.16,-0.61l0.77,0.24l0.83,-0.56l1.92,0.24l0.84,-0.28l1.77,-1.55l0.54,-1.01l0.53,0.08l0.45,-0.32l1.74,-2.05l-0.35,-1.59l1.65,-0.61l1.61,-3.0l0.86,-0.36l0.37,-1.45l2.97,-5.29l-0.41,-0.58l-1.18,0.59l-0.58,-0.19l0.15,-1.51l-0.55,-0.6l-0.53,0.11l-0.61,0.87l-0.47,-0.79l0.23,-2.17l-0.57,-0.33l1.22,-1.33l0.81,-4.16l-0.63,-1.42l-0.41,-5.85l-0.46,-1.29l-1.22,-1.12l2.21,-1.49l0.95,-1.66l-1.15,-2.6l-1.47,-2.16l-0.02,-0.62l0.88,-0.37l0.46,-2.78l-0.16,-1.13l-0.85,-1.39l-1.15,-0.22l-3.27,-5.22l-1.04,-1.0l0.75,-2.21l0.65,-0.42l0.41,-0.84l-0.26,-1.77ZM377.29,119.74l-0.18,-0.14l-0.03,-0.35l0.19,0.19l0.03,0.3Z",
			"name": "Colombia"
		},
			"path": "M617.96,397.13l0.51,1.91l1.38,1.97l0.3,2.45l1.0,1.01l-0.05,1.74l0.83,1.52l0.04,1.56l-0.79,2.14l0.2,0.71l-0.84,1.85l0.34,2.51l-0.39,1.88l0.17,0.76l-0.61,1.7l0.39,1.02l1.95,0.65l1.21,-0.52l1.83,1.03l2.79,0.41l1.23,-0.23l3.66,0.95l3.93,-0.58l1.27,-1.62l0.68,-0.25l2.31,2.35l4.74,0.56l0.93,1.05l0.07,1.18l0.56,1.17l0.98,0.9l-0.38,2.67l0.61,2.74l0.48,0.79l0.07,1.93l0.43,1.23l-0.23,2.16l0.98,1.51l0.19,2.21l0.44,1.29l0.79,0.59l2.22,0.34l2.64,-0.58l4.14,-2.0l1.99,1.02l1.98,1.6l-0.65,0.98l0.44,2.31l-0.37,2.72l-1.7,6.89l0.19,0.79l-2.08,4.0l-0.26,7.36l-0.54,3.86l-0.91,2.83l-0.75,1.36l-1.31,0.69l-0.41,0.81l-1.98,1.6l-0.15,0.58l-3.31,0.93l-0.92,1.42l-0.93,0.58l-0.44,0.95l0.04,0.94l-1.19,1.34l-0.63,0.01l-2.02,-1.17l-1.4,-0.23l-1.29,0.18l-1.17,0.72l-1.52,2.14l-0.42,0.11l-0.91,-0.8l-1.12,-0.26l-1.47,0.32l-0.9,-0.1l-0.93,-0.59l-1.23,-0.06l-1.71,0.44l-3.26,-0.5l-5.11,-1.49l-4.29,-0.56l-5.03,0.5l-0.32,-1.1l0.2,-0.59l0.84,-0.63l1.26,-2.01l1.43,-0.89l0.0,-0.67l0.66,-0.53l0.44,-1.29l0.59,-0.7l-0.14,-3.19l1.09,-2.51l2.55,-2.09l1.75,-4.11l2.13,-2.02l0.17,-1.15l-1.03,-1.97l-2.17,-2.5l-1.74,-1.19l-2.27,-0.98l-1.4,-0.3l-0.78,0.28l-0.42,-0.16l-0.74,-0.85l-1.17,-0.66l-2.51,-0.75l-5.54,-2.85l-8.55,-6.02l-2.63,-1.08l-1.95,0.03l-2.86,-0.63l-3.98,-1.33l-2.19,-1.23l-0.67,-1.28l-1.49,-1.27l-2.41,-1.31l-1.98,-1.74l-2.72,-1.73l-1.52,-1.52l-1.64,-2.37l-1.82,-3.31l-1.91,-2.2l-2.96,-1.82l-0.24,-0.59l4.43,-14.56l0.02,-6.33l4.27,-6.28l1.89,-5.0l20.85,-4.31l10.9,-0.14l10.79,6.54l0.38,1.99l-0.23,2.03Z",
			"name": "Paraguay"
		},},

	"height": 905.8723093907364,
	"projection": {
		"type": "mill",
		"centralMeridian": 0.0
	},
	"width": 900.0
});
		$(document).ready(function () {
			
		
			var mimapa = new jvm.Map({
		container: $('#world-map'),

//		markers: markers.map(function (h) {
//				console.log('h.name');
//				console.log(h.name);
//			return {
//				name: h.name,
//				latLng: h.coords
//			}
//		}),
//		labels: {
//			markers: {
//				render: function (index) {
//					// return markers[index].name;
//				},
//				offsets: function (index) {
//					var offset = markers[index]['offsets'] || [0, 0];
//
//					return [offset[0] - 7, offset[1] + 3];
//				}
//			}
//		},
//		markers: markers,
		onMarkerClick: function (events, index, weburl, code) {
			console.log(markers[index].weburl);
			console.log(markers[index].code);

			redirigir_url_mapa(markers[index].code)

		},
//		"paths": {
//		"PY": {
//			"path": "M617.96,397.13l0.51,1.91l1.38,1.97l0.3,2.45l1.0,1.01l-0.05,1.74l0.83,1.52l0.04,1.56l-0.79,2.14l0.2,0.71l-0.84,1.85l0.34,2.51l-0.39,1.88l0.17,0.76l-0.61,1.7l0.39,1.02l1.95,0.65l1.21,-0.52l1.83,1.03l2.79,0.41l1.23,-0.23l3.66,0.95l3.93,-0.58l1.27,-1.62l0.68,-0.25l2.31,2.35l4.74,0.56l0.93,1.05l0.07,1.18l0.56,1.17l0.98,0.9l-0.38,2.67l0.61,2.74l0.48,0.79l0.07,1.93l0.43,1.23l-0.23,2.16l0.98,1.51l0.19,2.21l0.44,1.29l0.79,0.59l2.22,0.34l2.64,-0.58l4.14,-2.0l1.99,1.02l1.98,1.6l-0.65,0.98l0.44,2.31l-0.37,2.72l-1.7,6.89l0.19,0.79l-2.08,4.0l-0.26,7.36l-0.54,3.86l-0.91,2.83l-0.75,1.36l-1.31,0.69l-0.41,0.81l-1.98,1.6l-0.15,0.58l-3.31,0.93l-0.92,1.42l-0.93,0.58l-0.44,0.95l0.04,0.94l-1.19,1.34l-0.63,0.01l-2.02,-1.17l-1.4,-0.23l-1.29,0.18l-1.17,0.72l-1.52,2.14l-0.42,0.11l-0.91,-0.8l-1.12,-0.26l-1.47,0.32l-0.9,-0.1l-0.93,-0.59l-1.23,-0.06l-1.71,0.44l-3.26,-0.5l-5.11,-1.49l-4.29,-0.56l-5.03,0.5l-0.32,-1.1l0.2,-0.59l0.84,-0.63l1.26,-2.01l1.43,-0.89l0.0,-0.67l0.66,-0.53l0.44,-1.29l0.59,-0.7l-0.14,-3.19l1.09,-2.51l2.55,-2.09l1.75,-4.11l2.13,-2.02l0.17,-1.15l-1.03,-1.97l-2.17,-2.5l-1.74,-1.19l-2.27,-0.98l-1.4,-0.3l-0.78,0.28l-0.42,-0.16l-0.74,-0.85l-1.17,-0.66l-2.51,-0.75l-5.54,-2.85l-8.55,-6.02l-2.63,-1.08l-1.95,0.03l-2.86,-0.63l-3.98,-1.33l-2.19,-1.23l-0.67,-1.28l-1.49,-1.27l-2.41,-1.31l-1.98,-1.74l-2.72,-1.73l-1.52,-1.52l-1.64,-2.37l-1.82,-3.31l-1.91,-2.2l-2.96,-1.82l-0.24,-0.59l4.43,-14.56l0.02,-6.33l4.27,-6.28l1.89,-5.0l20.85,-4.31l10.9,-0.14l10.79,6.54l0.38,1.99l-0.23,2.03Z",
//			"name": "Paraguay"
//		}},
		regionLabelStyle: {
			initial: {
				'font-family': 'Verdana',
				'font-size': '12',
				'font-weight': 'bold',
				cursor: 'default',

			},
			hover: {
				cursor: 'default'
			}
		},
		regionStyle: {
			initial: {
				fill: '#128da7',
				stroke: "#250E62",
				"stroke-width": 1.5,
			},
			hover: {
				fill: "#A0D1DC"
			}

		},
		zoomOnScroll: false,
		map: 'sudamerica_mill',
		zoomButtons: false,
		backgroundColor: 'none',
		series: {
			regions: [{
				attribute: 'fill'
						}],
			markers: [{
				attribute: 'image',
				scale: {
					'caba': 'static/web/images/mapa_caba.png',
					'malvinas': 'static/web/images/malvinas.png'
				},
				values: markers.reduce(function (p, c, i) {
					p[i] = c.status;
					return p
				}, {}),
          }]
		},
		onRegionOver: function (event, index) {
										console.log(event);
										console.log(index);
			//		
			//					var dato = new FormData();
			//					dato.append('code', code);
			//
			//					$.ajax({
			//						type: "POST",
			//						contentType: false,
			//						//						dataType: 'json',
			//						data: dato,
			//						processData: false,
			//						cache: false,
			//						beforeSend: function () {
			//							$(".preloader").fadeIn();
			//						},
			//						url: $("body").data('base_url') + "Manager/Contenidos/jvectormapa",
			//						success: function (result) {
			//							console.log('result');
			////							console.log(result);
			//
			//							// ac ael resultado de la busqueda de la provincia
			//							//$("#legis_tab").html(result);
			//							if (result.estado == true) {} else {}
			//
			//
			//						},
			//						error: function (xhr, errmsg, err) {
			//							console.log(xhr.status + ": " + xhr.responseText);
			//						}
			//					});
		},
		hover: {
			"fill-opacity": 1
		},
		selected: {
			fill: 'yellow'
		},
		onRegionClick: function (event, code) {
			redirigir_url_mapa(code)

		},
	});
	});
		
    $(function(){
			
			
			var markers = [
        {latLng: [-38,-63], name: 'Argentina'},
       
      ];
      $('#world-mapa').vectorMap(
				{		
					markers: markers,
					regionStyle: {
			initial: {
				fill: '#128da7',
				stroke: "#250E62",
				"stroke-width": 1.5,
			},
			hover: {
				fill: "#A0D1DC"
			}

		},
					map: 'sudamerica_mill',
				 	zoomOnScroll: false,
					zoomButtons: false,
					backgroundColor: 'none',
				}
			 );
    });
  </script>


<script>
	
	 var url = window.location.pathname; 

		var activePage = url.substring(url.lastIndexOf('/')+1);
		var activePage2 = url.substring(url.lastIndexOf('/'));
	
	var res = url.split("/");
//		console.log('activePage');
//		console.log(res);
		console.log(res[1]);
	
	
		var reg_noticias=/^[0-9]*$/; 
		var reg_legislaturas=/[a-zA-Z]+(-[a-zA-Z]+){6,}$/; 
	
		$('nav li').removeClass('active');
	
		$('nav li a').each(function(){  

			var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);

			if (reg_noticias.test(activePage)) { 

			//	$('nav li a:contains("Noticias")').parent().addClass('active'); 
			}else if(reg_legislaturas.test(activePage)){

				$('nav li a:contains("Legislaturas")').parent().addClass('active'); 
			}else if(activePage == currentPage){			

						$(this).parent().addClass('active'); 
			}
			if(res[1] == 'Noticias'){
					$('nav li a:contains("Noticias")').parent().addClass('active');
			}
			if(res[1] == 'Legislatura'){
					$('nav li a:contains("Legislaturas")').parent().addClass('active');
			}
			
			if(res[1] == 'Publicacion'){
					$('nav li a:contains("Normativas")').parent().addClass('active');
			}			
			
			if(res[1] == ''){
					$('nav li a:contains("Inicio")').parent().addClass('active');
			}
			
	});
	
	
<?php if(isset($pos)): ?>
	
<?php endif;?>
</script> 
    
    <?php
			if(is_array ($script )){
				
				foreach($script as $data){
				
					echo '<script src="'.$data.'"></script>';
				}

			}else{
   
				echo '<script src="'.$script.'"></script>';
   
				
			}
			
			?>

	</body>

	</html>
	