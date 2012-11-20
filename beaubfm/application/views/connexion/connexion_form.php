<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Authentification</title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this -> config -> item('charset'); ?>" />
		<link rel="stylesheet/less" type="text/css" href="<?php echo less_url('style'); ?>">

		<script src="<?php echo js_url('jquery-1.8.2'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jquery-ui'); ?>"></script>
		<!--<script src="<?php echo js_url('less'); ?>" type="application/javascript"></script>-->
		<script type="text/javascript">
		$(document).ready(function() {
			//creation de l'image
			$('<img src="<?php echo img_url('ajax-loader2.gif');?>" id="spinner" />').css('position','absolute').hide().appendTo('body');
			

			$("#connexion").submit( function() {	// à la soumission du formulaire
				$('#seconnecter').attr('disabled','disabled');	
				var position = $("#seconnecter").offset();
				$('#spinner').css({ top: position.top-3 , left: position.left + $('#seconnecter').width()+20  }).fadeIn();		
				$.ajax({ // fonction permettant de faire de l'ajax
				   type: "POST", // methode de transmission des données au fichier php
				   url: "<?php echo site_url(array('connexion', 'ajax')); ?>", // url du fichier php
				   data: "login="+$("#login").val()+"&password="+$("#password").val(), // données à transmettre
				   success: function(msg){ // si l'appel a bien fonctionné
						if(msg==1) {
							document.location.href="<?php echo site_url('index');?>"
						}
						else {
							$("#password").val("");
							$("#error").html("").html(msg);
							$("#login").val("").focus(); 
						}
				   },
				   complete: function() {
						$('#spinner').fadeOut();
						$('#seconnecter').removeAttr('disabled');
					}
				});
				return false; // permet de rester sur la même page à la soumission du formulaire
			});
		});
		</script>
	</head>
	<body>
		<form action="<?php echo site_url(array('connexion', 'index')); ?>" method="post" id="connexion">
			<div id="error">
				<div id="cadre_mesg_information" class="<?php if (! is_null($msg)) echo $msg[1]; else echo "warning";?>">
					<i id="icon_info" class="<?php if (! is_null($msg)) echo $msg[2]; else echo "icon-warning-sign";?>"></i>
					<b id="mesg_erreur"><?php if (! is_null($msg)) echo $msg[0]; else echo "Veuillez vous authentifier";?></b>
				</div>
			</div>
			<div id="cadre_authentification">
				<p>
					<!-- Nom de LOGIN -->
					<label for="login"><i class="icon-user"></i></label>
					<input id="login" name="login" type="text" size="30" placeholder="Nom d'utilisateur">
				</p>
				<p>
					<!-- PASSWORD -->
					<label for"password"><i class="icon-key"></i></label>
					<input id="password" name="password" type="password" size="30" placeholder="Mot de Passe">
				</p>
				<input type="submit" class="btn_connexion" name="envoi" value="Se connecter" id="seconnecter">
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