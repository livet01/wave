<?php 
	if(!isset($sauv)) {
		$sauv = array();
	}
	if(!isset($infoDisque)) {
		$infoDisque = array();
	}
	$existance_sauvegarde = array(
	"titre" => !empty($sauv['titre']),
	"artiste" => !empty($sauv['artiste']),
	"diffuseur" => !empty($sauv['diffuseur']) && !empty($sauv['artiste']),
	"label" => !empty($sauv['diffuseur']),
	"email" => !empty($sauv['email']),
	"format" => !empty($sauv['format']),
	"emplacement" => !empty($sauv['emplacement']),
	"emb" => !empty($sauv['emb']),
	"style" => !empty($sauv['style']),
	"ecoute" => !empty($sauv['listenBy']),
	"envoiMail" => !empty($sauv['envoiMail'])
	);
	$valeur_sauvegarde = array(
	"titre" => 'titre',
	"artiste" => 'artiste',
	"diffuseur" => array('diffuseur','artiste'),
	"label" => 'diffuseur',
	"email" => 'email',
	"format" => 'format',
	"emplacement" => 'emplacement',
	"emb" => 'emb',
	"style" => 'style',
	"envoiMail" => 'envoiMail'
	);
	$sauvegarde = array("booleen"=>$existance_sauvegarde, "valeur" => $valeur_sauvegarde);

	$existance_modification = array(
	"titre" => !empty($infoDisque['dis_libelle']),
	"artiste" => !empty($infoDisque['art_nom']),
	"diffuseur" => !empty($infoDisque['art_nom']) && !empty($infoDisque['per_nom']),
	"label" => !empty($infoDisque['per_nom']),
	"email" => !empty($infoDisque['mail']),
	"format" => !empty($infoDisque['dis_format']),
	"emplacement" => !empty($infoDisque['emp_libelle']),
	"emb" => !empty($infoDisque['emb_id']),
	"style" => !empty($infoDisque['sty_couleur']),
	"ecoute" => !empty($infoDisque['mem_nom']),
	"envoiMail" => !empty($infoDisque['dis_envoi_ok'])
	);
	$valeur_modification = array(
	"titre" => 'dis_libelle',
	"artiste" => 'art_nom',
	"diffuseur" => array('art_nom','per_nom'),
	"label" => 'per_nom',
	"email" => 'mail',
	"format" => 'dis_format',
	"emplacement" => 'emp_libelle',
	"emb" => 'emp_libelle',
	"style"=>'sty_couleur',
	"ecoute" => "mem_nom",
	"envoiMail" => 'dis_envoi_ok'
	);
	$modification = array("booleen"=>$existance_modification, "valeur" => $valeur_modification);

	function retourne_valeur_modif($modification,$valeur,$infoDisque) {
		return ( isset( $modification['booleen'][$valeur])) ? (($modification['booleen'][$valeur]) ? $infoDisque[$modification['valeur'][$valeur]] : false) : -1;
	}
	function retourne_valeur_sauv($sauvegarde,$valeur,$sauv) {
		return (isset( $sauvegarde['booleen'][$valeur])) ? (($sauvegarde['booleen'][$valeur]) ? $sauv[$sauvegarde['valeur'][$valeur]] : false) : -1;
	}
	function retourne_valeur_modif_array($modification,$valeur,$infoDisque) {
		return (isset( $modification['booleen'][$valeur])) ? (($modification['booleen'][$valeur]) ?$infoDisque[$modification['valeur'][$valeur][0]] ==  $infoDisque[$modification['valeur'][$valeur][1]] : false) : -1;
	}
	function retourne_valeur_sauv_array($sauvegarde,$valeur,$sauv) {
		return (isset( $sauvegarde['booleen'][$valeur]) ) ? (( $sauvegarde['booleen'][$valeur]) ? $sauv[$sauvegarde['valeur'][$valeur][0]] == $sauv[$sauvegarde['valeur'][$valeur][1]] : false) : -1;
	}
	function value($sauvegarde,$modification,$infoDisque,$sauv,$valeur, $valeur2 = null) {
		$valeur2 = empty($valeur2) ? $valeur : $valeur2;
		return ($modification['booleen'][$valeur]) ? retourne_valeur_modif($modification,$valeur,$infoDisque) : (($sauvegarde['booleen'][$valeur]) ? retourne_valeur_sauv($sauvegarde,$valeur,$sauv)  : set_value($valeur2));
	}
	// Titre
	$value_titre = value($sauvegarde,$modification,$infoDisque,$sauv,'titre');
	$est_erreur_titre = form_error('titre');
	
	// Artiste
	$value_artiste = value($sauvegarde,$modification,$infoDisque,$sauv,'artiste');
	$est_erreur_artiste = form_error('artiste');
	
	// Diffuseur
	function coche_diffuseur($sauvegarde,$modification,$infoDisque,$sauv,$lettre,$affichage) {
		return (set_value('autoprod') === $lettre || (!empty($infoDisque) && (retourne_valeur_modif_array($modification,'diffuseur',$infoDisque) ? "a" : "b") == $lettre) || (!empty($sauv)  && (retourne_valeur_sauv_array($sauvegarde,'diffuseur',$sauv) ? "a" : "b" == $lettre))) ? $affichage : "";
	}
	$est_erreur_diffuseur = form_error('autoprod');
	$active_diffuseur_a = coche_diffuseur($sauvegarde,$modification,$infoDisque,$sauv,'a','active');
	$coche_diffuseur_a = coche_diffuseur($sauvegarde,$modification,$infoDisque,$sauv,'a','checked="checked"');
	$active_diffuseur_b = coche_diffuseur($sauvegarde,$modification,$infoDisque,$sauv,'b','active');
	$coche_diffuseur_b = coche_diffuseur($sauvegarde,$modification,$infoDisque,$sauv,'b','checked="checked"');

	// Label
	$value_label = value($sauvegarde,$modification,$infoDisque,$sauv,'label','diffuseur');
	$est_erreur_label = form_error('diffuseur');
	
	// Mail 
	$est_erreur_email = form_error('email');
	$value_email = value($sauvegarde,$modification,$infoDisque,$sauv,"email");

	// Format
	function coche($sauvegarde,$modification,$infoDisque,$sauv,$valeur,$test,$affichage) {
		return (value($sauvegarde,$modification,$infoDisque,$sauv,$valeur) == $test) ? $affichage : "";
	}
	$est_erreur_format = form_error('format');
	
	// Emplacement
	$est_erreur_emplacement = form_error('emplacement');
	
	// Emission bénévole
	$value_emb = value($sauvegarde,$modification,$infoDisque,$sauv,'emb');
	$est_erreur_emb = form_error('emb');
	
	// Style
	$est_erreur_style = form_error('style');
	
	// Ecouté par
	$value_ecoute = value($sauvegarde,$modification,$infoDisque,$sauv,'ecoute',"listenBy");
