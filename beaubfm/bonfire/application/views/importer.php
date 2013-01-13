<div class="cadre_selection">
	<?php
	if(isset($msg))
		echo $msg;
	?>
	<!-- Sélection de fichiers -->
	<div class="page-header">
		<h1>Importation</h1>
	</div>
	<div id="plupload">
		<div id="droparea">
			<p>Déposez vos fichiers ici</p>
			<span class"or">ou</span>
			<a href="#" id="browse" class="btn">Parcourir</a>
		</div>
		
		<div id="filelist">
			
		</div>
		<!-- Modal -->
		<div id="box-erreur" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="myModalLabel">Attention</h3>
		  </div>
		  <div class="modal-body">
		    <p></p>
		  </div>
		  <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
		  </div>
		</div>
	</div>
</div>

