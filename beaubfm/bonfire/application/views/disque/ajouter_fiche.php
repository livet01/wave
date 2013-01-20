<div id="recap">
	
</div>
<div id="Container" style="background: no-repeat 100% 70% url(<?php echo img_url('piledisque.jpg'); ?>);">
	<div class="page-header">
		<h1><?php echo (!empty($infoDisque))? "Modification du disque <small>".$infoDisque['dis_libelle']."</small>" : "Ajout d'un disque" ?></h1>
	</div>
		<form class="form-horizontal ajax-form" method="post" id="fiche" action="<?php echo (!empty($infoDisque))? ((isset($import) && $import)? site_url('enAttente/modifDisquesEnAttente/'.$infoDisque['dis_id']) : site_url("disque/modifier/".$infoDisque['dis_id'])) : site_url("disque/ajouter"); ?>">
		
			<!-- Titre  -->
			<div class="control-group <?php if (form_error('titre')) echo "error";?>">
				<label class="control-label" for="titre"><i class="icon-music"></i> Titre </label>
				<div class="controls">
					<input 
						type="text" 
						id="titre" 
						name="titre" 
						title="Titre obligatoire" 
						value="<?php echo (!empty($infoDisque))? $infoDisque['dis_libelle'] : ((!empty($sauv['titre'])) ? $sauv['titre'] : set_value('titre')); ?>"
						onblur="ArtisteDisqueVerif();">
					<span class="help-inline">
						<span id="dis-help" ></span>
					</span>
					<span class="help-block"><?php echo form_error('titre'); ?></span>
				</div>
			</div>
			
			<!-- Artiste  -->
			<div class="control-group <?php if (form_error('artiste')) echo "error";?>">
				<label class="control-label" for="artiste"><i class="icon-user"></i> Artiste</label>
				<div class="controls">
					<input 
						type="text" 
						id="artiste" 
						name="artiste" 
						title="Artiste obligatoire"  
						value="<?php echo (!empty($infoDisque))? $infoDisque['art_nom'] : ((!empty($sauv['artiste'])) ? $sauv['artiste'] : set_value('artiste')); ?>" 
						onblur="ArtisteChange(); ArtisteDisqueVerif();LabelChange();"> 
					<span class="help-inline">
						<span id="art-help" ></span>
						<span id="art-help2" ></span>
					</span>
					<span class="help-block"><?php echo form_error('artiste'); ?></span>
					
				</div>
			</div>
			<!-- Diffuseur  -->
			<div class="control-group <?php if (form_error('autoprod')) echo "error";?>" >
				<label class="control-label" for="diffuseur"><i class="icon-home"></i> Diffuseur </label>
				<div class="controls" data-toggle="buttons-radio">
					<label class="btn btn-info <?php echo ((isset($_POST['autoprod']) && $_POST['autoprod'] ==='a') || (!empty($infoDisque) && $infoDisque['art_nom'] == $infoDisque['per_nom'])||(!empty($sauv['artiste']) && !empty($sauv['diffuseur']) && $sauv['artiste'] == $sauv['diffuseur'])) ? "active" : ""; ?>" for="autoprod">
							<input 
								style="display:none;" 
								class="check" 
								type="radio" 
								id="autoprod" 
								name="autoprod" 
								value="a" 
								<?php echo ((set_value('autoprod') ==='a') || (!empty($infoDisque) && $infoDisque['art_nom'] == $infoDisque['per_nom'])||(!empty($sauv['artiste']) && !empty($sauv['diffuseur']) && $sauv['artiste'] == $sauv['diffuseur'])) ? "checked=\"checked\"" : ""; ?> 
								onclick="$('#block-label').hide();EmailCheck();LabelChange();" > Auto-Production
					</label>
					<label class="btn btn-info <?php echo ((set_value('autoprod') ==='b') || (!empty($infoDisque) && $infoDisque['art_nom'] != $infoDisque['per_nom'])||(!empty($sauv['artiste']) && !empty($sauv['diffuseur']) && $sauv['artiste'] != $sauv['diffuseur'])) ? "active" : ""; ?>" for="diff">
							<input  style="display:none;" class="check" type="radio" id="diff" name="autoprod" value="b" <?php echo ((isset($_POST['autoprod']) && $_POST['autoprod'] ==='') || (!empty($infoDisque) && $infoDisque['art_nom'] == $infoDisque['per_nom'])||(!empty($sauv['artiste']) && !empty($sauv['diffuseur']) && $sauv['artiste'] == $sauv['diffuseur'])) ? "checked=\"checked\"" : ""; ?> 
							onclick="$('#block-label').show();EmailCheck();LabelChange();" > Label
					</label>
					
					<span class="help-block"><?php echo form_error('autoprod'); ?></span>
				</div>
			</div>
			<!-- Label  -->
			<div id="block-label" class="control-group <?php if (form_error('diffuseur')) echo "error";?>" <?php if (!form_error('diffuseur') && !((set_value('autoprod') ==='b') || (!empty($infoDisque) && $infoDisque['art_nom'] != $infoDisque['per_nom'])||(!empty($sauv['artiste']) && !empty($sauv['diffuseur']) && $sauv['artiste'] != $sauv['diffuseur']))) { ?>style="display:none;"<?php } ?> >
				<label class="control-label" for="diffuseur"><i class="icon-home"></i> Label </label>
				<div class="controls">
					<input onblur="LabelChange();" type="text" id="diffuseur" name="diffuseur" title="Label obligatoire" value="<?php echo ( (!empty($sauv['diffuseur'])) ? $sauv['diffuseur'] : set_value('diffuseur')); ?>" <?php echo (!empty($infoDisque['per_nom']))? $infoDisque['per_nom'] : ((isset($_POST['autoprod']) && $_POST['autoprod'] ==='a') || (!empty($infoDisque) && $infoDisque['art_nom'] == $infoDisque['per_nom'])||(!empty($sauv['artiste']) && !empty($sauv['diffuseur']) && $sauv['artiste'] == $sauv['diffuseur'])) ? "disabled=\"disabled\"" : ""; ?>  >
					<span class="help-inline">
						<span id="lab-help" ></span>
					</span>
					<span class="help-block"><?php echo form_error('diffuseur'); ?></span>
				</div>
			</div>
			<!-- Email  -->
			<div class="control-group <?php if (form_error('email')) echo "error";?>" id="email-block" style="display:none;">
				<label class="control-label" for="email"><i class="icon-envelope"></i> Email de contact </label>
				<div class="controls">
					<input type="text" id="email" name="email" title="e-mail obligatoire" onblur="verifMail(this)" value="<?php echo (!empty($infoDisque['mail']))? $infoDisque['mail'] : ((!empty($sauv['email'])) ? $sauv['email'] : set_value('email')); ?>">
					<?php if(empty($modifier) || !$modifier) { ?><span class="help-inline">
						<label class="checkbox" for="envoiMail" >
							<input type="checkbox" id="envoiMail" name="envoiMail" value="0" <?php echo ((set_value('envoiMail') === 0) || (!empty($infoDisque['dis_envoi_ok']) && $infoDisque['dis_envoi_ok'] == 1) || (!empty($sauv['envoiMail']) && $infoDisque['envoiMail'] == 1)) ? "checked=\"checked\"" : ""; ?>>
							Envoyer email
						</label>
					</span><?php } ?>
					<span class="help-block"><?php echo form_error('email'); ?></span>
				</div>
			</div>
				
			<!-- Formats  -->
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
									<option value="<?php echo $format ?>" <?php echo ((set_value('format')==$format) || (!empty($sauv['format']) && $sauv['format'] == $format) || (!empty($infoDisque['dis_format']) && $infoDisque['dis_format'] == $format)) ? "selected=\"selected\"" : ""; ?>><?php echo $format ?></option>
									
								<?php } ?>
							</select>	
							<span class="help-block"><?php echo form_error('format'); ?></span>
						</div>
					</div>
				<?php } ?>
				
					<!-- Emplacements  -->
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
						<label 
							class="radio" 
							for="<?php echo 'emp'.$i ?>" 
							onclick="<?php echo ($emplacement['emp_plus']!=='1') ? '$(\'#emb2\').hide(); ' : '$(\'#emb2\').show(); '; echo ($emplacement['emp_plus']==='2') ? '$(\'#block-ecoute\').hide(); ' : '$(\'#block-ecoute\').show(); ';?>" >
						<input 	
							type="radio" 
							name="emplacement" 
							id="<?php echo 'emp'.$i ?>" 
							value="<?php echo $emplacement['emp_libelle'] ?>" 
							<?php echo ((set_value('emplacement') == $emplacement['emp_libelle']) || (!empty($infoDisque['emp_libelle']) && $infoDisque['emp_libelle'] == $emplacement['emp_libelle']) || (!empty($sauv['emplacement']) && $sauv['emplacement'] == $emplacement['emp_libelle']) )? 'checked="checked"' : ''; ?> 
							onclick="<?php echo ($emplacement['emp_plus']!=='1') ? '$(\'#emb2\').hide(); ' : '$(\'#emb2\').show(); '; echo ($emplacement['emp_plus']==='2') ? '$(\'#block-ecoute\').hide(); ' : '$(\'#block-ecoute\').show(); ';?>" >
						<?php echo $emplacement['emp_libelle'] ?>
					</label>
					<?php } ?>				
				<?php } if(form_error('emplacement')) { ?><span class="help-block"><?php echo form_error('emplacement'); ?></span><?php } ?>
					</div>
				</div>
				
				<!-- Emmission bénévole  -->
				<div id="emb2" class="control-group <?php if (form_error('emb')) echo "error";?>" <?php if (!(form_error('emb') || !empty($infoDisque['emb_id']) || !empty($sauv['emb']) || set_value('emb') )) {?> style="display: none;"<?php } ?>>	
					<label class="control-label" for="emb" ><i class="icon-comment"></i> <?php echo $name_emp; ?></label>
					<div class="controls">
						<input type="text" name="emb" id="emb" onblur="EmbChange()" value="<?php echo (!empty($infoDisque['emb_id']))? $infoDisque['emb_id'] : ((!empty($sauv['emb'])) ? $sauv['emb'] : set_value('emb')); ?>">
						<span class="help-inline">
							<span id="emb-help" ></span>
						</span>
						<span class="help-block"><?php echo form_error('emb'); ?></span>
					</div>
				</div>
				<div id="block-ecoute" <?php if(!(form_error('style') || form_error('listenBy') || !empty($infoDisque['mem_nom']) || set_value('listenBy') || !empty($infoDisque['sty_libelle']) || !empty($sauv['listenBy']) || !empty($sauv['style']) || set_value('style') )) { ?>style="display: none;"<?php } ?>>
				<!-- Styles  -->
				<?php if(empty($styles)) {
					throw new Exception("Erreur chargement style");
				}
				else { 
					$i=0;
					?>
					<div class="control-group <?php if (form_error('style')) echo "error";?>">
						<label class="control-label" for="style"><i class="icon-certificate"></i> Style</label>
						<div class="controls" data-toggle="buttons-radio">
							<?php foreach($styles as $style) { $i++; ?>
								<label class="btn <?php echo ((set_value('style') == $style['couleur']) || (!empty($infoDisque['sty_libelle']) && $infoDisque['sty_libelle'] == $style['libelle']) || (!empty($sauv['style']) && $sauv['style'] == $style['couleur']) )? 'active' : ''; ?>"  for="<?php echo $style['couleur'] ?>"><i style="background:<?php echo $style['couleur'] ?>" class="circle"></i> <?php echo $style['libelle'] ?>
									<input type="radio" style="display:none;" name="style" id="<?php echo $style['couleur'] ?>" value="<?php echo $style['couleur'] ?>" <?php echo ((set_value('style') == $style['couleur']) || (!empty($infoDisque['sty_libelle']) && $infoDisque['sty_libelle'] == $style['libelle']) || (!empty($sauv['style']) && $sauv['style'] == $style['couleur']) )? 'checked="checked"' : ''; ?> >
								</label>
					<?php } while($i<4) {
						echo '<br>';
						$i++;
					} ?>	
							<label class="btn rien" for="rien">Aucun
									<input type="radio" name="style" id="rien"  style="display:none;" value=""> 
							</label>
							<span class="help-block"><?php echo form_error('style'); ?></span>
						</div>
					</div>
				<?php } ?>
				
				<!-- Ecouté par  -->
				<div class="control-group <?php if (form_error('listenBy')) echo "error";?>">
					<label class="control-label" for="listenBy"><i class="icon-headphones"></i> Ecouté par </label>
					<div class="controls">
					<input onblur="EcouteChange();" type="text" name="listenBy" id="listenBy" onblur="verifDiffuseur(this)" value="<?php echo (!empty($infoDisque['mem_nom']))? $infoDisque['mem_nom'] : ((!empty($sauv['listenBy'])) ? $sauv['listenBy'] :  set_value('listenBy')); ?>">
						<span class="help-inline">
						<span id="ect-help" ></span>
					</span>
						<span class="help-block"><?php echo form_error('listenBy'); ?></span>
					</div>
				</div>
			</div>
				<!-- Autre  -->
				<?php if(isset($colonnes)) {
					$i=1; 
						foreach($colonnes as $colonne) { ; ?>
									<div class="control-group <?php if (form_error('col'.$i)) echo "error";?>">
										<label class="control-label" for="<?php echo 'col'.$i; ?>"><i class="icon-plus"></i> <?php echo $colonne; ?> </label>
										<div class="controls">
											<input type="text" id="<?php echo 'col'.$i; ?>" name="<?php echo 'col'.$i; ?>"  value="<?php echo (!empty($infoDisque['col'.$i]))? $infoDisque['col'.$i] : ((!empty($sauv['col'.$i])) ? $sauv['col'.$i] : set_value('col'.$i)); ?>">
											<span class="help-block"><?php echo form_error('col'.$i); ?></span>
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