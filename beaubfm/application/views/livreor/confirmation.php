<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Un livre d'or avec CodeIgniter</title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this -> config -> item('charset'); ?>" />
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('style'); ?>" />
	</head>
	<body>
		<div id="confirmation">
			<p>
				Votre message a bien été ajouté à la base de données. Nous vous remercions de votre commentaire.
			</p>
			<p>
				<?php echo url('Revenir à la page des commentaires', 'livreor'); ?>
			</p>
		</div>
	</body>
</html>