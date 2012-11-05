<div id="cadre2">
	<div id="cadre_action">
		<a class="btn-large-action" href="javascript:document.forms[0].reset()"><i class="icon-undo"></i> Annuler </a>
		<a class="btn-large-action" href="javascript: submitform()"><i class="icon-ok"></i> Valider </a>
	</div>
	<div id="resultat_recherche">
	<h1>Ajout d'une fiche</h1>
	<div id="formulaire">
		<form  method="post" id="fiche" onsubmit="return verifForm(this)" action="envoi">
			<div id="gauche">
				<p>
					<label class="labelGauche" for="titre"><i class="icon-music"></i> Titre </label>
					<input type="text" id="titre" name="titre" title="Titre obligatoire" onblur="verifTitre(this)">
				</p>
				<p>
					<label class="labelGauche" for="artiste"><i class="icon-group"></i> Artiste</label>
					<input type="text" id="artiste" name="artiste" title="Artiste obligatoire" onblur="verifArtiste(this)">
					<input class="check" type="checkbox" id="autoprod" name="autoprod" value="a">
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
					<input type="radio" name="emplacement" id="emp1" value="airplay" checked="checked" >
					<label class="check" for="emp1" >AirPlay</label>
					<br>
					<input type="radio" name="emplacement" id="emp2" value="nonDiffuse">
					<label class="check" for="emp2" >Non Diffusé</label>
					<br>
					<input type="radio" name="emplacement" id="emp3" value="emissionBenevole">
					<label class="check" for="emp3" >Emission Bénévole</label>
					<br>
					<input type="radio" name="emplacement" id="emp4" value="archivage">
					<label class="check" for="emp4" >Archivage</label>
					<br>
				</p>
				<p>
					<label class="labelGauche" for="emBev"><i class="icon-comments"></i> Emission Bénévole </label>
					<input type="text" name="emBev" id="emBev" onblur="verifEmBen(this)" >
				</p>
				<p>
					<label class="labelGauche" for="listenBy"><i class="icon-headphones"></i> Ecouté par </label>
					<input type="text" name="listenBy" id="listenBy" onblur="verifDiffuseur(this)" >
				</p>
				<p>
					<label class="labelGauche" for="diffuseur"><i class="icon-home"></i> Diffuseur </label>
					<input type="text" id="diffuseur" name="diffuseur" title="Label obligatoire" onblur="verifDiffuseur(this)">
				</p>
				<p>
					<label class="labelGauche" for="email"><i class="icon-envelope-alt"></i> Email de contact </label>
					<input type="text" id="email" name="email" title="e-mail obligatoire" onblur="verifMail(this)">
					<input class="check" type="checkbox" id="envoiMail" name="envoiMail" value="0">
					<label class="labelCheck" for="envoiMail" >Envoyer email</label>
				</p>
			</div>
	</div>
	</div>
</div>