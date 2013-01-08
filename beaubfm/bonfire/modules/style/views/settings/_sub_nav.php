<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/style') ?>" id="list"><?php echo lang('style_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Style.Settings.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/settings/style/create') ?>" id="create_new"><?php echo lang('style_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>