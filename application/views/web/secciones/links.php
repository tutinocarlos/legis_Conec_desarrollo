<style>
	.text-nowrap,.text-left{
		vertical-align: top;
		font-size: 16px;
/*		cursor: pointer*/
}
		
	}

</style>

<div class="business-banner">
	<div class="hvrbox">
		<img src="<?= base_url('static/web/images/slider/banner_paginas.png')?>" alt="Mountains" class="hvrbox-layer_bottom">
		<div class="hvrbox-layer_top">
			<div class="container">
				<div class="overlay-text text-center">
					<h3>
						<?= $titulo_seccion?>
					</h3>

				</div>
			</div>
		</div>
	</div>
</div>
			<div class="container">
			<div class="table-responsive  text-left" >
				<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
					<table id="table_links" class="display" style="width:100%">
						<thead>
							<tr>
								<th>Título</th>
								<th>Detalle</th>
								<th>Url</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			</div>
			<div class="padding-top-large"></div>
<script>
	var base_url = '<?= base_url()?>';
</script>