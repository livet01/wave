<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$session_id = $this->session->userdata('session_id');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Authentification</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->config->item('charset'); ?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('style'); ?>" />
	<script src="<?php echo js_url('verifAuthentification'); ?>" type="text/javascript"></script>
	<!-- Ne fonctionne pas :s 
		<script src="<?php echo js_url('less'); ?>" type="text/javascript"></script>
		<link rel="stylesheet/less" type="text/css" href="<?php echo less_url('style'); ?>">
	-->
<script>
	function connexion() {
	//Déclaration de variables de correspondances login-password pour
	//tester la fonction connexion
	var testLogin = "sbouaked";
	var testPassword = "bouaked";

	//Récupération des valeurs fournies par l'utilisateur
	var chUsername = document.getElementById('login').value;
	var chPassword = document.getElementById('password').value;

	if (chUsername == "" && chPassword == "") {
		affMesgErreur(0);
	} else if (chUsername == "") {
		affMesgErreur(1);
	} else if (chPassword == "") {
		affMesgErreur(2);
	} else {

		var connexionOn = testConnexion(testLogin, testPassword, chUsername, chPassword);

		if (connexionOn) {
			window.location = "<?php echo base_url()?>index.php/connexion/connexionOn"
		} else {
			connexionRefusee();
		}
	}

}
</script>
</head>
<body>
		<form action="<?php echo site_url(array('connexion','connexionOn')); ?>" method="post" id="connexion">
		<div id="cadre_mesg_information" class="warning">
			<i id="icon_info" class="icon-warning-sign"></i>
			<b id="mesg_erreur">Veuillez vous authentifier</b>
		</div>
		<div id="cadre_authentification">
			<p>
				<!-- Nom de LOGIN -->
				<label><i class="icon-user"></i></label>
				<input id="login" name="login" type="text" size="30" placeholder="Login">
			</p>
			<p>
				<!-- PASSWORD -->
				<label><i class="icon-key"></i></label>
				<input id="password" name="password" type="password" size="30" placeholder="Mot de Passe">
			</p>
			<a class="btn_connexion" href="javascript: document.forms['connexion'].submit();"><i class="icon-share-alt"></i> Se connecter</a>
		</div>
		<div id="footer">
			<img src="<?php echo img_url('valide_html5.png'); ?>" id="valideHtml5" alt=" valide HTML5 " />
			<img src="<?php echo img_url('valide_css.png'); ?>" id="valideCSS"  alt=" valide CSS " />
			<p style="font-size: 9px;">Page générée en <strong>{elapsed_time}</strong> seconde(s)</p>
		</div>
		</form>
	</body>

</html>