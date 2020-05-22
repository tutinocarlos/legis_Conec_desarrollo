
	<footer class="business-footer-2x">
		<div class="business-footer-content-2">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="business-footer-address-left">
							<a href="<?php echo base_url()?>home"><img style="max-width:100px" src="<?php echo base_url()?>static/web/images/logos/logo1.png" alt="Logo"></a><br>
						</div>
					</div>
					<div class="col-md-9">
						<div class="business-footer-address-left">
							<ul>
								<li><a href="<?php echo base_url('Contacto')?>">Contacto</a></li>

								<li>
									<a  href="<?= base_url('Publicaciones/1/Normativas')?>">Normativas</a>
								</li>
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


	<!-- End Footer -->



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


	<script src="<?= base_url()?>static/web/js/custom.js?ver=<?= time()?>"></script>





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
