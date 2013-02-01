<form  method="post" id="<?php echo $form_id; ?>" action="#">
	<table class="table table-striped table-condensed">
			<caption>
				<div class="page-header">
				<h2><?php echo count($resultat); ?> disque(s) sélectionné(s).</h2>
				</div>
			</caption>
			<tr>
				<th><i class="icon-music"></i>Titre</th>
				<th><i class="icon-user"></i>Artiste</th>
				<th><i class="icon-home"></i>Label</th>
			</tr>
			<tbody id="disque">
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
					echo '</tr>';
					$i++;
					$j++;
				}
			?>
			</tbody>
	</table>
</form>
		<?php if(count($resultat)>15){ ?>
			<center>
				<div class="pagination">
					<ul class="holder"></ul>
				</div>
			</center>
		<?php } ?>
<div class="form-actions">
		<?php
			foreach ($liens as $lien) {
			?>
				<a class="btn" href="<?php echo $lien['href']; ?>">
					<span <?php echo (!empty($lien['id'])) ?  'id="'.$lien['id'].'"' : ''; ?>>
						<i class="<?php echo $lien['icon']; ?>"></i><?php echo $lien['text']; ?>
					</span>
				</a>
			<?php
			}
		?>
</div>
