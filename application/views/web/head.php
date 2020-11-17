
<!doctype html>
<html lang="en">

<head>
<?php	if($_SERVER['SERVER_ADDR'] == '10.1.1.77'): ?>
		
		<!-- Google Tag Manager -->
		<script>
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-TQ6PJCK');
			</script>
		<!-- End Google Tag Manager -->
		
	<?php	endif; ?>
	<title> Legislaturas Conectadas </title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Favicon icon -->
	<link rel="shortcut icon" type="image/png" href="<?= base_url()?>static/web/images/favicon.png" />
	<!-- Google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,400,400i,500,500i,700" rel="stylesheet">


	<!-- Bootstrap -->
	<link href="<?= base_url()?>static/web/css/bootstrap.min.css?ver=<?= time()?>" rel="stylesheet">
	<!-- Fontawsome -->
	<link href="<?= base_url()?>static/web/css/font-awesome.min.css?ver=<?= time()?>" rel="stylesheet">
	<!-- Animate CSS-->
	<link href="<?= base_url()?>static/web/css/animate.css?ver=<?= time()?>" rel="stylesheet">
	<!-- menu CSS-->
	<link href="<?= base_url()?>static/web/css/bootstrap-4-navbar.css?ver=<?= time()?>" rel="stylesheet">
	<!-- Portfolio Gallery -->
	<link href="<?= base_url()?>static/web/css/filterizer.css?ver=<?= time()?>" rel="stylesheet">
	<!-- Lightbox Gallery -->
	<!--	<link href="<?php //echo  base_url()?>static/web/inc/lightbox/css/jquery.fancybox.css" rel="stylesheet">-->
	<!-- OWL Carousel -->
	<link rel="stylesheet" href="<?= base_url()?>static/web/css/owl.carousel.min.css?ver=<?= time()?>">
	<link rel="stylesheet" href="<?= base_url()?>static/web/css/owl.theme.default.min.css?ver=<?= time()?>">
	<!-- Preloader CSS-->
	<link href="<?= base_url()?>static/web/css/fakeLoader.css?ver=<?= time()?>" rel="stylesheet">
	<!-- Main CSS -->
	<link href="<?= base_url()?>static/web/css/style.css?ver=<?= time()?>" rel="stylesheet">
	<!-- Default CSS Color -->
	<link href="<?= base_url()?>static/web/color/default.css?ver=<?= time()?>" rel="stylesheet">
	<!-- Responsive CSS -->
	<link href="<?= base_url()?>static/web/css/responsive.css?ver=<?= time()?>" rel="stylesheet">
	<link href="<?= base_url()?>static/web/css/slick.css?ver=<?= time()?>" rel="stylesheet">
	
<!--	notificaciones-->
	<link href="<?= base_url() ?>static/manager/assets/libs/toastr/build/toastr.min.css?ver="<?= time() ?> rel="stylesheet">


<!--CSS  data tables-->
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css?ver=<?= time()?>" rel="stylesheet">

	<!-- MAPA CSS -->
	<link href="<?= base_url()?>static/manager/assets/libs/pais/jquery-jvectormap-2.0.3.css?ver=<?= time()?>" rel="stylesheet">


	<!-- UIkit CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.7/css/uikit.min.css?ver=<?= time()?>" />




<?php
	if(isset($csss)){
		
			if(is_array ($csss)){
				
				foreach($csss as $data){
				
					echo '<link rel="stylesheet" href="'.$data.'" />';
				}

			}else{
   
				echo '<link rel="stylesheet" href="'.$csss.'" />';
   
				
			}
			
	}
			?>




	<!-- UIkit JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.7/js/uikit.min.js?ver=<?= time()?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.7/js/uikit-icons.min.js?ver=<?= time()?>"></script>


</head>

<body data-base_url="<?= base_url();?>">
<?php	if($_SERVER['SERVER_ADDR'] == '10.1.1.77'):?>
		<!-- Google Tag Manager (noscript) -->
	<noscript>
	<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TQ6PJCK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php	endif; ?>

	<!-- Preloader -->
	<div id="fakeloader"> </div>

	<div class="top-menu-1x">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="top-menu-left">
						<p><i class="fa fa-calendar"></i><?php echo $fecha ?></p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="top-menu-right">
						<ul class="top-nav-social topnav">
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

	<?= $nav;?>
