	<?php
	if(!empty($resultat1))
	{
	?>
		<table class="table table-striped table-condensed">
			<caption>
				<div class="page-header">
				<h2>
					Liste des disques en attente de <?php echo $username; ?>
					<?php echo (defined('NBU') && NBU != 0) ? "<span class=\"badge badge-warning\">".NBU."</span>" : ""; ?>
				</h2>
				</div>
			</caption>
			<tr>
				<th><input type="checkbox" onclick="CocheTout(this,'choix[]');" value="1" ></th>
				<th><i class="icon-music"></i> Titre</th>
				<th><i class="icon-user"></i> Artiste</th>
				<th><i class="icon-home"></i> Label</th>
				<th><i class="icon-pencil"></i></th>
				<th><i class="icon-trash"></i></th>
			</tr>
			<tbody id="disque1">
			<?php 
			$i = 0;
			$j = 0;
			foreach ($resultat1 as $ligne) 
			{
				if ($i % 2 == 0)
					echo '<tr class="bis">';
				else
					echo '<tr>';

				echo '<td><input id="chx' . $j . '" class="chx" type="checkbox" name="choix[]" value="' . $ligne['dis_id'] . '"></td>';
				echo '<td class="left" onclick="; }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">' . $ligne['dis_libelle'] . '</td>';
				echo '<td>' . $ligne['art_nom'] . '</td>';
				echo '<td>' . $ligne['per_nom'] . '</td>';
				echo '<td><a class="action-tab" href="' . site_url("enAttente/modifier/" . $ligne['dis_id']) . '"><i class="icon-pencil"></a></td>';
				echo '<td><a class="action-tab" href="' . site_url("enAttente/supprimer/" . $ligne['dis_id']) . '"><i class="icon-trash"></a></td>';
				echo '</tr>';
				$i++;
				$j++;
			}
			?>
			</tbody>
		</table>
		
		<?php
		if(count($resultat1)>15)
		{ 
		?>
		<div class="pagination">
			<nav class="navig_result">
			<div class="holder1"></div>
			</nav>
		</div>
		<?php 
		}
		
		}
		if(!empty($resultat2))
		{
		?>
		<table class="table table-striped table-condensed">
			<caption>
					<h2 style="padding-top: 20px; padding-bottom:10px;">Liste des disques en attente 
					<?php if(defined('NBU') && NBNU != 0) { ?><span class="badge badge-info"><?php echo NBNU; }?></span>
					</h2> 
			</caption>
			<tr>
				<th><?php echo (!empty($resultat1)) ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : "<input type=\"checkbox\" onclick=\"CocheTout(this,'choix[]');\" value=\"1\" >"; ?></th>
				<th><i class="icon-music"></i> Titre</th>
				<th><i class="icon-user"></i> Artiste</th>
				<th><i class="icon-home"></i> Label</th>
				<th><i class="icon-pencil"></i></th>
				<th><i class="icon-trash"></i></th>
			</tr>
			<tbody id="disque2">
				
			<?php //var_dump($resultat2);
			if (empty($resultat1))
				$j = 0;
			$i = 0;
			foreach ($resultat2 as $ligne) {
				if ($i % 2 == 0)
					echo '<tr class="bis">';
				else
					echo '<tr>';

				echo '<td><input id="chx' . $j . '" class="chx" type="checkbox" name="choix[]" value="' . $ligne['dis_id'] . '"></td>';
				echo '<td class="left" onclick="; }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">' . $ligne['dis_libelle'] . '</td>';
				echo '<td>' . $ligne['art_nom'] . '</td>';
				echo '<td>' . $ligne['per_nom'] . '</td>';
				echo '<td><a class="action-tab" href="' . site_url("enAttente/modifier/" . $ligne['dis_id']) . '"><i class="icon-pencil"></a></td>';
				echo '<td><a class="action-tab" href="' . site_url("enAttente/supprimer/" . $ligne['dis_id']) . '"><i class="icon-trash"></a></td>';
				echo '</tr>';
				$i++;
				$j++;
			}
			?>
				
			</tbody>
		</table>
		
		<?php if(count($resultat2)>15)
		{ 
		?>
			<div class="pagination">
				<nav class="navig_result">
					<div class="holder2"></div>
				</nav>
			</div>
		<?php
		}
		}
		?>
<script type="text/javascript" src="<?php echo js_url('cocheTout'); ?>"></script>
<script>
	jQuery(function($){
	
	$(".holder1").jPages({
		containerID : "disque1",
		previous : "←",
		next : "→",
		perPage : 16,
		delay : 10
	});
	
	$(".holder2").jPages({
		containerID : "disque2",
		previous : "←",
		next : "→",
		perPage : 16,
		delay : 10
	});
});
</script>

	<div class="form-actions">
		<span id="supprimerI"><a class="btn disabled" href="#"><i class="icon-trash"></i>Supprimer les fiches</a></span>
	</div>