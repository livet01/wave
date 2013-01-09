<div id="Container">
		<?php $cpt = 0while() ;?>
		<h1>Modification d'une fiche en attente <?php $nb = count($disques); echo "1 / $nb" ; ?></h1>
		<form class="form-horizontal" method="post" id="fiche" onsubmit="return verifForm(this)" action="<?php echo (!empty($infoDisque))? site_url("disque/modifier/".$infoDisque['dis_id']) : site_url("disque/ajouter"); ?>">
			<div class="control-group <?php if (form_error('titre')) echo "error";?>">
				<label class="control-label" for="titre"><i class="icon-music"></i> Titre </label>
				<div class="controls">
					<input type="text" id="titre" name="titre" title="Titre obligatoire" value="<?php echo $disques[1]->imp_libelle; ?>">
					<span class="help-inline"><?php echo form_error('titre'); ?></span>
				</div>
			</div>
			<div class="control-group <?php if (form_error('artiste')) echo "error";?>">
				<label class="control-label" for="artiste"><i class="icon-user"></i> Artiste</label>
				<div class="controls">
					<input type="text" id="artiste" name="artiste" title="Artiste obligatoire"  value="<?php echo $imp_artiste; ?>" > <!-- onchange="$('#diffuseur').val($('#artiste').val());" --> 
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
								<?php foreach($formats as $imp_format) { ; ?>
									<option value="<?php echo $imp_format ?>"><?php echo $imp_format ?></option>
									
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
									<input type="radio" name="style" id="<?php echo $style['couleur'] ?>" value="<?php echo $style['couleur'] ?>" <?php echo ($style['couleur'] == $imp_style)? 'checked="checked"' : ''; ?> >
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
						<input type="radio" name="emplacement" id="<?php echo 'emp'.$i ?>" value="<?php echo $emplacement['emp_libelle'] ?>" <?php echo ($emplacement['emp_libelle'] == $imp_emplacement)? 'checked="checked"' : ''; ?> <?php echo ($emplacement['emp_plus']==0) ? 'onclick="$(\'#emb\').hide()"' : 'onclick="$(\'#emb\').show()"'; ?> >
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
							<input type="text" name="emb" id="emb" onblur="verifEmBen(this)" value="<?php echo set_value('emb'); ?>">
						</p>
					</div>
				</div>
				
				<div class="control-group <?php if (form_error('listenBy')) echo "error";?>">
					<label class="control-label" for="listenBy"><i class="icon-headphones"></i> Ecouté par </label>
					<div class="controls">
					<input type="text" name="listenBy" id="listenBy" onblur="verifDiffuseur(this)" value="<?php echo $imp_ecoute; ?>">
						<span class="help-inline"><?php echo form_error('listenBy'); ?></span>
					</div>
				</div>
				
				<div class="control-group <?php if (form_error('diffuseur')) echo "error";?>">
					<label class="control-label" for="diffuseur"><i class="icon-home"></i> Diffuseur </label>
					<div class="controls">
						<input type="text" id="diffuseur" name="diffuseur" title="Label obligatoire" onblur="verifDiffuseur(this)" value="<?php echo $imp_diffuseur; ?>">
						<span class="help-inline"><?php echo form_error('diffuseur'); ?></span>
					</div>
				</div>
				
				<div class="control-group <?php if (form_error('email')) echo "error";?>">
					<label class="control-label" for="email"><i class="icon-envelope"></i> Email de contact </label>
					<div class="controls">
						<input type="text" id="email" name="email" title="e-mail obligatoire" onblur="verifMail(this)" value="<?php echo $imp_email_diffuseur; ?>">
						<span class="help-inline"><?php echo form_error('email'); ?></span>
						<label class="checkbox" for="envoiMail" ><input class="check" type="checkbox" id="envoiMail" name="envoiMail" value="0">Envoyer email</label>
					</div>
				</div>

				<div class="form-actions">
					<a class="btn btn-primary" href="javascript: document.forms['fiche'].submit();"><i class="icon-ok icon-white"></i> Valider </a>
					<a class="btn " href="<?php echo site_url('enAttente/index'); ?>"><i class="icon-repeat"></i> Annuler </a>
				</div>
		</form>
	</div>