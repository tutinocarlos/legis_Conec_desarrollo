
<nav class="sidebar-nav">
	<ul id="sidebarnav" class="p-t-30">
		<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Publicaciones </span></a>
			<ul aria-expanded="false" class="collapse  first-level">
			
				<?php if (!$this->ion_auth->is_members() ):;?>
				<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Post" class="sidebar-link"><i class="mdi mdi-grease-pencil"></i><span class="hide-menu">Nueva</span></a></li>
				<?php endif; ?>
				
				<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Post/Listados" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Listados </span></a></li>
				<!--				<li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Editar </span></a></li>-->
			</ul>
		</li>
		
		<?php if ($this->ion_auth->is_admin() || $this->ion_auth->is_super() || $this->user->id_legislatura == 91):;?>
		
		<li class="sidebar-item "> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Breves en Imágenes </span></a>
			<ul aria-expanded="false" class="collapse  first-level">
				<li class="sidebar-item">
					<a href="<?= base_url() ?>Manager/Breves/suscriptores" class="sidebar-link"><i class="mdi mdi-grease-pencil"></i><span class="hide-menu">Suscriptores</span></a>
				</li>
				<?php if (!$this->ion_auth->is_members()):;?>
				<li class="sidebar-item">
					<a href="<?= base_url() ?>Manager/Breves/Gacetillas" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Crear Newsletters </span></a>
				</li>
				<?php endif; ?>
				<li class="sidebar-item">
					<a href="<?= base_url() ?>Manager/Breves/Newsletters" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Listar Newsletters  </span></a>
				</li>
			</ul>
		</li>
		<?php endif; ?>
			<?php if (!$this->ion_auth->is_members() ):;?>
			<?php endif;?>
		<?php if ($this->ion_auth->is_admin() && $this->user->id_legislatura == 91):; // usuarios legis conectadas?>
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
		<?php endif; ?>		
		<?php if ($this->ion_auth->is_admin() &&  $this->user->id_legislatura != 91):; // usuarios legis conectadas?>
								<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Organismo</span></a>
							<ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Legislaturas/edit/<?php echo $this->user->id_legislatura?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Editar </span></a></li>
								<!--				<li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Editar </span></a></li>-->
							</ul>
						</li>
		<?php endif; ?>		
		<?php if ($this->ion_auth->is_members() && $this->user->id_legislatura == 91):; // usuarios legis conectadas?>
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

								<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Legislaturas/listado" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Listados </span></a></li>
								<!--				<li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Editar </span></a></li>-->
							</ul>
						</li>
					</ul>

				</li>


			</ul>

		</li>
		<?php endif; ?>
		<?php if ($this->ion_auth->is_super() ):;?>
		<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Configuración </span></a>
			<ul aria-expanded="false" class="collapse  first-level">


				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Parámetros </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item">
						<a href="<?= base_url() ?>Manager/Tipo_publicacion" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Tipo Publicación </span></a></li>
						<li class="sidebar-item">
						<a href="<?= base_url() ?>Manager/Tipo_normativa" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Tipo Normativa </span></a></li>
						<li class="sidebar-item">
							<a href="<?= base_url() ?>Manager/Tematicas/" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Temáticas </span></a>

						</li>
						<li class="sidebar-item">
						
							<a href="<?= base_url() ?>Manager/Provincias/" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Provincias </span></a>

						</li>

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
					<?php endif; ?>
				<?php
				 if ($this->ion_auth->is_super()){
				?>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Usuarios </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Usuarios/" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Altas</span></a>

						</li>
						<!--						<li class="sidebar-item"><a href="<?php //echo base_url() ?>Manager/Subcategorias/" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Listados </span></a></li>-->

					</ul>

				</li>
				<?php
					}		
				?>
	
	</ul>
</nav>
<!--admin-->