?>
<div id="Container" style="background: no-repeat 100% 80% url(<?php echo img_url('piledisque.jpg'); ?>);">
	<div class="page-header">
		<h1><?php echo (!empty($infoDisque))? "Modification du disque <small>".$infoDisque['dis_libelle']."</small>" : "Ajout d'un disque" ?></h1>
	</div>
		<form class="form-horizontal ajax-form" method="post" id="fiche" action="<?php echo (!empty($infoDisque))? ((isset($import) && $import)? site_url('enAttente/modifDisquesEnAttente/'.$infoDisque['dis_id']) : site_url("disque/modifier/".$infoDisque['dis_id'])) : site_url("disque/ajouter"); ?>">
		
			<!-- Titre  -->
			<div class="control-group <?php if ($est_erreur_titre) echo "error";?>">
				<label class="control-label" for="titre"><i class="icon-music"></i> Titre </label>
				<div class="controls">
					<input 
						type="text" 
						id="titre" 
						name="titre" 
						title="Titre obligatoire" 
						value="<?php echo $value_titre; ?>"
						onblur="ArtisteDisqueVerif();">
					<span class="help-inline">
						<span id="dis-help" ></span>
					</span>
					<span class="help-block"><?php echo form_error('titre'); ?></span>
				</div>
			</div>
			
			<!-- Artiste  -->
			<div class="control-group <?php if ($est_erreur_artiste) echo "error";?>">
				<label class="control-label" for="artiste"><i class="icon-user"></i> Artiste</label>
				<div class="controls">
					<input 
						type="text" 
						id="artiste" 
						name="artiste" 
						title="Artiste obligatoire"  
						value="<?php echo $value_artiste; ?>" 
						onblur="ArtisteChange(); ArtisteDisqueVerif();LabelChange();"> 
					<span class="help-inline">
						<span id="art-help" ></span>
						<span id="art-help2"></span>
					</span>
					<span class="help-block"><?php echo form_error('artiste'); ?></span>
					
				</div>
			</div>
			<!-- Diffuseur  -->
			<div class="control-group <?php if ($est_erreur_diffuseur) echo "error";?>" >
				<label class="control-label" for="diffuseur"><i class="icon-home"></i> Diffuseur </label>
				<div class="controls" data-toggle="buttons-radio">
					<label class="btn btn-info <?php echo $active_diffuseur_a; ?>" for="autoprod">
							<input 
								style="display:none;" 
								class="check" 
								type="radio" 
								id="autoprod" 
								name="autoprod" 
								value="a" 
								<?php echo $coche_diffuseur_a; ?> 
								onclick="$('#block-label').hide();LabelChange();" > Auto-Production
					</label>
					<label class="btn btn-info <?php echo $active_diffuseur_b; ?>" for="diff">
							<input  
								style="display:none;" 
								class="check" 
								type="radio" 
								id="diff" 
								name="autoprod" 
								value="b" 
								<?php echo $coche_diffuseur_b; ?> 
								onclick="$('#block-label').show();LabelChange();" > Label
					</label>
					
					<span class="help-block"><?php echo form_error('autoprod'); ?></span>
				</div>
			</div>
			<!-- Label  -->
			<div id="block-label" class="control-group <?php if ($est_erreur_label) echo "error";?>" <?php if (!($est_erreur_label || coche_diffuseur($sauvegarde,$modification,$infoDisque,$sauv,'b',true))) { ?>style="display:none;"<?php } ?> >
				<label class="control-label" for="diffuseur"><i class="icon-home"></i> Label </label>
				<div class="controls">
					<input 
						onblur="LabelChange();" 
						type="text" 
						id="diffuseur" 
						name="diffuseur" 
						title="Label obligatoire" 
						value="<?php echo $value_label; ?>" 
					<span class="help-inline">
						<span id="lab-help" ></span>
					</span>
					<span class="help-block"><?php echo form_error('diffuseur'); ?></span>
				</div>
			</div>
			<!-- Email  -->
			<div class="control-group <?php if ($est_erreur_email) echo "error";?>" id="email-block" <?php if (!($est_erreur_email || coche_diffuseur($sauvegarde,$modification,$infoDisque,$sauv,'b',true) || coche_diffuseur($sauvegarde,$modification,$infoDisque,$sauv,'a',true))) { ?>style="display:none;"<?php } ?>>
				<label class="control-label" for="email"><i class="icon-envelope"></i> Email de contact </label>
				<div class="controls">
					<input 
						type="text" 
						id="email" 
						name="email" 
						title="e-mail obligatoire" 
						value="<?php echo $value_email; ?>">
					<span class="help-block"><?php echo form_error('email'); ?></span>
				</div>
			</div>
				
			<!-- Formats  -->
			<?php if(empty($formats)) {
					throw new Exception("Erreur chargement format");
				}
				else { 
					?>
					<div class="control-group <?php if ($est_erreur_format) echo "error";?>">
						<label class="control-label" for="format"><i class="icon-file"></i> Format</label>
						<div class="controls">
							<select name="format">
								<?php foreach($formats as $format) { ; ?>
									<option 
										value="<?php echo $format ?>" 
										<?php echo coche($sauvegarde,$modification,$infoDisque,$sauv,'format',$format,'selected="selected"'); ?>><?php echo $format ?></option>									
								<?php } ?>
							</select>	
							<span class="help-block"><?php echo form_error('format'); ?></span>
						</div>
					</div>
				<?php } ?>
				
				<!-- Emplacements  -->
				<div class="control-group <?php if ($est_erreur_emplacement) echo "error"; ?>">
					<label class="control-label" for="emplacement"><i class="icon-hdd"></i> Emplacement </label>
					<div class="controls">
				<?php
				 if(empty($emplacements)) {
					throw new Exception("Erreur chargement emplacement");
				}
				else { 
					$i=0;
					?>
					<?php 
						$affichage_emb = false;
						foreach($emplacements as $emplacement) { $i++; 
							$tmp = coche($sauvegarde,$modification,$infoDisque,$sauv,'emplacement',$emplacement['emp_libelle'],'checked = "checked"');
							if($emplacement['emp_plus']==1) {
								 $name_emp = $emplacement['emp_libelle']; 
								if(!empty($tmp))
									$affichage_emb = true;
							} ?>
						<label 
							class="radio" 
							for="<?php echo 'emp'.$i ?>" 
							onclick="$('#apercu-mail').show(); <?php echo ($emplacement['emp_plus']!=='1') ? '$(\'#emb2\').hide(); ' : '$(\'#emb2\').show(); '; echo ($emplacement['emp_plus']==='2') ? '$(\'#block-ecoute\').hide(); ' : '$(\'#block-ecoute\').show(); ';?>" >
						<input 	
							type="radio" 
							name="emplacement" 
							id="<?php echo 'emp'.$i ?>" 
							value="<?php echo $emplacement['emp_libelle'] ?>" 
							<?php echo $tmp; ?> 
							onclick="$('#apercu-mail').show(); <?php echo ($emplacement['emp_plus']!=='1') ? '$(\'#emb2\').hide(); ' : '$(\'#emb2\').show(); '; echo ($emplacement['emp_plus']==='2') ? '$(\'#block-ecoute\').hide(); ' : '$(\'#block-ecoute\').show(); ';?>" >
						<?php echo $emplacement['emp_libelle'] ?>
						</label>
					<?php } ?>				
						<span class="help-block"><?php echo form_error('emplacement'); ?></span>
					<?php } ?>
					</div>
				</div>
				
				<!-- Emmission bénévole  -->
				<div id="emb2" class="control-group <?php if ($est_erreur_emb) echo "error";?>" <?php if (!(!empty($est_erreur_emb) || !empty($value_emb) || $affichage_emb )) {?> style="display: none;"<?php } ?>>	
					<label class="control-label" for="emb" ><i class="icon-comment"></i> <?php echo $name_emp; ?></label>
					<div class="controls">
						<input 
							type="text" 
							name="emb" 
							id="emb" 
							onblur="EmbChange()" 
							value="<?php echo $value_emb; ?>">
						<span class="help-inline">
							<span id="emb-help" ></span>
						</span>
						<span class="help-block"><?php echo form_error('emb'); ?></span>
					</div>
				</div>
				
				<div id="block-ecoute" <?php if(!(form_error('style') || form_error('listenBy') || value($sauvegarde,$modification,$infoDisque,$sauv,'style') || value($sauvegarde,$modification,$infoDisque,$sauv,'emplacement') || !empty($value_ecoute))) { ?>style="display: none;"<?php } ?>>
				<!-- Styles  -->
				<?php if(empty($styles)) {
					throw new Exception("Erreur chargement style");
				}
				else { 
					$i=0;
					?>
					<div class="control-group <?php if ($est_erreur_style) echo "error";?>">
						<label class="control-label" for="style"><i class="icon-certificate"></i> Style</label>
						<div class="controls" data-toggle="buttons-radio">
							<?php foreach($styles as $style) { $i++; ?>
								<label class="btn <?php echo coche($sauvegarde,$modification,$infoDisque,$sauv,"style", $style['couleur'],'active'); ?>"  for="<?php echo $style['couleur'] ?>"><i style="background:<?php echo $style['couleur'] ?>" class="circle"></i> <?php echo $style['libelle'] ?>
									<input 
										type="radio" 
										style="display:none;" 
										name="style"
										value="<?php echo $style['couleur']; ?>"
										id="<?php echo $style['couleur']; ?>"
										<?php echo coche($sauvegarde,$modification,$infoDisque,$sauv,"style", $style['couleur'],'checked="checked"'); ?> >
								</label>
							<?php } ?>	
							<label class="btn rien" for="rien">Aucun
									<input 
										type="radio" 
										name="style" 
										id="rien"  
										style="display:none;" 
										value=""> 
							</label>
							<span class="help-block"><?php echo form_error('style'); ?></span>
						</div>
					</div>
				<?php } ?>
				
				<!-- Ecouté par  -->
				<div class="control-group <?php if (form_error('listenBy')) echo "error";?>">
					<label class="control-label" for="listenBy"><i class="icon-headphones"></i> Ecouté par </label>
					<div class="controls">
						<input 
							onblur="EcouteChange();" 
							type="text" 
							name="listenBy" 
							id="listenBy" 
							value="<?php echo $value_ecoute; ?>">
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
						foreach($colonnes as $colonne) {
							$modification['booleen']['col'.$i] = !empty($infoDisque['col'.$i]);
							$modification['valeur']['col'.$i] = 'col'.$i;
							$sauvegarde['booleen']['col'.$i] = !empty($sauv['col'.$i]);
							$sauvegarde['valeur']['col'.$i] = 'col'.$i;
							; ?>
									<div class="control-group <?php if (form_error('col'.$i)) echo "error";?>">
										<label class="control-label" for="<?php echo 'col'.$i; ?>"><i class="icon-plus"></i> <?php echo $colonne; ?> </label>
										<div class="controls">
											<input 
												type="text" 
												id="<?php echo 'col'.$i; ?>" 
												name="<?php echo 'col'.$i; ?>"  
												value="<?php echo value($sauvegarde,$modification,$infoDisque,$sauv,'col'.$i); ?>">
											<span class="help-block"><?php echo form_error('col'.$i); ?></span>
										</div>
									</div>
								<?php $i++; } ?>
				
				
				<?php } ?>
			<?php if(empty($modifier) || !$modifier) { ?>
			<!-- Email  -->
			<div class="control-group <?php if (form_error('envoiMail')) echo "error";?>" >
				<label class="control-label"><i class="icon-envelope"></i> Envoyer un email </label>
				<div class="controls" data-toggle="buttons-radio">
					<label class="btn btn-info <?php echo coche($sauvegarde, $modification,$infoDisque,$sauv, 'envoiMail', '1', 'active'); ?>" for="envoiMail3" >
						<input 
							style="display:none;" 
							type="radio" 
							id="envoiMail3" 
							name="envoiMail" 
							value="1" 
							<?php echo coche($sauvegarde,$modification,$infoDisque,$sauv,"envoiMail", "1", "checked=\"checked\"") ?>>
						Oui
					</label>
					<label class="btn <?php echo coche($sauvegarde, $modification, $infoDisque,$sauv,'envoiMail', '', 'active'); ?>" for="envoiMail2" >
						<input 
							style="display:none;" 
							type="radio" 
							id="envoiMail2"
							name="envoiMail" 
							value="" 
							<?php echo coche($sauvegarde, $modification,$infoDisque,$sauv,"envoiMail", "", "checked=\"checked\"") ?>>
						Non
					</label>
					<span class="help-block"><?php echo form_error('envoiMail'); ?></span>
					<span class="help-block" id="apercu-mail" <?php if(!value($sauvegarde,$modification,$infoDisque,$sauv,'emplacement')) { ?>style="display: none"<?php } ?>>
					<a class=" btn-link" href="#">
						Aperçu du mail
					</a>
					</span>
				</div>
			</div>
			<?php } ?>	
				<div class="form-actions">
					<a class="btn btn-primary" href="javascript: document.forms['fiche'].submit();"><i class="icon-ok icon-white"></i> Valider </a>
					<a class="btn " href="<?php echo site_url('index'); ?>"><i class="icon-repeat"></i> Annuler </a>
					<?php if(empty($infoDisque)) { ?><a class="btn" id="sauvegarder-btn" href="#"><i class="icon-download-alt"></i> Sauvegarder et finir ultérieurement </a><?php } ?>
					<?php if(empty($infoDisque) && !empty($sauv)) { ?><a class="btn" href="<?php echo site_url("disque/supprimer_sauvegarde") ?>"><i class="icon-trash"></i> Supprimer la sauvegarde </a><?php } ?>
				</div>
		</form>
	</div>
	
<div id="apercu" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Apercu du mail</h3>
  </div>
  <div class="modal-body">
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Fermer</a>
  </div>
</div>