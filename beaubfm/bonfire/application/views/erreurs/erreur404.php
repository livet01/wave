<script type="text/javascript">
	function redirection(i){ 
		$("#nbredirect").html('').html(i);
		if(i==0) {
			window.location="<?php echo site_url('home'); ?>"; 
			}
		else {
			setTimeout(function(){redirection(i-1);},1000); } 
			}
	redirection(5);
</script>
<div id="Container">
	<center>
		<div class="page-header">
		<h1>La page est introuvable</h1>
		</div>
		<p>Redirection vers l'accueil dans <strong id="nbredirect">5</strong> secondes <br><img src="<?php echo img_url('broken-record.jpg');  ?>" width="300px" height="300px" /></p>
	</center>
</div>