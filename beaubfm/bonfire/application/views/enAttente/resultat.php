<!-- <script src="<?php echo js_url('resultatRech'); ?>"></script> -->
<center>	
		<?php
		if (isset($msg))
			echo $msg;
		?>
		<form  method="post" id="tdisqueI" action="#">
		<div id="tableau-index">
			<center class="container">
				<h3 style="padding-top: 180px">
					<img src="<?php echo img_url('ajax-loader-2.gif') ?>"><br><br>
					Chargement en cours ...
				</h3>
			</center>
		</div>
		</form>
				
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('#tableau-index').load('<?php echo site_url("enAttente/index_ajax/"); ?>');
			});
		</script>

	<div class="form-actions">
		<span id="supprimerI"><a class="btn disabled" href="#"><i class="icon-trash"></i>Supprimer les fiches</a></span>
	</div>