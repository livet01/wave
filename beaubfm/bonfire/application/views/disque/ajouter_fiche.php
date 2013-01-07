<?php 

if(!empty($reussi)) {
	?>
<div id="cadre">
	<p class="success">
		<i class="icon-ok-sign"></i><?php echo $reussi; ?>
	</p>
</div>
	<?
} 
if(!empty($erreur)) {
	?>
<div id="cadre">
	<p class="error">
		<i class="icon-remove-sign"></i><?php echo $erreur; ?>
	</p>
</div>
	<?php
} ?>
<div id="cadre2">
	<div id="cadre_action">
		<a class="btn-large-action" href="javascript: document.forms['fiche'].reset();"><i class="icon-undo"></i> Annuler </a>
		<a class="btn-large-action" href="javascript: document.forms['fiche'].submit();"><i class="icon-ok"></i> Valider </a>
	</div>
	<div id="resultat_recherche">
	<h1>Ajout d'une fiche</h1>

	<div id="formulaire">
		<form  method="post" id="fiche" onsubmit="return verifForm(this)" action="<?php echo site_url("disque/ajouter"); ?>">
			<div id="gauche">
				
				<p>
					
					<!-- Message d'erreur -->
					<label class="mesgErr"><i class=<?php if (form_error('titre')) echo "icon-remove-sign";?>></i><?php echo form_error('titre'); ?></label>
					
					<label class="labelGauche" for="titre"><i class="icon-music"></i> Titre </label>
					<input type="text" id="titre" name="titre" title="Titre obligatoire" value="<?php echo set_value('titre'); ?>">
				</p>
				<p>
					<!-- Message d'erreur -->
					<label class="mesgErr"><i class=<?php if (form_error('artiste')) echo "icon-remove-sign";?>></i><?php echo form_error('artiste'); ?></label>
					
					<label class="labelGauche" for="artiste"><i class="icon-group"></i> Artiste</label>
					<input type="text" id="artiste" name="artiste" title="Artiste obligatoire"  value="<?php echo set_value('artiste'); ?>" > <!-- onchange="$('#diffuseur').val($('#artiste').val());" --> 
					<input class="check" type="checkbox" id="autoprod" name="autoprod" value="a" onclick="GereControle('autoprod', 'diffuseur', 0)" >
					<label class="labelCheck" for="autoprod">Auto-Production</label>
				</p>
				<?php if(empty($formats)) {
					throw new Exception("Erreur chargement format");
				}
				else { 
					?>
				<p>
					<label class="labelGauche" for="format"><i class="icon-file"></i> Format</label>
					<select name="format">
					<?php foreach($formats as $format) { ; ?>
						
						<option value="<?php echo $format ?>"><?php echo $format ?></option>
						
					<?php } ?>
					</select>	
				</p>
				<?php } ?>
				
				<?php if(empty($styles)) {
					throw new Exception("Erreur chargement style");
				}
				else { 
					$i=0;
					?>
				<p>
					<label class="labelGaucheEmplacement" for="style"><i class="icon-certificate"></i> Style</label>
					<?php foreach($styles as $style) { $i++; ?>
					<input type="radio" name="style" id="<?php echo $style['couleur'] ?>" value="<?php echo $style['couleur'] ?>" <?php echo ($i==1)? 'checked="checked"' : ''; ?> >
					<label class="check <?php echo $style['couleur'] ?>" for="<?php echo $style['couleur'] ?>"><?php echo $style['libelle'] ?></label>
					<br>
					<?php } while($i<4) {
						echo '<br>';
						$i++;
					} ?>	
				</p>
				<?php } ?>
				<?php if(empty($emplacements)) {
					throw new Exception("Erreur chargement emplacement");
				}
				else { 
					$i=0;
					?>
				<p>
					<label class="labelGaucheEmplacement" for="emplacement"><i class="icon-hdd"></i> Emplacement </label>
					<?php foreach($emplacements as $emplacement) { $i++; ?>
					<input type="radio" name="emplacement" id="<?php echo 'emp'.$i ?>" value="<?php echo $emplacement['emp_libelle'] ?>" <?php echo ($i==1)? 'checked="checked"' : ''; ?> <?php echo ($emplacement['emp_plus']==0) ? 'onclick="$(\'#emb\').hide()"' : 'onclick="$(\'#emb\').show()"'; ?> >
					<label class="check" for="<?php echo 'emp'.$i ?>"  <?php echo ($emplacement['emp_plus']==0) ? 'onclick="$(\'#emb\').hide()"' : 'onclick="$(\'#emb\').show()"'; ?>><?php echo $emplacement['emp_libelle'] ?></label>
					<br>
					<?php } while($i<4) {
						echo '<br>';
						$i++;
					} ?>	
				</p>
				<?php } ?>
				<p id="emb" style="display: none;">
					<!-- Message d'erreur -->
					<label class="mesgErr"><i class=<?php if (form_error('emBev')) echo "icon-remove-sign";?>></i><?php echo form_error('emBev'); ?></label>
					
					<label class="labelGauche" for="emb"><i class="icon-comments"></i> Emission Bénévole </label>
					<input type="text" name="emb" id="emb" onblur="verifEmBen(this)" value="<?php echo set_value('emb'); ?>">
				</p>
				
				<p>
					<!-- Message d'erreur -->
					<label class="mesgErr"><i class=<?php if (form_error('listenBy')) echo "icon-remove-sign";?>></i><?php echo form_error('listenBy'); ?></label>
					
					<label class="labelGauche" for="listenBy"><i class="icon-headphones"></i> Ecouté par </label>
					<input type="text" name="listenBy" id="listenBy" onblur="verifDiffuseur(this)" value="<?php echo set_value('listenBy'); ?>">
				</p>
				<p>			
					<!-- Message d'erreur --> 
					<label class="mesgErr"><i class=<?php if (form_error('diffuseur')) echo "icon-remove-sign";?>></i><?php echo form_error('diffuseur'); ?></label>
					
					<label class="labelGauche" for="diffuseur"><i class="icon-home"></i> Diffuseur </label>
					<input type="text" id="diffuseur" name="diffuseur" title="Label obligatoire" onblur="verifDiffuseur(this)" value="<?php echo set_value('diffuseur'); ?>">
				</p>
				<p>
					<!-- Message d'erreur --> 
					<label class="mesgErr"><i class=<?php if (form_error('email')) echo "icon-remove-sign";?>></i><?php echo form_error('email'); ?></label>
					
					<label class="labelGauche" for="email"><i class="icon-envelope-alt"></i> Email de contact </label>
					<input type="text" id="email" name="email" title="e-mail obligatoire" onblur="verifMail(this)" value="<?php echo set_value('email'); ?>">
					<input class="check" type="checkbox" id="envoiMail" name="envoiMail" value="0">
					<label class="labelCheck" for="envoiMail" >Envoyer email</label>
				</p>
			</div>
		</form>
		</div>
	</div>
</div>