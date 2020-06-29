<style>

	span.representantes{
		    font-size: 16px;
    padding: 10px;
    font-weight: bold;
	}
</style>

<?php if(!$this->ion_auth->is_members()): ?>
<div class="col-md-6 col-lg-2 col-xlg-3">
	<a href="<?= base_url()?>Manager/Legislaturas">
		<div class="card card-hover">
			<div class="box  text-center" style="background-color: #00b19d;">
				<h1 class="font-light text-white"><i class="fas fa-pencil-alt"></i></h1>
				<h6 class="text-white">Agregar Organismos</h6>
			</div>
		</div>
	</a>
</div>
<?php endif;?>
	<div class="col-md-12 " data-select2-id="15">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Organismos</h4>
				<div class="table-responsive">
					<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th >ID</th>
									<th>Nombre</th>
									<th>Tipo Organismo</th>
									<th>Provincia</th>
										<th>Dirección</th>
									<th>Teléfono</th>
									<th>Representantes</th>
									<th>Estado</th>
									<th></th>
									<th class="text-right">Acciones</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>Nombre</th>
									<th>Tipo Organismo</th>
									<th>Provincia</th>
									<th>Dirección</th>
									<th>Teléfono</th>
									<th>Representantes</th>
									<th>Estado</th>
									<th></th>
									<th class=" text-right">Acciones</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<!--MODAL IMPORTAL REPRESENTANTES-->

<!-- Modal -->
<div id="myModal" class="modal fade " role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
		<form action="<?php echo base_url('Manager/legislaturas/import_csv'); ?>" method="post" enctype="multipart/form-data" id="form_csv">
			<div class="modal-content container">
				<div class="modal-header  row">
					<div class="alert alert-info col-sm-12 text-center" role="alert">
						<h2>Importación de Representantes </h2>
						<h3><span id="nombre_legis"></span></h3>
					</div>
				<div class="alert alert-danger col-sm-12" role="alert">
					<p>
						Los datos de representantes existentes se eliminarán de la base de datos al confirmar la importación.
					</p>
					<p>
						Sólo se aceptan archivos con formato *.CSV	
					</p>
				</div>
				</div>
				<div class="modal-body form-group row">
					 <input type="hidden" id="id_legislatura" name="id_legislatura">
					 <input type="hidden" id="delimitador" name="delimitador">
					<div class="col-md-12">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="file"  id="csvfile" required="" accept=".csv">
							<label class="custom-file-label" for="validatedCustomFile">Seleccione el Archivo...</label>
						</div>
					</div>
				</div>


					<div class="container">
					<div class="alert alert-warning col-sm-12 invisible" role="alert" id="msjPrev">
					Se importarán: <span id="cantReg"></span> registros.<br>
					</div>

					<div id="parsed_csv_list"></div>

					</div>

				<div class="modal-footer container">
					<input type="submit" class="btn btn-success btn-block invisible" name="importSubmit" id="importSubmit" value="Importar">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
<!--					 <button type="button" class="btn btn-primary">Importar</button>-->
				</div>
			</div>

		</form>
  </div>
</div>
