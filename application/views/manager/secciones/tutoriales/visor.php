<style>
	.centrado {
	
			margin: 20px auto; 
	}
	iframe.centrado{ 
		display: block; 
	} 
	.volver{
		margin: 20px 0;
	}
	.video-responsive {
    height: 0;
    overflow: hidden;
    padding-bottom: 56.25%;
    padding-top: 30px;
    position: relative;
    }
.video-responsive iframe, .video-responsive object, .video-responsive embed {
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    }
</style>
<div class="container-fluid">
	<div class="card-body">
	<div>
		<a href="<?= base_url('Manager/Tutoriales')?>" class="btn m-t-20 btn-info waves-effect waves-light volver">
			<i class="fas fa-arrow-left"></i> Volver a Tutoriales
			</a>
		
	</div>
		<div class="card center-text">
			<?= $tutorial; ?>
		</div>
	</div>
		
</div>
