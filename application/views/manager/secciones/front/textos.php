<?php

//			echo $this->fecha_now ;die();
?>


<div class="col-md-12" data-select2-id="15">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title m-b-0">Seccion Parlamentos</h5>
			<div class="form-group m-t-20">
			
				<input type="text" class="form-control " id="parlamentos" value="">
			</div>
				<h5 class="card-title m-b-0">Noticias</h5>
			<div class="form-group m-t-20">
				<input type="text" class="form-control " id="noticias"value="">
			</div>
			<div class="form-group">
				<label>International Number <small class="text-muted">+19 999 999 999</small></label>
				<input type="text" class="form-control international-inputmask" id="international-mask" placeholder="International Phone Number">
			</div>
			<div class="form-group">
				<label>Phone / xEx <small class="text-muted">(999) 999-9999 / x999999</small></label>
				<input type="text" class="form-control xphone-inputmask" id="xphone-mask" placeholder="Enter Phone Number">
			</div>
			<div class="form-group">
				<label>Purchase Order <small class="text-muted">aaaa 9999-****</small></label>
				<input type="text" class="form-control purchase-inputmask" id="purchase-mask" placeholder="Enter Purchase Order">
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Form Elements</h5>
			<div class="row mb-3 align-items-center">
				<div class="col-lg-4 col-md-12 text-right">
					<span>Tooltip Input</span>
				</div>
				<div class="col-lg-8 col-md-12">
					<input type="text" data-toggle="tooltip" title="" class="form-control" id="validationDefault05" placeholder="Hover For tooltip" required="" data-original-title="A Tooltip for the input !">
				</div>
			</div>
			<div class="row mb-3 align-items-center">
				<div class="col-lg-4 col-md-12 text-right">
					<span>Type Ahead Input</span>
				</div>
				<div class="col-lg-8 col-md-12">
					<input type="text" class="form-control" placeholder="Type here for auto complete.." required="">
				</div>
			</div>
			<div class="row mb-3 align-items-center">
				<div class="col-lg-4 col-md-12 text-right">
					<span>Prepended Input</span>
				</div>
				<div class="col-lg-8 col-md-12">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">#</span>
						</div>
						<input type="text" class="form-control" placeholder="Prepend" aria-label="Username" aria-describedby="basic-addon1">
					</div>
				</div>
			</div>
			<div class="row mb-3 align-items-center">
				<div class="col-lg-4 col-md-12 text-right">
					<span>Appended Input</span>
				</div>
				<div class="col-lg-8 col-md-12">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="5.000" aria-label="Recipient 's username" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<span class="input-group-text" id="basic-addon2">$</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row mb-3 align-items-center">
				<div class="col-lg-4 col-md-12 text-right">
					<span class="text-success">Input with Sccess</span>
				</div>
				<div class="col-lg-8 col-md-12">
					<input type="text" class="form-control is-valid" id="validationServer01">
					<div class="valid-feedback">
						Woohoo!
					</div>
				</div>
			</div>
			<div class="row mb-3 align-items-center">
				<div class="col-lg-4 col-md-12 text-right">
					<span class="text-danger">Input with Error</span>
				</div>
				<div class="col-lg-8 col-md-12">
					<input type="text" class="form-control is-invalid" id="validationServer01">
					<div class="invalid-feedback">
						Please correct the error
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-lg-12">
					<input type="text" class="form-control" placeholder="col-md-12">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-11">
					<input type="text" class="form-control" placeholder="col-md-11">
				</div>
				<div class="col-lg-1 p-l-0">
					<input type="text" class="form-control" placeholder="col-md-1">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-10">
					<input type="text" class="form-control" placeholder="col-md-10">
				</div>
				<div class="col-lg-2">
					<input type="text" class="form-control" placeholder="col-md-2">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-9">
					<input type="text" class="form-control" placeholder="col-md-9">
				</div>
				<div class="col-lg-3">
					<input type="text" class="form-control" placeholder="col-md-3">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-8">
					<input type="text" class="form-control" placeholder="col-md-8">
				</div>
				<div class="col-lg-4">
					<input type="text" class="form-control" placeholder="col-md-4">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-7">
					<input type="text" class="form-control" placeholder="col-md-7">
				</div>
				<div class="col-lg-5">
					<input type="text" class="form-control" placeholder="col-md-5">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-6">
					<input type="text" class="form-control" placeholder="col-md-6">
				</div>
				<div class="col-lg-6">
					<input type="text" class="form-control" placeholder="col-md-6">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-5">
					<input type="text" class="form-control" placeholder="col-md-5">
				</div>
				<div class="col-lg-7">
					<input type="text" class="form-control" placeholder="col-md-7">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-2">
					<input type="text" class="form-control" placeholder="col-md-2">
				</div>
				<div class="col-lg-3">
					<input type="text" class="form-control" placeholder="col-md-3">
				</div>
				<div class="col-lg-4">
					<input type="text" class="form-control" placeholder="col-md-4">
				</div>
				<div class="col-lg-2">
					<input type="text" class="form-control" placeholder="col-md-2">
				</div>
				<div class="col-lg-1 p-l-0">
					<input type="text" class="form-control" placeholder="col-md-1">
				</div>
			</div>
		</div>
	</div>
</div>