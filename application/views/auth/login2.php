<!DOCTYPE html>
<html dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<!--    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">-->
	<title>Legislaturas Conectadas - Manager</title>
	<!-- Custom CSS -->
	<link href="<?= base_url()?>static/manager/dist/css/style.min.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
	.msg{
		margin: 15px 0;
	}
	span#eye{
		background-color: #fff!important;
		cursor: pointer!important;
	}
	</style>
</head>

<body data-base_url="<?= base_url()?>">
	<div class="main-wrapper">
		<!-- ============================================================== -->
		<!-- Preloader - style you can find in spinners.css -->
		<!-- ============================================================== -->
		<div class="preloader">
			<div class="lds-ripple">
				<div class="lds-pos"></div>
				<div class="lds-pos"></div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- Preloader - style you can find in spinners.css -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Login box.scss -->
		<!-- ============================================================== -->
		<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-light">
			<div class="auth-box bg-light 	">
					<div class="text-center p-t-20 p-b-20" style="background-color: white;">
						<span class="db"><img src="<?= base_url()?>static/web/images/logos/logoOriginal.png" alt="logo" /></span>
					</div>
				<div id="loginform">
					<!-- Form -->

					<?php
						$attributes = array('class' => 'form-horizontal m-t-20', 'id' => 'loginform');
						echo form_open('auth/login', $attributes);
					?>

					<div class="row p-b-30">
						<div class="col-12">

							<div id="infoMessage" class="text-center"><?php echo $message;?></div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control form-control-lg" placeholder="Ingrese su email" aria-label="Ingrese su email" aria-describedby="basic-addon1"  value="<?php echo $this->session->userdata('email_login');?>" name="identity">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-success text-white" id="basic-addon2"><i class="fas fa-pencil-alt"></i></span>
								</div>
								<input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1"  value="" name="password" id="txtpassword">
								<div class="input-group-append"  onclick="mostrarPassword()">
									<span id="eye" class="input-group-text"><i class=" fas fa-eye-slash" id="icon"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row ">
						<div class="col-12">
							<div class="form-group">
								<div class="p-t-20">
										<button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Recuperar Contraseña</button>
									<button class="btn btn-success float-right" type="submit">Ingresar</button>
								</div>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
				<div id="recoverform">
					<div class="text-center msg">
						<div class="text mensajes">
							<div class="alert alert-info" role="alert">
								Ingrese el correo electrónico registrado.
							</div>
							</div>
					</div>
					<div class="row m-t-20">
						<!-- Form -->
						<form class="col-12" action="" id="recovery">
							<!-- email -->
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="fas fa-envelope"></i></span>
								</div>
								<input type="text" id="recupero_email" class="form-control form-control-lg" placeholder="Ingrese su email" aria-label="Username" aria-describedby="basic-addon1" >
							</div>
							<!-- pwd -->
							<div class="row m-t-20 p-t-20 ">
								<div class="col-12">
									<a class="btn btn-success" href="#" id="to-login" name="action">Volver Login</a>
									<button id="recupero" class="btn btn-info float-right" type="button" name="action">Recuperar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- Login box.scss -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper scss in scafholding.scss -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper scss in scafholding.scss -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Right Sidebar -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Right Sidebar -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- All Required js -->
	<!-- ============================================================== -->
	<script src="<?= base_url()?>static/manager/assets/libs/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?= base_url()?>static/manager/assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?= base_url()?>static/manager/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- ============================================================== -->
	<!-- This page plugin js -->
	<!-- ============================================================== -->
	<script>
		$('[data-toggle="tooltip"]').tooltip();
		$(".preloader").fadeOut();
		// ============================================================== 
		// Login and Recover Password 
		// ============================================================== 
		$('#to-recover').on("click", function() {
			$("#loginform").slideUp();
			$("#recoverform").fadeIn();
		});
		$('#to-login').click(function() {

			$("#recoverform").hide();
			$("#loginform").fadeIn();
		});
		
		
			function mostrarPassword(){
				var cambio = document.getElementById("txtpassword");
				if(cambio.type == "password"){
					cambio.type = "text";
				$('#icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
				}else{
				cambio.type = "password";
				$('#icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
				}

			};
		
		$("#recupero").click(function(){
			
			
			var  email = $.trim($("#recupero_email").val());
			
			if($.trim($("#recupero_email").val()).indexOf('@', 0) == -1 || $.trim($("#recupero_email").val()).indexOf('.', 0) == -1) {
				$(".mensajes").html('<div class="alert alert-danger" role="alert">El correo electrónico introducido no es correcto.</div>');
					return false;
			}else{
					$(".mensajes").html();
			}

		var dato = new FormData();
		dato.append('email', email);
			
		$.ajax({
			type: "POST",
			contentType: false,
			dataType: 'json',
			data: dato,
			processData: false,
			cache: false,
			beforeSend: function () {
				$(".mensajes").html('<div class="alert alert-info" role="alert">Aguarde un momento, por favor</div>');
			},
			url: $("body").data('base_url')+"Home/cambiar_pwd",
			success: function (result) {
				
				console.log('result');
				console.log(result);
				
				$("#salida").html(result.html);
				
				if (result.estado == true) {
					 $('#recovery')[0].reset();
				$(".mensajes").html('<div class="alert alert-success" role="alert">'+result.message+'</div>');
				} else {
					
				$(".mensajes").html('<div class="alert alert-danger" role="alert">'+result.message+'</div>');
				}
//					 location.reload();
				

			},
			error: function (xhr, errmsg, err) {
				console.log(xhr.status + ": " + xhr.responseText);
			}
		});
		});

	</script>

</body>

</html>
