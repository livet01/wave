<div id="cadre">
	<div id="barre_recherche">
		<form action="<?php echo site_url('index/recherche'); ?>" method="post" name="form_recherche" id="recherche_form">
			<input class="text" type="text" name="recherche" id="recherche" value="<?php if(!empty($value)) { echo $value; } ?>"  placeholder="Recherchez un titre, un album, un artiste...">
			<input type="hidden" name="recherche_id" id="recherche_id" value="">
			
			<a class="btn-large-search" id="btn_rechercher" href="javascript: document.forms['form_recherche'].submit();"><i class="icon-search"></i> Rechercher</a>		
			<?php if(!empty($value)) {?><a id="fermer-recherche" href="<?php echo site_url('index'); ?>" class="icon-remove"></a><?php } ?>	
		</form>
	</div>	
</div>
	