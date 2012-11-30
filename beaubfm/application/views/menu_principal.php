<div id="header">
			<div class="topright">
				<nav>
					<a class="btn-header-usr" href="#"><i class="icon-user"></i>
						<?php $user=$this->session->userdata("user");
							
								if (!empty($user['per_nom'])){
									echo $user['per_nom'];
								}
							
						?></a>
					<a class="btn-header-off" href="<?php echo site_url(array('connexion','deconnexion')); ?>"><i class="icon-off"></i></a>
				</nav>
			</div>
			<div class="menu">
				<nav>
					<a href="<?php echo base_url().'index.php/index/' ;?>"><i class="icon-home"></i>Accueil</a>
					<!--<a href="#"><i class="icon-user"></i>Mon profil</a>-->
					<a href="<?php echo site_url('disque/ajouter') ;?>"><i class="icon-plus-sign"></i>Ajouter disque</a>
					<a href="<?php echo base_url().'index.php/importerFiche/' ;?>"><i class="icon-signin"></i>Importer</a>
					<a href="<?php echo base_url().'index.php/envoyerMail/' ;?>"><i class="icon-envelope-alt"></i>Mails</a>
				</nav>
			</div>
</div>
