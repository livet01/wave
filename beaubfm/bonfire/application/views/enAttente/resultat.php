<!-- <script src="<?php echo js_url('resultatRech'); ?>"></script> -->
<center>
			
		<div id="box"></div>
		
		<form  method="post" id="tdisqueI" action="#">
		
		<?php
			if(($affichage==0 || $affichage==1) && !empty($resultat1)){ ?>	
		
		<table class="table table-striped table-condensed">
			<caption>
				<?php if($affichage==0) { ?> <h2>Listes des disques en attente de <?php echo $username; ?><?php if(defined('NBU') && NBU != 0) { ?><span class="badge badge-important"><?php echo NBU; ?></span> <?php } ?></h2> <?php } ?>
			</caption>
			<tr>
				<th><input type="checkbox" onclick="CocheTout(this,'choix[]');" value="1" ></th>
				<th><i class="icon-music"></i> Titre</th>
				<th><i class="icon-user"></i> Artiste</th>
				<th><i class="icon-home"></i> Label</th>
				<th><i class="icon-wrench"></i> Actions</th>
			</tr>
			<tbody id="disque1">
			
			<?php
				$i=0;
				$j=0;
				foreach ($resultat1 as $ligne) {
					if ($i % 2 == 0)
						echo '<tr class="bis">';
					else	
						echo '<tr>';
							
					echo '<td class="checkbox"><input id="chx'.$j.'" class="chx" type="checkbox" name="choix[]" value="'.$ligne['dis_id'].'"></td>';
					echo '<td class="left" onclick="; }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">'.$ligne['dis_libelle'].'</td>';
					echo '<td>'.$ligne['art_nom'].'</td>';
					echo '<td>'.$ligne['per_nom'].'</td>';
					echo '<td><a class="btn btn-info btn-mini" href="'.site_url("enAttente/modifDisquesEnAttente/".$ligne['dis_id']).'"><i class="icon-pencil"></a> 
						<a class="btn btn-danger btn-mini" href="'.site_url("enAttente/supprimmerDisquesEnAttente/".$ligne['dis_id']).'"><i class="icon-trash"></a></td>';
					echo '</tr>';
					$i++;
					$j++;
				}
			?>
				
			</tbody>
		</table>
		<?php if(count($resultat1)>15){ ?>
			<div class="pagination">
				<nav class="navig_result">
				<div class="holder1"></div>
				</nav>
			</div>
		
	<?php }
	}
		if(($affichage==0 || $affichage==1) && !empty($resultat2)){
		
	?>
		<table class="table table-striped table-condensed">
			<caption>
				<?php if($affichage==0) { ?> <h2>Listes des disques en attente</h2> <?php } ?>
			</caption>
			<tr>
				<th><?php echo (!empty($resultat1)) ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : "<input type=\"checkbox\" onclick=\"CocheTout(this,'choix[]');\" value=\"1\" >"; ?></th>
				<th><i class="icon-music"></i> Titre</th>
				<th><i class="icon-user"></i> Artiste</th>
				<th><i class="icon-home"></i> Label</th>
				<th><i class="icon-wrench"></i> Actions</th>
			</tr>
			<tbody id="disque2">
				
			<?php
				//var_dump($resultat2);
				if(empty($resultat1))
					$j= 0;
				$i=0;
				foreach ($resultat2 as $ligne) {
					if ($i % 2 == 0)
						echo '<tr class="bis">';
					else	
						echo '<tr>';
							
					echo '<td class="checkbox"><input id="chx'.$j.'" class="chx" type="checkbox" name="choix[]" value="'.$ligne['dis_id'].'"></td>';
					echo '<td class="left" onclick="; }).complete(function(){ajaxBox_loader(false);}).error(function(){ajaxBox_setText(\'Error...\');});">'.$ligne['dis_libelle'].'</td>';
					echo '<td>'.$ligne['art_nom'].'</td>';
					echo '<td>'.$ligne['per_nom'].'</td>';
					echo '<td><a class="btn btn-info btn-mini" href="'.site_url("enAttente/modifDisquesEnAttente/".$ligne['dis_id']).'"><i class="icon-pencil"></a> 
						<a class="btn btn-danger btn-mini" href="'.site_url("enAttente/supprimmerDisquesEnAttente/".$ligne['dis_id']).'"><i class="icon-trash"></a></td>';
					echo '</tr>';
					$i++;
					$j++;
				}
			?>
				
			</tbody>
		</table>
		
		</form>
		<?php if(count($resultat2)>15){ ?>
			<div class="pagination">
				<nav class="navig_result">
				<div class="holder2"></div>
			</nav>
			</div>
	<?php
		}
	}
	?>
	


		<div class="infos-disque">
			<ul class="icons" <?php if(($affichage==1 && isset($resultat)) || $affichage==0) { ?> id="aff-disque" <?php } ?>>
			</ul>
		</div>
		<div class="form-actions">
			<a id="supprimerI" class="btn btn-large btn-block disabled" href="#"><i class="icon-trash"></i> Supprimer les fiches</a>
		</div>
	


