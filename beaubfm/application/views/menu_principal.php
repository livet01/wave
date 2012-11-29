<div id="header">
			<div class="topright">
				<nav>
					<a class="btn-header-usr" href="#"><i class="icon-user"></i>
						<?php $user=$this->session->userdata("user");
							if(strtolower($user['uti_prenom'])!==strtolower($user['per_nom'])){
								if (!empty($user['uti_prenom'])){
									echo $user['uti_prenom'];
								}
								if (!empty($user['uti_prenom']) && !empty($user['uti_prenom'])){
									echo " ";
								}						
								if (!empty($user['per_nom'])){
									echo $user['per_nom'];
								}
							} else {
								if (!empty($user['uti_prenom'])){
									echo $user['uti_prenom'];
								}
							}
						?></a>
					<a class="btn-header-off" href="<?php echo site_url(array('connexion','deconnexion')); ?>"><i class="icon-off"></i></a>
				</nav>
			</div>
			<div class="menu">
				<nav>
					<a href="<?php echo base_url().'index.php/index/' ;?>"><i class="icon-home"></i>Accueil</a>
					<!--<a href="#"><i class="icon-user"></i>Mon profil</a>-->
					<a href="<?php echo site_url('index.php/disque/ajouter') ;?>"><i class="icon-plus-sign"></i>Ajouter disque</a>
					<a href="<?php echo base_url().'index.php/importerFiche/' ;?>"><i class="icon-signin"></i>Importer</a>
				</nav>
			</div>
</div>
