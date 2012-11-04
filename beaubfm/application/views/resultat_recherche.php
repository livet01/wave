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
				Résultat de la recherche : 6 résultats trouvés
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
				for ($i = 0; $i < 10; $i++) {
					if ($i % 2 == 0)
						echo '<tr class="blue">';
					else
						echo '<tr>';
					echo '<td><input type="checkbox" name="select" value="1"></td>';
					echo '<td class="left">A ce qu\'il parait</td>';
					echo '<td>Canardo</td>';
					echo '<td>HENIJAI Music</td>';
					echo '<td><a class="action-tab" href="#"><i class="icon-pencil"></a></td>';
					echo '<td><a class="action-tab" href="#"><i class="icon-trash"></a></td>';
					echo '</tr>';
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
