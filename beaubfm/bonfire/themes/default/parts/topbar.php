<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">

	    <div class="container">
			<!-- .btn-navbar is used as the toggle for collapsible content -->
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a href="<?php echo site_url('home'); ?>" class="brand">
				<?php e($this->settings_lib->item('site.title')); ?>
			</a>
			
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
					<li class="divider-vertical"></li>
					<?php if (isset($current_user->email)) : ?>
					<li class="dropdown" >
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?>
						<i class="icon-user icon-white"></i>
						<b class="caret"></b></a>

						<ul class="dropdown-menu">
							<?php if (has_permission('Site.Content.View')) : ?>
							<li>
								<?php echo anchor(SITE_AREA, 'Panel d\'administration'); ?>
							</li>

							<li class="divider"></li>
							<?php endif; ?>
							<li>
								<a href="<?php echo site_url('users/profile');?>">
									<?php echo lang('bf_user_settings') ?>
								</a>
							</li>

							<li class="divider"></li>
							<li>
								<a href="<?php echo site_url('logout');?>">
									<?php echo lang('bf_action_logout') ?>
								</a>
							</li>
						</ul>
					</li>

					<?php else :  ?>

						<li>
							<a href="<?php echo site_url('login');?>" class="login-btn">
								<?php echo lang('bf_action_login') ?>
							</a>
						</li>

					<?php endif; ?>
				</ul>
				<ul class="nav">
				<?php  
				if (has_permission('Wave.Recherche.Disque')) {
					?><li><a href="<?php echo site_url("index"); ?>">Rechercher<?php
					if (has_permission('Wave.Modifier.Disque'))
					{
					 if(defined('ATTENTE') && (ATTENTE)!=0) { ?>
					 <span class="badge badge-important"><?php echo ATTENTE; ?></span>
					<?php } } ?></a></li><?php  }
				else { ?>
					<li><a href="<?php echo site_url("index"); ?>">Liste des disques</a></li>
					<?php
				}
				if(isset($_COOKIE['bf_session']))
					 $valeur = unserialize($_COOKIE['bf_session']); 
				else {
					$valeur= array();
				} 
				 if (has_permission('Wave.Ajouter.Disque')) { ?>
				  <li><a href="<?php echo site_url("disque/ajouter"); ?>">Ajouter un disque <?php if(isset($valeur['user_id']) && isset($valeur['auth_custom'])) { if(file_exists('./assets/upload/'.$valeur['user_id'].'-'.$valeur['auth_custom'])) { ?><span class="badge badge-info">1</span><?php }} ?></a></li>
				  <?php } if (has_permission('Wave.Importer.Disque')) {  ?><li><a href="<?php echo site_url("importerFiche"); ?>">Importer</a></li>
					<?php if(defined('NBU') && defined('NBNU') && (NBU+NBNU)!=0) { ?>
					<li id="disque-incorrects"><a href="<?php echo site_url("enAttente"); ?>">Disques incorrects  <?php if(NBU != 0) { ?><span class="badge badge-warning"><?php echo NBU; ?></span> <?php } if(NBNU != 0) { ?><span class="badge badge-info"><?php echo NBNU; ?></span><?php } ?></a></li>
					<?php } }  ?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>	<!-- /.container -->
	</div>	<!-- /.navbar-inner -->
</div>	<!-- /.navbar -->
<!-- End of Navbar Template -->

