function GereControle(Controleur, Controle, Masquer) {
	var objControleur = document.getElementById(Controleur);
	var objControle = document.getElementById(Controle);

	if (Masquer == '1')
		objControle.style.visibility = (objControleur.checked == true) ? 'hidden' : 'visible';
}


