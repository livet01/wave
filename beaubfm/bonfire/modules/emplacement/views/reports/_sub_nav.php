<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/emplacement') ?>" id="list"><?php echo lang('emplacement_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Emplacement.Reports.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/reports/emplacement/create') ?>" id="create_new"><?php echo lang('emplacement_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>