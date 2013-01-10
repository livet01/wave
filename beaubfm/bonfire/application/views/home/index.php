
	
	<div id="overview" >
		<center>
	<div class="indexRecherche">
	<form class="form-search" action="<?php echo site_url('index/recherche'); ?>" method="post" name="form_recherche" id="recherche_form">
		<div class="input-append">
			<input type="text" class="span6 search-query" data-provide="typeahead" name="recherche" id="recherche" value="<?php
			if (!empty($value)) { echo $value;
			}
 ?>"  placeholder="Recherchez un titre, un album, un artiste...">
			<input type="hidden" name="recherche_id" id="recherche_id" value="">
			<button type="submit" class="btn">
				Recherche
			</button>
		</div>
	</form>
	</div>
</center>
	</div>



