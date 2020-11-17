    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>static/manager/assets/libs/jquery/dist/jquery.min.js?ver=<?= time()?>"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url() ?>static/manager/assets/libs/popper.js/dist/umd/popper.min.js?ver=<?= time()?>"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/bootstrap/dist/js/bootstrap.min.js?ver=<?= time()?>"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js?ver=<?= time()?>"></script>
    <script src="<?= base_url() ?>static/manager/assets/extra-libs/sparkline/sparkline.js?ver=<?= time()?>"></script>
    <!--Wave Effects -->
    <script src="<?= base_url() ?>static/manager/dist/js/waves.js?ver=<?= time()?>"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url() ?>static/manager/dist/js/sidebarmenu.js?ver=<?= time()?>"></script>
    <!--Custom JavaScript -->

<!--
    <script src="<?= base_url() ?>static/manager/dist/js/pages/chart/chart-page-init.js"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/flot/excanvas.js"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/flot/jquery.flot.js"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/flot/jquery.flot.time.js"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
-->
    <script src="<?= base_url() ?>static/manager/assets/libs/toastr/build/toastr.min.js?ver=<?= time()?>"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/jquery-steps/build/jquery.steps.min.js?ver=<?= time()?>"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/ligthbox/lightbox.js?ver=<?= time()?>"></script>
    <script src="<?= base_url() ?>static/manager/assets/libs/jquery-validation/dist/jquery.validate.min.js?ver=<?= time()?>"></script>
    <script src="<?= base_url() ?>static/manager/assets/extra-libs/DataTables/datatables.js?ver=<?= time()?>"></script>




    <script src="<?= base_url() ?>static/manager/dist/js/jquery-confirm.min.js?ver=<?= time()?>"></script>
    <script src="<?= base_url() ?>static/manager/dist/js/custom.js?ver=<?= time()?>"></script>

    <script src="<?= base_url() ?>static/manager/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js?ver=<?= time()?>"></script>

    <?php 

	/*
	MENSAJES DE GRABACION Y MODIFICACIN DE DATOS
	$grabar_datos_array = array(
		'seccion' => 'Grabar Legislaturas',
		'mensaje' => $mensaje,
		'estado' => seccess o error,
	);

	$this->session->set_userdata('save_data', $grabar_datos_array);
	*/
	
if (isset($_SESSION['save_data'])){ 
	
	echo "<script>toastr.".$_SESSION['save_data']['estado']."('".$_SESSION['save_data']['mensaje']."', '".$_SESSION['save_data']['seccion']."');</script>";
	
	
	if(isset($_SESSION['save_data']['open_imagen'])){
		
		echo "<script>$('#Toggle-2').collapse({
  toggle: true
		})</script>";
	}
	
		
	if(isset($_SESSION['save_data']['open_video'])){
		
		echo "<script>$('#Toggle-3').collapse({
  toggle: true
		})</script>";
	}
	
	
	
	$this->session->unset_userdata('save_data');
}

?>

    <?php
	/*
	CARGA DINAMICA DE SCRIPTS DE CADA SESCCION
	*/
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
