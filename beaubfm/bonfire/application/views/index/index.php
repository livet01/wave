<center>
	<div class="resuRecherche">
	<form class="form-search" action="<?php echo site_url('index/recherche'); ?>" method="post" name="form_recherche" id="recherche_form">
		<div class="input-append">
			<input type="text" class="span6 search-query" data-provide="typeahead" name="recherche" id="recherche" value="<?php
			if (!empty($value)) { echo $value;
			} ?>"  placeholder="Recherchez un titre, un album, un artiste...">
			<input type="hidden" name="recherche_id" id="recherche_id" value="">
			<button type="submit" class="btn">
				Rechercher
			</button>
		</div>
	</form>
</div>
</center>

<div id="tableau-index">
	<center class="container">
		<h3 style="padding-top: 180px">
			<img src="<?php echo img_url('ajax-loader-2.gif') ?>"><br><br>
			Chargement en cours ...
		</h3>
	</center>
</div>

<div class="form-actions">
	<?php if (has_permission('Wave.Supprimer.Disque')) { ?>
	<span id="supprimer"><a class="btn btn-block" href="#"><i class="icon-trash"></i> Supprimer les fiches</a></span><?php } ?>
	<?php if (has_permission('Wave.Exporter.Disque')) {?>
	
	<span id="exporter"><a  class="btn" href="#"><i class="icon-share-alt"></i> Exporter des fiches</a></span><?php } ?>
	<a class="btn"href="<?php echo site_url('index/rss'); ?>"><img src="<?php echo img_url('feed-icon.png'); ?>"> RSS</a>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#tableau-index').load('<?php echo site_url("index/index_ajax/"); ?>');
	});
</script>
