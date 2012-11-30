<div id="cadre2">
	<div id="selection">
		<div class="infos-disque">
			<ul class="icons" id="aff-disque">
				<li>&nbsp;</li>
				<li>&nbsp;</li>
				<li id="chargement" class="chargement"><img src="<?php echo img_url('search.png'); ?>"> </li>
				<li>&nbsp;</li>
				<li>&nbsp;</li>
			</ul>
		</div>
		<div id="cadre_action">
			<a id="supprAll" class="btn-large-action" href="#"><i class="icon-download-alt"></i> Tout supprimer</a>
			<a class="btn-large-action" href="<?php echo site_url("index"); ?>"><i class="icon-undo"></i> Annuler</a>
		</div>
	</div>
	<div id="resultat_recherche">
		
		<table>
			<caption>
				<?php echo count($resultat); ?> disque(s) sélectionné(s).
			</caption>
			<tr>
				<th><i class="icon-music"></i> Titre</th>
				<th><i class="icon-group"></i> Artiste</th>
				<th><i class="icon-home"></i> Label</th>
				<th class="tab-menu-action" colspan="2"><i class="icon-cogs"></i></th>
			</tr>
			<tbody id="disque">
			<form  method="post" id="supprimerdisque" action="#">
			<?php
				$i=0;
				$j=0;
				foreach ($resultat as $ligne) {
					if ($i % 2 == 0)
						echo '<tr class="blue">';
					else
						echo '<tr>';
					echo '<input type="hidden" name="choix[]" value="'.$ligne['dis_id'].'" >';
					echo '<td class="left" onclick="ajaxBox_loader(true);$.get(\''.site_url("index/affichage_disque/".$ligne['dis_id']).'\', function(data) { $(\'#aff-disque\').html(\'\').html(data); }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">'.$ligne['dis_libelle'].'</td>';
					echo '<td onclick="ajaxBox_loader(true);$.get(\''.site_url("index/affichage_disque/".$ligne['dis_id']).'\', function(data) { $(\'#aff-disque\').html(\'\').html(data); }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">'.$ligne['art_nom'].'</td>';
					echo '<td onclick="ajaxBox_loader(true);$.get(\''.site_url("index/affichage_disque/".$ligne['dis_id']).'\', function(data) { $(\'#aff-disque\').html(\'\').html(data); }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">'.$ligne['per_nom'].'</td>';
					echo '<td><a class="action-tab" href="#"><i class="icon-pencil"></a></td>';
					echo '<td><a class="action-tab" href="#"><i class="icon-trash"></a></td>';
					echo '</tr>';
					$i++;
					$j++;
				}
			?>
			</form>
			</tbody>
		</table>
		<?php if(count($resultat)>15){ ?>
			<nav class="navig_result">
			<div class="holder"></div>
			</nav>
		<?php } ?>
	</div>
</div>