<?php
//
//var_dump($faqs);
//die();

?>

<style>
div.business-faq-1x .card{
	border: 0px!important;

	}
	
.single-faq .card-header {
	background: #eee!important;
}
	section#faqs div.single-partner{
		margin-bottom: 0px!important;
		border-bottom: 0px!important;
	}
	
</style>
<section id="faqs">
	
<div class="business-faq-1x">
	<div class="container ">
		<?php if(isset($faqs)){?>
		<div class="row">

			<div class="col-md-12">
				<div class="business-title-middle">
					<h2>Algunas preguntas que pueden ayudarte</h2>
					<span class="title-border-middle"></span>
					<div class="padding-bottom-middle"></div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="panel-group" id="accordion" role="tablist">

					<?php 
						$a = 1;
						foreach($faqs as $data){
//							echo $a++;
					?>
				
					<div class="card single-faq">
						<div class="card-header" role="tab" id="heading<?= $a++ ?>">
							<h5 class="mb-0">
								<a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapse<?= $a ?>" role="button" aria-expanded="false" aria-controls="collapse<?= $a ?>">
									<?=$data['titulo']?>
								</a>
							</h5>
						</div>

						<div id="collapse<?= $a ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?= $a ?>" data-parent="#accordion">
							<div class="card-body">
								<?=$data['texto']?>
							</div>
						</div>
					</div>
					<?php 
						}
					?>
				</div>
			</div>
		</div>
		<?php 
		}
		?>
	</div>
</div>
</section>