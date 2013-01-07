 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo base_url().'index.php/index/' ;?>">Wave</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="">
                <a href="<?php echo base_url().'index.php/index/' ;?>">Accueil</a>
              </li>
              <li class="">
                <a href="<?php echo site_url('disque/ajouter') ;?>"><i class="icon-plus-sign"></i>Ajouter disque</a>
              </li>
              <li class="">
                <a href="<?php echo base_url().'index.php/importerFiche/' ;?>"><i class="icon-signin"></i>Importer</a>
              </li>
              <li class="">
              	<a href="<?php echo base_url().'index.php/admin';?>"><i class="icon-envelope-alt"></i>Administration</a>
              </li>
                <li class="">
              <a class="btn-header-usr" href="#"><i class="icon-user"></i>
						<?php $user=$this->session->userdata("user");
							
								if (!empty($user['per_nom'])){
									echo $user['per_nom'];
								}
				
						?></a>
			 </li>
			 <li class="">
			 	<a href="<?php echo site_url(array('connexion','deconnexion')); ?>"></a>	
            </li>
            </ul>
          </div>
        </div>
      </div>
    </div>