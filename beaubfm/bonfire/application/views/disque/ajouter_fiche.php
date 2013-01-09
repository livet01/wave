<div id="Container">
		<h1><?php echo (!empty($infoDisque))? "Modification du disque ".$infoDisque['dis_libelle'] : "Ajout d'un disque" ?></h1>
		<form class="form-horizontal" method="post" id="fiche" action="<?php echo (!empty($infoDisque))? ((isset($import) && $import)? site_url('enAttente/modifDisquesEnAttente/'.$infoDisque['dis_id']) : site_url("disque/modifier/".$infoDisque['dis_id'])) : site_url("disque/ajouter"); ?>">
			<div class="control-group <?php if (form_error('titre')) echo "error";?>">
				<label class="control-label" for="titre"><i class="icon-music"></i> Titre </label>
				<div class="controls">
					<input type="text" id="titre" name="titre" title="Titre obligatoire" value="<?php echo (!empty($infoDisque))? $infoDisque['dis_libelle'] : ((!empty($sauv['titre'])) ? $sauv['titre'] : set_value('titre')); ?>">
					<span class="help-inline"><?php echo form_error('titre'); ?></span>
				</div>
			</div>
			<div class="control-group <?php if (form_error('artiste')) echo "error";?>">
				<label class="control-label" for="artiste"><i class="icon-user"></i> Artiste</label>
				<div class="controls">
					<input type="text" id="artiste" name="artiste" title="Artiste obligatoire"  value="<?php echo (!empty($infoDisque))? $infoDisque['art_nom'] : ((!empty($sauv['artiste'])) ? $sauv['artiste'] : set_value('artiste')); ?>" > <!-- onchange="$('#diffuseur').val($('#artiste').val());" --> 
					<span class="help-inline"><?php echo form_error('artiste'); ?></span>
				</div>
				<div class="controls">
					<label class="checkbox" for="autoprod"><input class="check" type="checkbox" id="autoprod" name="autoprod" value="a" <?php echo ((!empty($infoDisque) && $infoDisque['art_nom'] == $infoDisque['per_nom'])||(!empty($sauv['artiste']) && !empty($sauv['diffuseur']) && $sauv['artiste'] == $sauv['diffuseur'])) ? "checked=\"checked\"" : ""; ?> onclick="GereControle('autoprod', 'diffuseur', 0)" > Auto-Production</label>
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
									<option value="<?php echo $format ?>" <?php echo ((!empty($sauv['format']) && $sauv['format'] == $format) || (!empty($infoDisque['dis_format']) && $infoDisque['dis_format'] == $format)) ? "selected=\"selected\"" : ""; ?>><?php echo $format ?></option>
									
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
									<input type="radio" name="style" id="<?php echo $style['couleur'] ?>" value="<?php echo $style['couleur'] ?>" <?php echo ((!empty($infoDisque['sty_libelle']) && $infoDisque['sty_libelle'] == $style['libelle']) || (!empty($sauv['style']) && $sauv['style'] == $style['couleur']) )? 'checked="checked"' : ''; ?> >
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
					<?php foreach($emplacements as $emplacement) { $i++; if($emplacement['emp_plus']==1) { $name_emp = $emplacement['emp_libelle']; } ?>
					<label class="radio" for="<?php echo 'emp'.$i ?>"  <?php echo ($emplacement['emp_plus']==0) ? 'onclick="$(\'#emb\').hide()"' : 'onclick="$(\'#emb\').show()"'; ?>>
						<input type="radio" name="emplacement" id="<?php echo 'emp'.$i ?>" value="<?php echo $emplacement['emp_libelle'] ?>" <?php echo ((!empty($infoDisque['emp_libelle']) && $infoDisque['emp_libelle'] == $emplacement['emp_libelle']) || (!empty($sauv['emplacement']) && $sauv['emplacement'] == $emplacement['emp_libelle']) )? 'checked="checked"' : ''; ?> <?php echo ($emplacement['emp_plus']==0) ? 'onclick="$(\'#emb\').hide()"' : 'onclick="$(\'#emb\').show()"'; ?> >
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
							
							<label class="labelGauche" for="emb"><i class="icon-comments"></i><?php echo $name_emp; ?></label>
							<input type="text" name="emb" id="emb" onblur="verifEmBen(this)" value="<?php echo (!empty($infoDisque['emb_id']))? $infoDisque['emb_id'] : ((!empty($sauv['emb'])) ? $sauv['emb'] : set_value('emb')); ?>">
						</p>
					</div>
				</div>
				
				<div class="control-group <?php if (form_error('listenBy')) echo "error";?>">
					<label class="control-label" for="listenBy"><i class="icon-headphones"></i> Ecouté par </label>
					<div class="controls">
					<input type="text" name="listenBy" id="listenBy" onblur="verifDiffuseur(this)" value="<?php echo (!empty($infoDisque['mem_nom']))? $infoDisque['mem_nom'] : ((!empty($sauv['listenBy'])) ? $sauv['listenBy'] :  set_value('listenBy')); ?>">
						<span class="help-inline"><?php echo form_error('listenBy'); ?></span>
					</div>
				</div>
				
				<div class="control-group <?php if (form_error('diffuseur')) echo "error";?>">
					<label class="control-label" for="diffuseur"><i class="icon-home"></i> Diffuseur </label>
					<div class="controls">
						<input type="text" id="diffuseur" name="diffuseur" title="Label obligatoire" onblur="verifDiffuseur(this)" value="<?php echo (!empty($infoDisque['per_nom']))? $infoDisque['per_nom'] : ((!empty($sauv['diffuseur'])) ? $sauv['diffuseur'] : set_value('diffuseur')); ?>">
						<span class="help-inline"><?php echo form_error('diffuseur'); ?></span>
					</div>
				</div>
				
				<div class="control-group <?php if (form_error('email')) echo "error";?>">
					<label class="control-label" for="email"><i class="icon-envelope"></i> Email de contact </label>
					<div class="controls">
						<input type="text" id="email" name="email" title="e-mail obligatoire" onblur="verifMail(this)" value="<?php echo (!empty($infoDisque['mail']))? $infoDisque['mail'] : ((!empty($sauv['email'])) ? $sauv['email'] : set_value('email')); ?>">
						<span class="help-inline"><?php echo form_error('email'); ?></span>
						<label class="checkbox" for="envoiMail" ><input class="check" type="checkbox" id="envoiMail" name="envoiMail" value="0" <?php echo ((!empty($infoDisque['dis_envoi_ok']) && $infoDisque['dis_envoi_ok'] == 1) || (!empty($sauv['envoiMail']) && $infoDisque['envoiMail'] == 1)) ? "checked=\"checked\"" : ""; ?>>Envoyer email</label>
					</div>
				</div>

				<?php if(isset($colonnes)) {
					$i=1; 
						foreach($colonnes as $colonne) { ; ?>
									<div class="control-group <?php if (form_error('col'.$i)) echo "error";?>">
										<label class="control-label" for="<?php echo 'col'.$i; ?>"><i class="icon-plus"></i> <?php echo $colonne; ?> </label>
										<div class="controls">
											<input type="text" id="<?php echo 'col'.$i; ?>" name="<?php echo 'col'.$i; ?>"  value="<?php echo (!empty($infoDisque['col'.$i]))? $infoDisque['col'.$i] : ((!empty($sauv['col'.$i])) ? $sauv['col'.$i] : set_value('col'.$i)); ?>">
											<span class="help-inline"><?php echo form_error('col'.$i); ?></span>
										</div>
									</div>
								<?php $i++; } ?>
				
				
				<?php } ?>

				<div class="form-actions">
					<a class="btn btn-primary" href="javascript: document.forms['fiche'].submit();"><i class="icon-ok icon-white"></i> Valider </a>
					<a class="btn " href="<?php echo site_url('index'); ?>"><i class="icon-repeat"></i> Annuler </a>
					<?php if(empty($infoDisque)) { ?><a class="btn" id="sauvegarder-btn" href="#"><i class="icon-download-alt"></i> Sauvegarder et finir ultérieurement </a><?php } ?>
					<?php if(empty($infoDisque) && !empty($sauv)) { ?><a class="btn" href="<?php echo site_url("disque/supprimer_sauvegarde") ?>"><i class="icon-trash"></i> Supprimer la sauvegarde </a><?php } ?>
				</div>
		</form>
	</div>