<div id="cadre">
	<div id="barre_recherche">
		<form action="<?php echo site_url('index/recherche'); ?>" method="post" name="form_recherche">
			<input class="text" type="text" name="recherche" id="recherche"  placeholder="Recherchez un titre, un album, un artiste...">
			<input type="hidden" name="recherche_id" id="recherche_id" value="">
			<a class="btn-large-search" id="btn_rechercher" href="javascript: document.forms['form_recherche'].submit();"><i class="icon-search"></i> Rechercher</a>
		</form>
	</div>
	<div id="resultat"></div>
</div>
