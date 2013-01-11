<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/parametre') ?>" id="list"><?php echo lang('parametre_list'); ?></a>
	</li>
</ul>