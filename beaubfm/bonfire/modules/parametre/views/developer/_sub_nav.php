<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/developer/parametre') ?>" id="list"><?php echo lang('parametre_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Parametre.Developer.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/developer/parametre/create') ?>" id="create_new"><?php echo lang('parametre_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>