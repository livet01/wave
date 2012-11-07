<?php 
if($affichage != 0)
{
	if($affichage == 1 and isset($resultat))
	{
		?>
<div id="cadre2">
	<div id="selection">
		<ul class="icons">
			<li><i class="icon-music"></i>TitreSelectionné</li>
			<li><i class="icon-group"></i>ArtisteSelectionné</li>
			<li><i class="icon-home"></i>LabelSelectionné</li>
		</ul>

		<div id="cadre_action">
			<!-- 	<a class="btn-large-action-nonActif"><i class="icon-pencil"></i> Modifier la fiche</a> -->
			<a class="btn-large-action-nonActif"><i class="icon-trash"></i> Supprimer les fiches</a>
			<a class="btn-large-action" href="<?php echo base_url().'index.php/welcome/importer/' ;?>"><i class="icon-signin"></i> Importer des fiches</a>
			<a class="btn-large-action" href="#"><i class="icon-signout"></i> Exporter des fiches</a>
		</div>
	</div>
	<div id="resultat_recherche">
		<table>
			<caption>
				Résultat de la recherche : <?php echo count($resultat); ?> résultat(s) trouvé(s).
			</caption>
			<tr>
				<th>
				<input type="checkbox" name="select" value="1">
				</th>
				<th>- <i class="icon-music"></i> Titre -</th>
				<th>- <i class="icon-group"></i> Artiste -</th>
				<th>- <i class="icon-home"></i> Label -</th>
				<th class="tab-menu-action" colspan="2">- <i class="icon-cogs"></i> -</th>

			</tr>
			<?php
				$i=0;
				foreach ($resultat as $ligne) {
					if ($i % 2 == 0)
						echo '<tr class="blue">';
					else
						echo '<tr>';
					echo '<td><input type="checkbox" name="select" value="1"></td>';
					echo '<td class="left">'.$ligne['dis_libelle'].'</td>';
					echo '<td>'.$ligne['art_nom'].'</td>';
					echo '<td>'.$ligne['per_nom'].'</td>';
					echo '<td><a class="action-tab" href="#"><i class="icon-pencil"></a></td>';
					echo '<td><a class="action-tab" href="#"><i class="icon-trash"></a></td>';
					echo '</tr>';
					$i++;
				}
			?>
		</table>
		<nav class="navig_result">
			<a href="#">1</a>
			<a href="#">2</a>
			<a href="#">3</a>
		</nav>
	</div>
</div>
<?php 	}
	elseif($affichage==2) {
			?>
<div id="cadre2">
	<div id="selection">
		<ul class="icons">
			<li>&nbsp;</li>
			<li>Aucune sélection</li>
			<li>&nbsp;</li>
		</ul>
		<div id="cadre_action">
			<!-- 	<a class="btn-large-action-nonActif"><i class="icon-pencil"></i> Modifier la fiche</a> -->
			<a class="btn-large-action-nonActif"><i class="icon-trash"></i> Supprimer les fiches</a>
			<a class="btn-large-action-nonActif"><i class="icon-signin"></i> Importer des fiches</a>
			<a class="btn-large-action-nonActif"><i class="icon-signout"></i> Exporter des fiches</a>
		</div>
	</div>
	<div id="resultat_recherche">
		<p>La recherche n'a renvoyé aucun résultat.</p>
	</div>
</div>

			<?php
		}else{
			?>
<div id="cadre2">
	<div id="selection">
		<ul class="icons">
			<li>&nbsp;</li>
			<li>Aucune sélection</li>
			<li>&nbsp;</li>
		</ul>
		<div id="cadre_action">
			<!-- 	<a class="btn-large-action-nonActif"><i class="icon-pencil"></i> Modifier la fiche</a> -->
			<a class="btn-large-action-nonActif"><i class="icon-trash"></i> Supprimer les fiches</a>
			<a class="btn-large-action-nonActif"><i class="icon-signin"></i> Importer des fiches</a>
			<a class="btn-large-action-nonActif"><i class="icon-signout"></i> Exporter des fiches</a>
		</div>
	</div>
	<div id="resultat_recherche">
		<p>Veuillez saisir au moins une lettre pour faire une recherche.</p>
	</div>
</div>

			<?php
		}
}
else {
	?>
<div id="cadre2">
	<div id="selection">
		<ul class="icons">
			<li>&nbsp;</li>
			<li>Aucune sélection</li>
			<li>&nbsp;</li>
		</ul>
		<div id="cadre_action">
			<!-- 	<a class="btn-large-action-nonActif"><i class="icon-pencil"></i> Modifier la fiche</a> -->
			<a class="btn-large-action-nonActif"><i class="icon-trash"></i> Supprimer les fiches</a>
			<a class="btn-large-action-nonActif"><i class="icon-signin"></i> Importer des fiches</a>
			<a class="btn-large-action-nonActif"><i class="icon-signout"></i> Exporter des fiches</a>
		</div>
	</div>
	<div id="resultat_recherche">
		<p><img style="margin-left:120px;" src="<?php echo img_url('search.png'); ?>"></p>
	</div>
</div>

	<?php
}
