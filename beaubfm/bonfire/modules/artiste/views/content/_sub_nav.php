<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/artiste') ?>" id="list"><?php echo lang('artiste_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Artiste.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/artiste/create') ?>" id="create_new"><?php echo lang('artiste_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>