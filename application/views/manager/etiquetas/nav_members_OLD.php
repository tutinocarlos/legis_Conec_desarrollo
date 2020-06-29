
<nav class="sidebar-nav">
	<ul id="sidebarnav" class="p-t-30">
			<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Publicaciones </span></a>
				<ul aria-expanded="false" class="collapse  first-level">

					<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Post/Listados" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Listados </span></a></li>
					<!--				<li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Editar </span></a></li>-->
				</ul>
			</li>

	<?php 
if (($this->ion_auth->is_members() && $this->user->id_legislatura == 91) || ($this->ion_auth->is_members() && $this->user->id_legislatura ==1)):?>

		<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Configuración </span></a>
			<ul aria-expanded="false" class="collapse  first-level">


				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Parámetros </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item">
						<a href="<?= base_url() ?>Manager/Tipo_publicacion" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Tipo Publicación </span></a></li>
						<li class="sidebar-item">
						<a href="<?= base_url() ?>Manager/Tipo_normativa" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Tipo Normativa </span></a></li>



						<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Ambito/" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Ámbito de Publicación </span></a></li>
						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Legislaturas </span></a>
							<ul aria-expanded="false" class="collapse  first-level">
								<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Legislaturas" class="sidebar-link"><i class="mdi mdi-grease-pencil"></i><span class="hide-menu">Nueva</span></a></li>
								<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Legislaturas/listado" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Listados </span></a></li>
								<!--				<li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Editar </span></a></li>-->
							</ul>
						</li>
					</ul>

				</li>


			</ul>

		</li>
<?php else:?>

			<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Organismo </span></a>
				<ul aria-expanded="false" class="collapse  first-level">
					<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Legislaturas/edit/<?php echo $this->user->id_legislatura?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu">Ver </span></a></li>
					<!--				<li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Editar </span></a></li>-->
				</ul>
			</li>
<?php endif;?>
	</ul>
</nav>
<!--nav memebers-->