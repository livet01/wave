<!DOCTYPE html>
<html>
	<head>
		 <meta charset="utf-8">
	    <title>BeaubFM</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
		<link href="<?php echo css_url('bootstrap.min'); ?>" rel="stylesheet" type="text/css"/>
		<style type="text/css">
			body {
				width: 434px;
				height : 90px;
				background: url(<?php echo img_url("fond/10.jpg"); ?>) no-repeat center ;
			}
			#spip {
				padding-top: 30px;
			}
			
		</style>
	</head>
	<body>
		<div id="spip">
		<center>
				<form class="form-search" target="_blank" action="<?php echo site_url('index/recherche'); ?>" method="post" name="form_recherche">
					<div class="input-append">
						<input type="text" class="span4 search-query" name="recherche" value="<?php
						if (!empty($value)) { echo $value;
						}
						?>"  placeholder="Recherchez un titre, un label, un artiste...">
						<button type="submit" class="btn">
							Rechercher
						</button>
					</div>
				</form>
		</center>
		</div>
	</body>
</html>
