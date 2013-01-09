<!-- <script src="<?php echo js_url('resultatRech'); ?>"></script> -->
<center>
		<?php
			if(($affichage==0 || $affichage==1) && !empty($resultat)){ ?>		
		<div id="box"></div>
		<table class="table table-striped table-condensed">
			<caption>
				<?php if($affichage==0) { ?> <h2>Listes des disques</h2> <?php } ?>
				<?php if($affichage==1) { echo count($resultat); ?> résultat(s) trouvé(s).<?php } ?>
			</caption>
			<tr>
				<th><input type="checkbox" onclick="CocheTout(this,'choix[]');" value="1" ></th>
				<th><i class="icon-music"></i> Titre</th>
				<th><i class="icon-user"></i> Artiste</th>
				<th><i class="icon-wrench"></i> Actions</th>
			</tr>
			<tbody id="disque">
				
			<form  method="post" id="tdisqueI" action="#">
			<?php
				$i=0;
				$j=0;
				foreach ($resultat as $ligne) {
					if ($i % 2 == 0)
						echo '<tr class="bis">';
					else	
						echo '<tr>';
							
					echo '<td class="checkbox"><input id="chx'.$j.'" class="chx" type="checkbox" name="choix[]" value="'.$ligne['dis_id'].'"></td>';
					echo '<td class="left" onclick="; }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">'.$ligne['dis_libelle'].'</td>';
					echo '<td onclick="ajaxBox_loader(true);$.get(\''.site_url("index/affichage_disque/".$ligne['dis_id']).'\', function(data) { $(\'#aff-disque\').html(\'\').html(data); }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">'.$ligne['art_nom'].'</td>';
					echo '<td><a class="btn btn-info btn-mini" href="#"><i class="icon-pencil"></a> <a class="btn btn-danger btn-mini" onclick="CocheTout(this,\'choix[]\');CocheTout(this,\'choix[]\');$(\'#chx'.$j.'\').attr(\'checked\',\'checked\');$(\'#tdisque\').attr(\'action\',\''.site_url("disque/supprimer").'\').submit();" href="#"><i class="icon-trash"></a></td>';
					echo '</tr>';
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
				<!-- <?php echo $pagination; ?> -->
			</nav>
			</div>
	<?php }
	}?>
	


		<div class="infos-disque">
			<ul class="icons" <?php if(($affichage==1 && isset($resultat)) || $affichage==0) { ?> id="aff-disque" <?php } ?>>
			</ul>
		</div>
		<div class="form-actions">
			<a id="supprimerI" class="btn btn-large btn-block disabled" href="#"><i class="icon-trash"></i> Supprimer les fiches</a>
			<a id="modifier" class="btn btn-large btn-block disabled" href="#"><i class="icon-share-alt"></i> Modifier les fiches</a>
		</div>
	


