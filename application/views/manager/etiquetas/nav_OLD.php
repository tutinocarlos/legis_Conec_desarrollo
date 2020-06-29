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
			<?php if (!$this->ion_auth->is_members() || ($this->ion_auth->is_admin() && $this->user->id_legislatura == 1) ):;?>

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
<!--								<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Legislatura </span></a>-->
							<ul aria-expanded="false" class="collapse  first-level">

<!--								<li class="sidebar-item"><a href="<?= base_url() ?>Manager/Legislaturas/edit/<?php echo $this->user->id_legislatura?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Editar </span></a></li>-->
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
		<!--
		<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Buttons</span></a></li>
		<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>
			<ul aria-expanded="false" class="collapse  first-level">
				<li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>
				<li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>
			</ul>
		</li>
		<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li>
		<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>
			<ul aria-expanded="false" class="collapse  first-level">
				<li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>
				<li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>
				<li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>
				<li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>
				<li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>
			</ul>
		</li>
		<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>
			<ul aria-expanded="false" class="collapse  first-level">
				<li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>
				<li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>
			</ul>
		</li>
		<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>
			<ul aria-expanded="false" class="collapse  first-level">
				<li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>
				<li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>
				<li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>
				<li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>
			</ul>
		</li>
-->
	</ul>
</nav>
