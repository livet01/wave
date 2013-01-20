jQuery(function($){
	$('#sauvegarder-btn').click(function(){
		$('#fiche').attr("action",CI.site_url+"/disque/sauvegarde").submit();
	});
});

function GereControle(Controleur, Controle, Masquer) {
	var objControleur = document.getElementById(Controleur);
	var objControle = document.getElementById(Controle);
	
	if (Masquer=='1')
		objControle.style.visibility=(objControleur.checked==true)?'hidden':'visible';	
	else
		objControle.disabled=(objControleur.checked==true)?true:false;
}

function ArtisteChange() {
	$.ajax({
			url : CI.site_url+'/disque/verif_artiste',
			data : { term : $("#artiste").val() },
			type : "POST",
			success : function(rep,textStatus,jqXHR) {
				try{
					var data = jQuery.parseJSON(rep)
					if(data.nom == $("#artiste").val()){
						$('#art-help').removeAttr('class','label label-info').attr('class','label label-success').html('').html('Artiste trouvé');
					}
					else {
						$('#art-help').removeAttr('class','label label-success').attr('class','label label-info').html('').html('Nouvelle artiste');
					}
				} catch(err){
					$('#art-help').removeAttr('class','label label-success').attr('class','label label-info').html('').html('Nouvelle artiste');
				}
			}
		});
}

function LabelChange() {
	$('#art-help2').removeAttr('class','label label-info').html('');
	$('#lab-help').removeAttr('class','label label-info').html('');
	if($('input[name=autoprod]:checked').val() == 'a') {
		var label =  $("#artiste").val();
		$('#email-block').show();
	}				
	else if ($('input[name=autoprod]:checked').val() == 'b') {
		var label =  $("#diffuseur").val();
		$('#email-block').show();
	}			
	else
		var label = null;
	if(label != null) {
		$.ajax({
			url : CI.site_url+'/disque/verif_diffuseur',
			data : { term : label },
			type : "POST",
			success : function(rep,textStatus,jqXHR) {
				try{
					var data = jQuery.parseJSON(rep);
					
					if(data.nom == label){
						if($('input[name=autoprod]:checked').val() == 'a'){
							$('#art-help2').removeAttr('class','label label-info').attr('class','label label-success').html('').html('Auto-producteur trouvé');
						}
						else {
							$('#lab-help').removeAttr('class','label label-info').attr('class','label label-success').html('').html('Label trouvé');
						}
						if(data.email) {
							$('#email').val(data.email).attr('disabled','disabled');
						}
					}
					else {
						if($('input[name=autoprod]:checked').val() == 'a') {
							$('#art-help2').removeAttr('class','label label-info').attr('class','label label-info').html('').html('Nouveau auto-producteur');
						}
						else {
							$('#lab-help').removeAttr('class','label label-info').attr('class','label label-info').html('').html('Nouveau label');
						}
						$('#email').val('').removeAttr('disabled','disabled');
					}
				} catch(err){
					if($('input[name=autoprod]:checked').val() == 'a') {
						$('#art-help2').removeAttr('class','label label-info').attr('class','label label-info').html('').html('Nouveau auto-producteur');
					}
					else {
						$('#lab-help').removeAttr('class','label label-info').attr('class','label label-info').html('').html('Nouveau label');
					}
					$('#email').val('').removeAttr('disabled','disabled');
				}
			}
		});
	}
}

function ArtisteDisqueVerif() {
	$.ajax({
			url : CI.site_url+'/disque/verif_artiste_disque',
			data : "artiste="+$("#artiste").val()+"&disque="+$("#titre").val(),
			type : "POST",
			success : function(rep,textStatus,jqXHR) {
				try{
					var data = jQuery.parseJSON(rep)
					if(data.couple && data.artiste == $("#artiste").val() && data.disque == $("#titre").val()){
						$('#dis-help').removeAttr('class','label label-important').attr('class','label label-important').html('').html('Doublons détecté');
					}
					else {
						$('#dis-help').removeAttr('class','label label-important').html('');
					
					}
					
				} catch(err){
					$('#dis-help').removeAttr('class','label label-important').html('');
					
				}
			}
		});
}


function EcouteChange() {
	$.ajax({
			url : CI.site_url+'/disque/verif_ecoute',
			data : { term : $("#listenBy").val() },
			type : "POST",
			success : function(rep,textStatus,jqXHR) {
				try{
					var data = jQuery.parseJSON(rep)
					if(data.nom == $("#listenBy").val()){
						$('#ect-help').removeAttr('class','label label-important').attr('class','label label-success').html('').html('Membre trouvé');
					}
					else {
						$('#ect-help').removeAttr('class','label label-success').attr('class','label label-important').html('').html('Membre introuvable');
					}
				} catch(err){
					$('#ect-help').removeAttr('class','label label-success').attr('class','label label-important').html('').html('Membre introuvable');
				}
			}
		});
}

function EmbChange() {
	$.ajax({
			url : CI.site_url+'/disque/verif_emb',
			data : { term : $("#emb").val() },
			type : "POST",
			success : function(rep,textStatus,jqXHR) {
				try{
					var data = jQuery.parseJSON(rep)
					if(data.nom == $("#emb").val()){
						$('#emb-help').removeAttr('class','label label-info').attr('class','label label-success').html('').html('Emission trouvée');
					}
					else {
						$('#emb-help').removeAttr('class','label label-success').attr('class','label label-info').html('').html('Nouvelle emission');
					}
				} catch(err){
					$('#emb-help').removeAttr('class','label label-success').attr('class','label label-info').html('').html('Nouvelle emission');
				}
			}
		});
}