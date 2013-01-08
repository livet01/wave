<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/developer/emplacement') ?>" id="list"><?php echo lang('emplacement_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Emplacement.Developer.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/developer/emplacement/create') ?>" id="create_new"><?php echo lang('emplacement_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>