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
				
			
					<label class="mesgReussi"><i class = <?php (empty($reussi)) ? "" : "mesgReussi"; ?>><i class=<?php if (!empty($reussi)) echo "icon-ok-sign";?>></i><?php echo $reussi; ?></i></label>
					<label class="mesgReussi"><i class = <?php (empty($erreur)) ? "" : "mesgErr"; ?>><?php echo $erreur; ?></i></label>
					
				
				<p>
					
					<!-- Message d'erreur -->
					<label class="mesgErr"><i class=<?php if (form_error('titre')) echo "icon-remove-sign";?>></i><?php echo form_error('titre'); ?></label>
					
					<label class="labelGauche" for="titre"><i class="icon-music"></i> Titre </label>
					<input type="text" id="titre" name="titre" title="Titre obligatoire" onblur="verifTitre(this)" value="<?php echo set_value('titre'); ?>">
				</p>
				<p>
					<!-- Message d'erreur -->
					<label class="mesgErr"><i class=<?php if (form_error('artiste')) echo "icon-remove-sign";?>></i><?php echo form_error('artiste'); ?></label>
					
					<label class="labelGauche" for="artiste"><i class="icon-group"></i> Artiste</label>
					<input type="text" id="artiste" name="artiste" title="Artiste obligatoire" onblur="verifArtiste(this)" value="<?php if(!empty($value)) { echo $value; } ?>" > <!-- onchange="$('#diffuseur').val($('#artiste').val());" --> 
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
					<label class="labelGaucheEmplacement" for="style"><i class="icon-file"></i> Style</label>
					<input type="radio" name="style" id="rouge" value="rouge" checked="checked">
					<label id="rouge" class="check" for="rouge" >Rock/HardRock/Punk</label>
					<br>
					<input type="radio" name="style" id="bleu" value="bleu" >
					<label class="check" for="bleu" >Electro/House/DubStep</label>
					<br>
					<input type="radio" name="style" id="vert" value="vert" >
					<label class="check" for="vert" >HipHop/Slam</label>
					<br>
					<input type="radio" name="style" id="jaune" value="jaune" >
					<label class="check" for="jaune" >Pop/Folk</label>
					<br>
					<input type="radio" name="style" id="blanc" value="blanc" >
					<label class="check" for="blanc" >World/Traditionnelle</label>
					<br>
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
					<!-- Message d'erreur -->
					<label class="mesgErr"><i class=<?php if (form_error('emBev')) echo "icon-remove-sign";?>></i><?php echo form_error('emBev'); ?></label>
					
					<label class="labelGauche" for="emb"><i class="icon-comments"></i> Emission Bénévole </label>
					<input type="text" name="emb" id="emb" onblur="verifEmBen(this)" value="<?php echo set_value('emb'); ?>">
				</p>
				
				<p>
					<!-- Message d'erreur -->
					<!-- <label class="mesgErr"><i class=<?php if (form_error('listenBy')) echo "icon-remove-sign";?>></i><?php echo form_error('listenBy'); ?></label> -->
					
					<label class="labelGauche" for="listenBy"><i class="icon-headphones"></i> Ecouté par </label>
					<input type="text" name="listenBy" readonly="readonly" id="listenBy" onblur="verifDiffuseur(this)" value="admin">
				</p>
				<p>			
					<!-- Message d'erreur --> 
					<label class="mesgErr"><i class=<?php if (form_error('diffuseur')) echo "icon-remove-sign";?>></i><?php echo form_error('diffuseur'); ?></label>
					
					<label class="labelGauche" for="diffuseur"><i class="icon-home"></i> Diffuseur </label>
					<input type="text" id="diffuseur" name="diffuseur" title="Label obligatoire" onblur="verifDiffuseur(this)" value="<?php if(!empty($value)) { echo $value; } ?>">
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