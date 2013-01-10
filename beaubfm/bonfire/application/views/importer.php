<div class="cadre_selection">
	<?php
	if(isset($msg))
		echo $msg;
	?>
	<!-- Sélection de fichiers -->
	<div class="page-header">
		<h1>Importation</h1>
	</div>
	<form  class="form-inline" method="post" name="importer" id="importer" action="<?php echo site_url("importerFiche/envoi"); ?>" enctype="multipart/form-data">
		<p>
			<label class="lab_import" for="fichier_1">Fichier 1 : </label>
			<input size="60" type="file" name="fichier_1" id="fichier_1">
			<span id="leschamps_2"><a href="javascript:create_champ_fichier(2)"><i class="icon-plus-sign"></i></a></span>
		</p>
	</form>
</div>
<div class="form-actions">
	<a class="btn btn-primary" href="javascript:document.forms['importer'].submit();"><i class="icon-ok icon-white"></i> Importer </a>
	<a class="btn" href="javascript:document.forms[0].reset()"><i class="icon-repeat"></i> Annuler </a>
</div>


