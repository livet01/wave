<!-- <script src="<?php echo js_url('resultatRech'); ?>"></script> -->
<center>
	<form class="form-search" action="<?php echo site_url('index/recherche'); ?>" method="post" name="form_recherche" id="recherche_form">
		<div class="input-append">
			<input type="text" class="span6 search-query" data-provide="typeahead" name="recherche" id="recherche" value="<?php
			if (!empty($value)) { echo $value;
			}
 ?>"  placeholder="Recherchez un titre, un album, un artiste...">
			<input type="hidden" name="recherche_id" id="recherche_id" value="">
			<button type="submit" class="btn">
				Search
			</button>
		</div>
	</form>
</center>

<?php
if($affichage!=0 && ($affichage!=1 || !isset($resultat)) && $affichage!=2){ ?>
<div class="alert alert-error">
	<p>
		Veuillez saisir au moins une lettre pour faire une recherche.
	</p>
</div>
<?php }
	if(!isset($resultat) && $affichage==0){
 ?>
<div class="alert alert-info">
	<p>
		Bienvenue, il n'y a aucun disque dans la base de données.
	</p>
	<p>
		Veuillez ajouter un titre pour commencer.
	</p>
</div>
<?php }
	if(($affichage==0 || $affichage==1) && !empty($resultat)){
 ?>
<div id="box"></div>

<table class="table table-striped table-condensed">
	<caption>
		<?php if($affichage==0) { ?> <h2>Listes des disques</h2> <?php } ?>
		<?php if($affichage==1) { echo count($resultat); ?> résultat(s) trouvé(s).<?php } ?>
	</caption>
	<tr>
		<th>
		<input type="checkbox" onclick="CocheTout(this,'choix[]');" value="1" >
		</th>
		<th><i class="icon-music"></i> Titre</th>
		<th><i class="icon-user"></i> Artiste</th>
		<th><i class="icon-home"></i> Label</th>
		<th><i class="icon-wrench"></i> Actions</th>
	</tr>
	<tbody id="disque">

		<form  method="post" id="tdisque" action="#">
			<?php $i = 0;
			$j = 0;
			foreach ($resultat as $ligne) {
				if ($i % 2 == 0)
					echo '
			<tr class="bis">
				';
				else
					echo '
			<tr>
				';

				echo '<td class="checkbox">
				<input id="chx' . $j . '" class="chx" type="checkbox" name="choix[]" value="' . $ligne['dis_id'] . '">
				</td>';
				echo '<td class="left" onclick="; }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">' . $ligne['dis_libelle'] . '</td>';
				echo '<td onclick="ajaxBox_loader(true);$.get(\'' . site_url("index/affichage_disque/" . $ligne['dis_id']) . '\', function(data) { $(\'#aff-disque\').html(\'\').html(data); }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">' . $ligne['art_nom'] . '</td>';
				echo '<td onclick="ajaxBox_loader(true);$.get(\'' . site_url("index/affichage_disque/" . $ligne['dis_id']) . '\', function(data) { $(\'#aff-disque\').html(\'\').html(data); }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">' . $ligne['per_nom'] . '</td>';
				echo '<td>';
				if (has_permission('Wave.Modifier.Disque'))
					echo '<a class="action-tab" href="' . site_url("disque/modifier/" . $ligne['dis_id']) . '"><i class="icon-pencil"></a>';
				echo '</td>';
				echo '<td>';
				if (has_permission('Wave.Supprimer.Disque'))	
					echo '<a class="action-tab" onclick="CocheTout(this,\'choix[]\');CocheTout(this,\'choix[]\');$(\'#chx' . $j . '\').attr(\'checked\',\'checked\');$(\'#tdisque\').attr(\'action\',\'' . site_url("disque/supprimer") . '\').submit();" href="#"><i class="icon-trash"></a>';
				echo '</td>';
				echo '
			</tr>';
				$i++;
				$j++;
			}
			?>
		</form>
	</tbody>
</table>
<?php if(count($resultat)>15){ ?>
<div class="pagination">
	<nav class="navig_result">
		<div class="holder"></div>
	</nav>
</div>
<?php }
	}
?>

<div class="infos-disque">
	<ul class="icons" <?php if(($affichage==1 && isset($resultat)) || $affichage==0) { ?> id="aff-disque" <?php } ?>></ul>
</div>

<?php if (has_permission('Wave.Supprimer.Disque') || has_permission('Wave.Exporter.Disque')) { ?>
<div class="form-actions">
	<?php if (has_permission('Wave.Supprimer.Disque')) { ?>
	<a id="supprimer" class="btn btn-large btn-block disabled" href="#"><i class="icon-trash"></i> Supprimer les fiches</a><?php } ?>
	<?php if (has_permission('Wave.Exporter.Disque')) {?>
	<a id="exporter" class="btn btn-large btn-block disabled" href="#"><i class="icon-share-alt"></i> Exporter des fiches</a><?php } ?>
</div>
<?php } ?>

