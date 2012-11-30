<div id="cadre2">
	<div id="cadre_action">
		<a class="btn-large-action" href="javascript: document.forms['fiche'].reset();" onclick="$('#show').avgrund()"><i class="icon-undo"></i> Annuler </a>
		<a class="btn-large-action" href="javascript: document.forms['fiche'].submit();"><i class="icon-ok"></i> Valider </a>
	</div>
	<div id="resultat_recherche">
		<h1>Envoyer mail</h1>
			<form  method="post" id="fiche" onsubmit="return verifForm(this)" action="<?php echo site_url("envoyerMail/envoi"); ?>">
				<p>
				<label class="labelGauche" for="email"><i class="icon-envelope-alt"></i> Email de contact </label>
					<input type="text" id="email" name="email" title="e-mail obligatoire" onblur="verifMail(this)" value="<?php echo set_value('email'); ?>">
					<input class="check" type="checkbox" id="envoiMail" name="envoiMail" value="0">
					<label class="labelCheck" for="envoiMail" >Envoyer email</label>
				</p>
				<p>
				<label class="labelGaucheEmplacement" for="emplacement"><i class="icon-hdd"></i> Emplacement </label>
					<input type="radio" name="emplacement" id="emp1" value="airplay" checked="checked"onclick="$('#emb').hide()" >
					<label class="check" for="emp1" onclick="$('#emb').hide()">AirPlay</label>
					<input type="radio" name="emplacement" id="emp2" value="nonDiffuse" onclick="$('#emb').hide()">
					<label class="check" for="emp2"onclick="$('#emb').hide()" >Non Diffusé</label>
					<br>
				</p>	
				<p>
					<label class="labelGauche" for="corpsemail"> Message </label><br>
					<textarea name="corpsemail" cols="74" rows="20" style="resize: none;"></textarea>
					
				</p>
				<script>
				$(function() {
					$('#show').avgrund({
						height: 200,
						holderClass: 'custom',
						showClose: true,
						showCloseText: 'Close',
						enableStackAnimation: true,
						onBlurContainer: '.container',
						template: '<p>Voici le mail qui va être envoyé : </p>' +
						'<div>' +
						
						'</div>'
					});
				});
	</script>
	</div>
</div>