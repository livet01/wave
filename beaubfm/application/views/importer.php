<div id="cadre2">
	<div id="cadre_action">
		<a class="btn-large-action" href="javascript:document.forms[0].reset()"><i class="icon-undo"></i> Annuler </a>
		<a class="btn-large-action" href="javascript:document.forms['importer'].submit();"><i class="icon-ok"></i> Importer </a>
	</div>
	<div id="resultat_recherche">
		<div id="cadre_importation">
			<div class="cadre_selection">
				<?php echo $error; ?>
				<!-- Sélection de fichiers -->
				<h1>Importation</h1>
				<form  method="post" name="importer" id="importer" action="<?php echo site_url("importerFiche/envoi"); ?>" enctype="multipart/form-data">
					<p>
						<label class="lab_import" for="fichier">Fichier 1:</label>
						<input size="60" type="file" name="fichier" id="fichier">
						<span id="leschamps_2"><a href="javascript:create_champ_fichier(2)"><i class="icon-plus-sign"></i></a></span>
					</p>
				</form>
			</div>
		</div>
	</div>
</div>

