<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/emission_benevole') ?>" id="list"><?php echo lang('emission_benevole_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Emission_Benevole.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/emission_benevole/create') ?>" id="create_new"><?php echo lang('emission_benevole_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>