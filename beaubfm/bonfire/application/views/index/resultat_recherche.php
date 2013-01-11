<!-- <script src="<?php echo js_url('resultatRech'); ?>"></script> -->
<center>
	<div class="resuRecherche">
	<form class="form-search" action="<?php echo site_url('index/recherche'); ?>" method="post" name="form_recherche" id="recherche_form">
		<div class="input-append">
			<input type="text" class="span6 search-query" data-provide="typeahead" name="recherche" id="recherche" value="<?php
			if (!empty($value)) { echo $value;
			}
 ?>"  placeholder="Recherchez un titre, un album, un artiste...">
			<input type="hidden" name="recherche_id" id="recherche_id" value="">
			<button type="submit" class="btn">
				Rechercher
			</button>
		</div>
	</form>
</div>
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
<table class="table">
	<caption>
		<div class="page-header">
		<?php if($affichage==0) { ?> <h2>Liste des disques</h2> <?php } ?>
		<?php if($affichage==1) { ?> <h2> <?php echo count($resultat); ?> résultat(s) trouvé(s).</h2><?php } ?>
		</div>
	</caption>

	<tbody id="disque">
		<form  method="post" id="tdisque" action="#">
			<?php $i = 0;
			$j = 0;
			foreach ($resultat as $ligne) {
				if ($i % 2 == 0)
					$bis = 'class="bis"';
				else
					$bis = '';	
						
				echo '<tr '.$bis.' >';
				$script = 'style="cursor:pointer;" onclick="
				if($(\'#img'.$ligne['dis_id'].'\').attr(\'class\') == \'icon-chevron-down\') {
				$(\'.colall\').hide(); $(\'.icon-chevron-down\').attr(\'class\',\'icon-chevron-right\'); }
				else {
				$(\'.colall\').hide(); $(\'.icon-chevron-down\').attr(\'class\',\'icon-chevron-right\');
				$(\'#col'.$ligne['dis_id'].'\').show(); 
				$.get(\'' . site_url("index/affichage_disque/" . $ligne['dis_id']) . '\', 
				function(data) {
					 $(\'#col'.$ligne['dis_id'].'\').html(\'\').html(data); }).complete(
					 function(){ $(\'#img'.$ligne['dis_id'].'\').attr(\'class\',\'icon-chevron-down\') });
					 }"';
				echo '<td><input id="chx' . $j . '" class="check" type="checkbox" name="choix[]" value="' . $ligne['dis_id'] . '"></td>';
				
				if (has_permission('Wave.Modifier.Disque')){
					if($ligne['sty_couleur']!=null){
						echo '<td '.$script.'><i style="background:'.$ligne['sty_couleur'].'" class="circle"></i></td>';
					} else {
						echo '<td '.$script.'></td>';
					}
				}
				
				if($ligne['emp_libelle'] == "En attente" && has_permission('Wave.Modifier.Disque')) {
				echo '<td class="left" '.$script.'><i id="img'.$ligne['dis_id'].'" href="#" class="icon-chevron-right"></i> <span style="color:red;"><i class="icon-warning-sign"></i> ' . $ligne['dis_libelle'] . '</span></td>';
				}
				else
					echo '<td class="left" '.$script.'><i id="img'.$ligne['dis_id'].'" href="#" class="icon-chevron-right"></i> ' . $ligne['dis_libelle'] . '</td>';
				
				echo '<td '.$script.'>' . $ligne['art_nom'] . '</td>';
				echo '<td '.$script.'>' . $ligne['per_nom'] . '</td>';
				echo '<td>';
				if (has_permission('Wave.Modifier.Disque'))
					echo '<a class="action-tab" href="' . site_url("disque/modifier/" . $ligne['dis_id']) . '"><i class="icon-pencil"></a>';
				echo '</td>';
				echo '<td>';
				if (has_permission('Wave.Supprimer.Disque'))	
					echo '<a class="action-tab" onclick="CocheTout(this,\'choix[]\');CocheTout(this,\'choix[]\');$(\'#chx' . $j . '\').attr(\'checked\',\'checked\');$(\'#tdisque\').attr(\'action\',\'' . site_url("disque/supprimer") . '\').submit();" href="#"><i class="icon-trash"></a>';
				echo '</td>';
				echo '</tr>';
				?>
				<tr id="<?php echo "col".$ligne['dis_id']; ?>"  class="colall">
				
				</tr>
				<?php
				$i++;
				$j++;
			}
			
			?>
		</form>
	</tbody>
		<thead>
	<tr>
		<th><input type="checkbox" onclick="CocheTout(this,'choix[]');" value="1" ></th>
		<?php if (has_permission('Wave.Modifier.Disque'))
			{ ?>
		<th><i class="icon-certificate"></i></th><?php } ?>
		<th><i class="icon-music"></i> Titre</th>
		<th><i class="icon-user"></i> Artiste</th>
		<th><i class="icon-home"></i> Label</th>
		<th><i class="icon-pencil"></i></th>
		<th><i class="icon-trash"></i></th>
	</tr>
	</thead>
</table>
<?php if(count($resultat)>15){ ?>

<center>
<div class="holder">
</div>
</center>
<?php }
	}
?>

<div class="infos-disque">
	<ul class="icons" <?php if(($affichage==1 && isset($resultat)) || $affichage==0) { ?> id="aff-disque" <?php } ?>></ul>
</div>

<?php if (has_permission('Wave.Supprimer.Disque') || has_permission('Wave.Exporter.Disque')) { ?>
<div class="form-actions">
	<?php if (has_permission('Wave.Supprimer.Disque')) { ?>
	<span id="supprimer"><a class="btn btn-block" href="#"><i class="icon-trash"></i> Supprimer les fiches</a></span><?php } ?>
	<?php if (has_permission('Wave.Exporter.Disque')) {?>
	
	<span id="exporter"><a  class="btn" href="#"><i class="icon-share-alt"></i> Exporter des fiches</a></span><?php } ?>
</div>
<?php } ?>

