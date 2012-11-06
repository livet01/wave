<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
$session_id = $this -> session -> userdata('session_id');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Authentification</title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this -> config -> item('charset'); ?>" />
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('style'); ?>" />
		<link rel="stylesheet/less" type="text/css" href="<?php echo less_url('style'); ?>">

		<script src="<?php echo js_url('less'); ?>" type="application/javascript"></script>
	</head>
	<body>
		<form action="<?php echo site_url(array('connexion', 'connexion')); ?>" method="post" id="connexion">
			<div id="cadre_mesg_information" class="<?php if (! is_null($msg)) echo $msg[1]; else echo "warning";?>">
				<i id="icon_info" class="<?php if (! is_null($msg)) echo $msg[2]; else echo "icon-warning-sign";?>"></i>
				<b id="mesg_erreur"><?php if (! is_null($msg)) echo $msg[0]; else echo "Veuillez vous authentifier";?></b>
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
				<input type="submit" class="btn_connexion"/>
			</div>
			<div id="footer">
				<img src="<?php echo img_url('valide_html5.png'); ?>" id="valideHtml5" alt=" valide HTML5 " />
				<img src="<?php echo img_url('valide_css.png'); ?>" id="valideCSS"  alt=" valide CSS " />
				<p style="font-size: 9px;">
					Page générée en <strong>{elapsed_time}</strong> seconde(s)
				</p>
			</div>
		</form>
	</body>

</html>