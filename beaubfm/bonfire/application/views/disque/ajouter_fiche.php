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
<div id="Container">
	<div id="cadre_action">
		<a class="btn-large-action" href="javascript: document.forms['fiche'].reset();"><i class="icon-undo"></i> Annuler </a>
		<a class="btn-large-action" href="javascript: document.forms['fiche'].submit();"><i class="icon-ok"></i> Valider </a>
	</div>
	<div id="resultat_recherche">
	<h1>Ajout d'une fiche</h1>

	<div id="formulaire">
		<form class="form-horizontal" method="post" id="fiche" onsubmit="return verifForm(this)" action="<?php echo site_url("disque/ajouter"); ?>">
			
			<div class="control-group <?php if (form_error('titre')) echo "error";?>">
				<label class="control-label" for="titre"><i class="icon-music"></i> Titre </label>
				<div class="controls">
					<input type="text" id="titre" name="titre" title="Titre obligatoire" value="<?php echo set_value('titre'); ?>">
					<span class="help-inline"><?php echo form_error('titre'); ?></span>
				</div>
			</div>
			<div class="control-group <?php if (form_error('artiste')) echo "error";?>">
				<label class="control-label" for="artiste"><i class="icon-group"></i> Artiste</label>
				<div class="controls">
					<input type="text" id="artiste" name="artiste" title="Artiste obligatoire"  value="<?php echo set_value('artiste'); ?>" > <!-- onchange="$('#diffuseur').val($('#artiste').val());" --> 
					<span class="help-inline"><?php echo form_error('artiste'); ?></span>
				</div>
				<div class="controls">
					<label class="checkbox" for="autoprod"><input class="check" type="checkbox" id="autoprod" name="autoprod" value="a" onclick="GereControle('autoprod', 'diffuseur', 0)" > Auto-Production</label>
				</div>
			</div>
					
					
					
				
				<?php if(empty($formats)) {
					throw new Exception("Erreur chargement format");
				}
				else { 
					?>
					<div class="control-group <?php if (form_error('format')) echo "error";?>">
						<label class="control-label" for="format"><i class="icon-file"></i> Format</label>
						<div class="controls">
							<select name="format">
								<?php foreach($formats as $format) { ; ?>
									<option value="<?php echo $format ?>"><?php echo $format ?></option>
									
								<?php } ?>
							</select>	
						</div>
					</div>
				<?php } ?>
				
				<?php if(empty($styles)) {
					throw new Exception("Erreur chargement style");
				}
				else { 
					$i=0;
					?>
					<div class="control-group <?php if (form_error('style')) echo "error";?>">
						<label class="control-label" for="style"><i class="icon-certificate"></i> Style</label>
						<div class="controls">
							<?php foreach($styles as $style) { $i++; ?>
								<label class="radio <?php echo $style['couleur'] ?>" for="<?php echo $style['couleur'] ?>"><?php echo $style['libelle'] ?>
									<input type="radio" name="style" id="<?php echo $style['couleur'] ?>" value="<?php echo $style['couleur'] ?>" <?php echo ($i==1)? 'checked="checked"' : ''; ?> >
								</label>
					<?php } while($i<4) {
						echo '<br>';
						$i++;
					} ?>	
						</div>
					</div>
				<?php } ?>
				
				<div class="control-group <?php if (form_error('emplacement')) echo "error";?>">
					<label class="control-label" for="emplacement"><i class="icon-hdd"></i> Emplacement </label>
					<div class="controls">
				<?php if(empty($emplacements)) {
					throw new Exception("Erreur chargement emplacement");
				}
				else { 
					$i=0;
					?>
					<?php foreach($emplacements as $emplacement) { $i++; ?>
					<label class="radio" for="<?php echo 'emp'.$i ?>"  <?php echo ($emplacement['emp_plus']==0) ? 'onclick="$(\'#emb\').hide()"' : 'onclick="$(\'#emb\').show()"'; ?>>
						<input type="radio" name="emplacement" id="<?php echo 'emp'.$i ?>" value="<?php echo $emplacement['emp_libelle'] ?>" <?php echo ($i==1)? 'checked="checked"' : ''; ?> <?php echo ($emplacement['emp_plus']==0) ? 'onclick="$(\'#emb\').hide()"' : 'onclick="$(\'#emb\').show()"'; ?> >
						<?php echo $emplacement['emp_libelle'] ?>
					</label>
					<?php } while($i<4) {
						echo '<br>';
						$i++;
					} ?>	
				
				<?php } ?>
					</div>
					<div class="controls">
						<p id="emb" style="display: none;">
							<!-- Message d'erreur -->
							<label class="mesgErr"><i class=<?php if (form_error('emBev')) echo "icon-remove-sign";?>></i><?php echo form_error('emBev'); ?></label>
							
							<label class="labelGauche" for="emb"><i class="icon-comments"></i> Emission Bénévole </label>
							<input type="text" name="emb" id="emb" onblur="verifEmBen(this)" value="<?php echo set_value('emb'); ?>">
						</p>
					</div>
				</div>
				
				<div class="control-group <?php if (form_error('listenBy')) echo "error";?>">
					<label class="control-label" for="listenBy"><i class="icon-headphones"></i> Ecouté par </label>
					<div class="controls">
					<input type="text" name="listenBy" id="listenBy" onblur="verifDiffuseur(this)" value="<?php echo set_value('listenBy'); ?>">
						<span class="help-inline"><?php echo form_error('listenBy'); ?></span>
					</div>
				</div>
				
				<div class="control-group <?php if (form_error('diffuseur')) echo "error";?>">
					<label class="control-label" for="diffuseur"><i class="icon-home"></i> Diffuseur </label>
					<div class="controls">
						<input type="text" id="diffuseur" name="diffuseur" title="Label obligatoire" onblur="verifDiffuseur(this)" value="<?php echo set_value('diffuseur'); ?>">
						<span class="help-inline"><?php echo form_error('diffuseur'); ?></span>
					</div>
				</div>
				
				<div class="control-group <?php if (form_error('listenBy')) echo "error";?>">
					<label class="control-label" for="email"><i class="icon-envelope-alt"></i> Email de contact </label>
					<div class="controls">
						<input type="text" id="email" name="email" title="e-mail obligatoire" onblur="verifMail(this)" value="<?php echo set_value('email'); ?>">
						<span class="help-inline"><?php echo form_error('email'); ?></span>
						<label class="checkbox" for="envoiMail" ><input class="check" type="checkbox" id="envoiMail" name="envoiMail" value="0">Envoyer email</label>
					</div>
				</div>
				

					
					
				</p>
			</div>
		</form>
		</div>
	</div>
</div>