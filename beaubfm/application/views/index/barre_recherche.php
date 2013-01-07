<div id="cadre">
	<div id="barre_recherche">
		<form >
			<input class="text" type="text">
			
			
			<a class="btn-large-search" id="btn_rechercher" href="javascript: document.forms['form_recherche'].submit();"><i class="icon-search"></i> Rechercher</a>		
			<?php if(!empty($value)) {?><a id="fermer-recherche" href="<?php echo site_url('index'); ?>" class="icon-remove"></a><?php } ?>	
		</form>
	</div>	
</div>
 
  
    <form class="form-search" action="<?php echo site_url('index/recherche'); ?>" method="post" name="form_recherche" id="recherche_form">   
 <div class="input-append">
<input type="text" class="span2 search-query"  name="recherche" id="recherche" value="<?php if(!empty($value)) { echo $value; } ?>"  placeholder="Recherchez un titre, un album, un artiste...">
<input type="hidden" name="recherche_id" id="recherche_id" value="">
<button type="submit" class="btn">Search</button>
</div>
  </form>