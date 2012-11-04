<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
	<title>Un livre d'or avec CodeIgniter</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->config->item('charset'); ?>" />
	<script src="<?php echo js_url('less'); ?>" type="text/javascript"></script>
	<link rel="stylesheet/less" type="text/css" href="<?php echo less_url('style'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo css_url('style'); ?>">
</head>
<body>
	<div id="main_page">
		<div id="cadre">
			
			<div id="messages">
		<p>
			Il y a actuellement <?php echo $nb_commentaires; ?> commentaires. <br />
			<?php echo url('écrire un commentaire', 'livreor/ecrire'); ?>
		</p>
		<div class="pagination">
			<?php echo $pagination; ?>
		</div>
		<?php foreach($messages as $message): ?>
			<div id="num_<?php echo $message->id; ?>" class="message">
				<p>
					<a href="#num_<?php echo $message->id; ?>">#</a>
					Par <span class="pseudo_commentaire"><?php echo htmlentities($message->pseudo); ?></span>
					le <span class="date_commentaire"><?php echo $message->date;?></span>
				</p>
				<div class="contenu_commentaire">
					<?php echo nl2br(htmlentities($message->message)); ?>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="pagination">
			<?php echo $pagination; ?>
		</div>
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>
			  
			
		</div>
	</div>
	
</body>
</html>