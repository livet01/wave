<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
?>
	<div id="cadre_mesg_information" class="<?php if (! is_null($msg)) echo $msg[1]; else echo "warning";?>">
		<i id="icon_info" class="<?php if (! is_null($msg)) echo $msg[2]; else echo "icon-warning-sign";?>"></i>
		<b id="mesg_erreur"><?php if (! is_null($msg)) echo $msg[0]; else echo "Veuillez vous authentifier";?></b>
	</div>
