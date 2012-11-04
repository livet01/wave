<!DOCTYPE html>
<html lang="en">
	<head>
		<title>BeaubFM</title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->config->item('charset'); ?>" />
			<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('style'); ?>" />
			<script type="text/javascript" src="<?php echo js_url('less') ?>"></script>
			<script>
				function create_champ_fichier(i){
					var i2 = i + 1;
					document.getElementById('leschamps_'+i).innerHTML = '<br><label class="lab_import" for="fichier">Fichier '+i+':</label> <input size="60" type="file" id="fichier_'+i+'" name="fichier_'+i+'"></span>';
					document.getElementById('leschamps_'+i).innerHTML += (i <= 6) ? '<span id="leschamps_'+i2+'"><a href="javascript:create_champ_fichier('+i2+')"><i class="icon-plus-sign"></i></a><i class="icon-minus-sign"></i><br></span>' : '';
				}
			</script>
		<!-- Ne fonctionne pas :s
		<script src="<?php echo js_url('less'); ?>" type="text/javascript"></script>
		<link rel="stylesheet/less" type="text/css" href="<?php echo less_url('style'); ?>">
		-->
	</head>
	<body>
		<div id="main_page">
		
			<?php echo $output; ?>
			
		</div>
		<div id="footer">
			<img src="<?php echo img_url('valide_html5.png'); ?>" id="valideHtml5" alt=" valide HTML5 " />
			<img src="<?php echo img_url('valide_css.png'); ?>" id="valideCSS"  alt=" valide CSS " />
			<p style="font-size: 9px;">Page générée en <strong>{elapsed_time}</strong> seconde(s)</p>
		</div>

	
	
	</body>
</html>