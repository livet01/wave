<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Un livre d'or avec CodeIgniter</title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this -> config -> item('charset'); ?>" />
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('livreor/style'); ?>" />
	</head>
	<body>
		<form method="post" action="">
			<div>
				<label> Pseudo : </label>
				<input type="text" name="pseudo" value="<?php echo set_value('pseudo'); ?>" />
				<?php echo form_error('pseudo'); ?>
			</div>
			<div>
				<label> Message : </label>
				<br />
				<textarea name="contenu" rows="7" cols="60"><?php echo set_value('contenu'); ?></textarea>								
			
			<?php echo form_error('contenu'); ?>

			</div>
			<p>
				<input type="submit" value="Valider votre commentaire" />
			</p>
		</form>
	</body>
</html>