function testConnexion(testLogin, testPassword, login, password) {
	var accesAutorise = false;

	if (testLogin == login && testPassword == password) {
		accesAutorise = true;
	}

	return accesAutorise;
}

function connexionRefusee() {
	//Récupération des champs de la page
	var login = document.getElementById('login');
	var password = document.getElementById('password');

	//Réinitialisation des champs
	password.value = "";

	//Modification du style css
	login.select();

	affMesgErreur(3);
}

function affMesgErreur(codeRet) {
	//Création de la boîte de message d'erreur
	var cadreMesgInfo = document.getElementById('cadre_mesg_information');
	var icon_info = document.getElementById('icon_info');
	var mesgErreur = document.getElementById('mesg_erreur');

	switch (codeRet) {
		case 0 :
			//Login et Password manquants
			cadreMesgInfo.className = "info";
			icon_info.className = "icon-info-sign";
			mesgErreur.innerHTML = "Login et Mot de Passe non renseignés";
			break;
		case 1 :
			//Login manquant
			cadreMesgInfo.className = "info";
			icon_info.className = "icon-info-sign";
			mesgErreur.innerHTML = "Login non renseigné";
			break;
		case 2 :
			//Password manquant
			cadreMesgInfo.className = "info";
			icon_info.className = "icon-info-sign";
			mesgErreur.innerHTML = "Mot de Passe non renseigné";
			break;
		case 3 :
			//Login et/ou Password incorrects
			cadreMesgInfo.className = "error";
			icon_info.className = "icon-exclamation-sign";
			mesgErreur.innerHTML = "Login ou Mot de Passe incorrect(s)";
			break;
		default :
			alert("Aucun type d'erreurs détectés !");
			break;
	}
}

