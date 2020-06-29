<?php 

// var_dump($user);
?>

<style type="text/css">
	
td.dt-body-right > a{
	margin-left: 5px;
}


</style>
<div class="row">
	<?php if(!$this->ion_auth->is_members()):?>
	<div class="col-sm-12">
  <div class="card card-body">
   <form id="add_suscriptor">
   	
			<div class="card">
				<div class="card-body">
						<h4 class="card-title m-b-0 titulo">Agregar Suscriptores</h4>


						<div class="form-group m-t-20">
								<input type="hidden" class="form-control date-inputmask" id="origen" name="origen" value="<?php echo $this->user->id_legislatura?>" >
								<input type="hidden" class="form-control date-inputmask" id="id" name="id"  >
								<label>Nombre <small class="text-muted"></small></label>
								<input type="text" class="form-control date-inputmask" id="name" name="name" >
								<span id="nombre_error" class="text-danger"></span>
						</div>
						<div class="form-group">
								<label>Apellido <small class="text-muted"></small></label>
								<input type="text" class="form-control phone-inputmask" id="lastname" name="lastname">
								<span id="apellido_error" class="text-danger"></span>
						</div>
						<div class="form-group">
								<label>Email <small class="text-muted"></small></label>
								<input type="text" class="form-control" id="email" name="email" >
								<span id="email_error" class="text-danger"></span>
						</div>					
						<div class="form-group">
								<label>Teléfono <small class="text-muted"></small></label>
								<input type="text" class="form-control" id="telephone" name="telephone" >
						</div>
						<div class="form-group">
								<label>Organización / Empresa <small class="text-muted"></small></label>
								<input type="text" class="form-control" id="org" name="org" >
						</div>
						<input type="hidden" class="form-control date-inputmask" id="iduser_ins" name="iduser_ins" value="<?= $user->id?>" readonly>
						
						<button type="submit" id="cargar_datos" class="btn btn-success">Enviar Datos</button>
						<button type="submit" id="cancelar_datos" class="btn btn-danger invisible">Cancelar</button>
					
				</div>
			</div>
   </form>
	</div>
	</div>
	<?php endif;?>
	<div class="col-sm-12">
  <div class="card card-body">
	<div class="card">
		<div class="card-body" id="list_suscriptores">
			<h4 class="card-title">Listado de Suscrtiptores</h4>
			<div class="table-responsive">
				<div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
					<table id="suscriptores" class="display" style="width:100%">
						<thead>
							<tr>
								<th style="width:3%;">ID</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Email</th>
								<th>Acciones</th>
								<th>Origen</th>
							</tr>
						</thead>
	
					</table>
				</div>
			</div>
		</div>
	</div>
  </div>
	</div>

	</div>



 <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      	<div class="card">
      		<div class="card-body">
        <h4 class="modal-title">Datos del Suscriptor</h4>
      			<div class="row">
      				<div class="col-md-6">
      					
      			<div class="form-group m-t-20">
      				<label>Nombre <small class="text-muted"></small></label>
      				<input type="text" class="form-control date-inputmask" id="name_view" name="name_view" >
      				<span id="nombre_error" class="text-danger"></span>
      			</div>
      			<div class="form-group">
      				<label>Apellido <small class="text-muted"></small></label>
      				<input type="text" class="form-control phone-inputmask" id="lastname_view" name="lastname_view">
      				<span id="apellido_error" class="text-danger"></span>
      			</div>
      			<div class="form-group">
      				<label>Email <small class="text-muted"></small></label>
      				<input type="text" class="form-control" id="email_view" name="email_view" >
      				<span id="email_error" class="text-danger"></span>
      			</div>					
      			<div class="form-group">
      				<label>Teléfono <small class="text-muted"></small></label>
      				<input type="text" class="form-control" id="telephone_view" name="telephone_view" >
      			</div>
      			<div class="form-group">
      				<label>Organización / Empresa <small class="text-muted"></small></label>
      				<input type="text" class="form-control" id="org_view" name="org_view" >
      			</div>
      				</div>	
      				<div class="col-md-6">
  					<div class="form-group m-t-20">
      				<label>Ingresado por : <small class="text-muted"></small></label>
      					<input type="text" class="form-control date-inputmask" id="iduser_ins_view" name="iduser_ins_view" value="" readonly>
      
      			</div>
      			</div>
      			</div>

      		</div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>

</div>

<script>

	var base_url = '<?= base_url()?>';

</script>

