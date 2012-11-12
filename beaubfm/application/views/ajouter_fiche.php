<div id="cadre2">
	<div id="cadre_action">
		<a class="btn-large-action" href="javascript: document.forms['fiche'].reset();"><i class="icon-undo"></i> Annuler </a>
		<a class="btn-large-action" href="javascript: document.forms['fiche'].submit();"><i class="icon-ok"></i> Valider </a>
	</div>
	<div id="resultat_recherche">
	<h1>Ajout d'une fiche</h1>

	<div id="formulaire">
		<form  method="post" id="fiche" onsubmit="return verifForm(this)" action="<?php echo site_url("ajoutFiche/envoi"); ?>">
			<div id="gauche">
				<p>
				<?php echo $erreur."<br/>"; ?>
				<!-- <?php $mesgErreur = form_error('titre');?>
				<p class="<?php if(!empty($mesgErreur)) echo "form_error";?>">
					
					<!-- Message d'erreur 
					<?php if(!empty($mesgErreur)) {?> --> 
					<label class="mesgErr"><i class="icon-remove-sign"></i><?php echo $mesgErreur; ?></label>
					<!-- <?php } ?> -->
					
					<label class="labelGauche" for="titre"><i class="icon-music"></i> Titre </label>
					<input type="text" id="titre" name="titre" title="Titre obligatoire" onblur="verifTitre(this)" value="<?php echo set_value('titre'); ?>">
				</p>
				<p>
				<!-- <?php $mesgErreur = form_error('artiste');?>
				<p class="<?php if(!empty($mesgErreur)) echo "form_error";?>"> -->
					
					<!-- Message d'erreur -->
					<!-- <?php if(!empty($mesgErreur)) {?> -->
					<label class="mesgErr"><i class="icon-remove-sign"></i><?php echo $mesgErreur; ?></label>
					<!-- <?php } ?> -->
					
					<label class="labelGauche" for="artiste"><i class="icon-group"></i> Artiste</label>
					<input type="text" id="artiste" name="artiste" title="Artiste obligatoire" onblur="verifArtiste(this)" value="<?php echo set_value('artiste'); ?>" onChange="javascript:document.getElementById('diffuseur').value = document.getElementById('artiste').value">
					<input class="check" type="checkbox" id="autoprod" name="autoprod" value="a" onclick="GereControle('autoprod', 'diffuseur', 0)" >
					<label class="labelCheck" for="autoprod">Auto-Production</label>
				</p>
				
				<p>
					<label class="labelGauche" for="format"><i class="icon-file"></i> Format</label>
					<select name="format">
						<option value="cd">CD</option>
						<option value="numerique">Numérique</option>
						<option value="Vinyle">Vinyle</option>
					</select>
				</p>

				<p>
					<label class="labelGaucheEmplacement" for="emplacement"><i class="icon-hdd"></i> Emplacement </label>
					<input type="radio" name="emplacement" id="emp1" value="airplay" checked="checked"onclick="$('#emb').hide()" >
					<label class="check" for="emp1" onclick="$('#emb').hide()">AirPlay</label>
					<br>
					<input type="radio" name="emplacement" id="emp2" value="nonDiffuse" onclick="$('#emb').hide()">
					<label class="check" for="emp2"onclick="$('#emb').hide()" >Non Diffusé</label>
					<br>
					<input type="radio" name="emplacement" id="emp4" value="archivage" onclick="$('#emb').hide()">
					<label class="check" for="emp4" onclick="$('#emb').hide()">Archivage</label>
					<br>
					<input type="radio" name="emplacement" id="emp3" value="emissionBenevole" onclick="$('#emb').show()">
					<label class="check" for="emp3" onclick="$('#emb').show()" >Emission Bénévole</label>
					<br>
				</p>
				<p id="emb" style="display: none;">
				<!-- <?php $mesgErreur = form_error('emBev');?>
				<p class="<?php if(!empty($mesgErreur)) echo "form_error";?>">
					
					<!-- Message d'erreur 
					<?php if(!empty($mesgErreur)) {?> --> 
					<label class="mesgErr"><i class="icon-remove-sign"></i><?php echo $mesgErreur; ?></label>
					<!-- <?php } ?> -->
					
					<label class="labelGauche" for="emb"><i class="icon-comments"></i> Emission Bénévole </label>
					<input type="text" name="emb" id="emb" onblur="verifEmBen(this)" value="<?php echo set_value('emb'); ?>">
				</p>
				
				<p>
				<!-- <?php $mesgErreur = form_error('listenBy');?>
				<p class="<?php if(!empty($mesgErreur)) echo "form_error";?>">
					
					<!-- Message d'erreur 
					<?php if(!empty($mesgErreur)) {?> -->
					<label class="mesgErr"><i class="icon-remove-sign"></i><?php echo $mesgErreur; ?></label>
					<!-- <?php } ?> -->
					
					<label class="labelGauche" for="listenBy"><i class="icon-headphones"></i> Ecouté par </label>
					<input type="text" name="listenBy" readonly="readonly" id="listenBy" onblur="verifDiffuseur(this)" value="admin">
				</p>
				<p>			
				<!-- <?php $mesgErreur = form_error('diffuseur');?>
				<p class="<?php if(!empty($mesgErreur)) echo "form_error";?>">
					
					<!-- Message d'erreur 
					<?php if(!empty($mesgErreur)) {?> --> 
					<label class="mesgErr"><i class="icon-remove-sign"></i><?php echo $mesgErreur; ?></label>
					<!-- <?php } ?> -->
					
					<label class="labelGauche" for="diffuseur"><i class="icon-home"></i> Diffuseur </label>
					<input type="text" id="diffuseur" name="diffuseur" title="Label obligatoire" onblur="verifDiffuseur(this)" value="">
				</p>
				<p>
				<!-- <?php $mesgErreur = form_error('email');?>
				<p class="<?php if(!empty($mesgErreur)) echo "form_error";?>">
					
					<!-- Message d'erreur 
					<?php if(!empty($mesgErreur)) {?> --> 
					<label class="mesgErr"><i class="icon-remove-sign"></i><?php echo $mesgErreur; ?></label>
					<!-- <?php } ?> -->
					
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