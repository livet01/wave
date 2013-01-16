jQuery(function($){
	$('#sauvegarder-btn').click(function(){
		$('#fiche').attr("action",CI.site_url+"/disque/sauvegarde").submit();
	});
});
console.log("enculer");
function GereControle(Controleur, Controle, Masquer) {
	var objControleur = document.getElementById(Controleur);
	var objControle = document.getElementById(Controle);
	
	if (Masquer=='1')
		objControle.style.visibility=(objControleur.checked==true)?'hidden':'visible';	
	else
		objControle.disabled=(objControleur.checked==true)?true:false;
}

