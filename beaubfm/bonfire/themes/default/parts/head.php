<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php e($this->settings_lib->item('site.title')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<?php echo Assets::css(); ?>
    <!-- iPhone and Mobile favicon's and touch icons -->
	<link href="<?php echo css_url('jquery-ui'); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo css_url('jPages'); ?>" rel="stylesheet" type="text/css"/>
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-114x114.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
	
	<script src="<?php echo Template::theme_url('js/modernizr-2.5.3.js') ?>"></script>
    <script src="<?php echo js_url('jquery-1.8.2'); ?>"></script>
	<script type="text/javascript" src="<?php echo js_url('jquery.avgrund'); ?>"></script>
	<script type="text/javascript" src="<?php echo js_url('jquery-ui'); ?>"></script>
	<script type="text/javascript" src="<?php echo js_url('jPages'); ?>"></script>
	<script type="text/javascript"> 
	<!-- 
	    var CI = { 
	      'site_url': '<?php echo site_url(); ?>',
	      'img_url': '<?php echo img_url(); ?>'
	    }; 
	-->
	</script>
	<script type="text/javascript" src="<?php echo js_url('less') ?>"></script>
	<script>
		function create_champ_fichier(i) {
			var i2 = i + 1;
			document.getElementById('leschamps_' + i).innerHTML = '<br><label class="lab_import" for="fichier">Fichier ' + i + ':</label> <input size="60" type="file" id="fichier_' + i + '" name="fichier_' + i + '"></span>';
			document.getElementById('leschamps_' + i).innerHTML += (i <= 6) ? '<span id="leschamps_' + i2 + '"><a href="javascript:create_champ_fichier(' + i2 + ')"><i class="icon-plus-sign" ></i></a><a href="javascript:del_champ_fichier(' + i + ')"><i class="icon-minus-sign"></i></a><br></span>' : '';

			document.getElementById('leschamps_' + i).innerHTML += (i == 7) ? '<span id="leschamps_' + i2 + '"><a href="javascript:del_champ_fichier(' + i + ')"><i class="icon-minus-sign"></i></a><br></span>' : '';
		}

		function del_champ_fichier(i) {
			if (i != 2) {
				$("#leschamps_" + i).html("<a href='javascript:create_champ_fichier(" + (i) + ")'><i class='icon-plus-sign'></i></a><a href='javascript:del_champ_fichier(" + (i - 1) + ")'><i class='icon-minus-sign'></i></a>");
			} else {
				$("#leschamps_" + i).html("<a href='javascript:create_champ_fichier(" + (i) + ")'><i class='icon-plus-sign'></i></a>");
			}
		}
	</script>
	<meta name="detectify-verification" content="9dbceac8ce6c1536f677dc2d4b9500f6" />
  </head>
<body>
<!--[if lt IE 7]>
		<p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or
		<a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
<![endif]-->
