<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/parametre') ?>" id="list"><?php echo lang('parametre_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Parametre.Settings.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/settings/parametre/create') ?>" id="create_new"><?php echo lang('parametre_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>