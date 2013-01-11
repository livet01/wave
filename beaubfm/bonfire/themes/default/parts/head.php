<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php e($this->settings_lib->item('site.title')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<script src="<?php echo Template::theme_url('js/modernizr-2.5.3.js') ?>"></script>
	<?php echo Assets::css(); ?>

    <!-- iPhone and Mobile favicon's and touch icons -->
    <script src="<?php echo js_url('jquery-1.8.2'); ?>"></script>
	<link href="<?php echo css_url('jquery-ui'); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo css_url('jPages'); ?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo js_url('jquery-ui'); ?>"></script>
	<script type="text/javascript" src="<?php echo js_url('ajoutfiche'); ?>"></script>
	<script type="text/javascript" src="<?php echo js_url('jPages'); ?>"></script>

	<script ype="text/javascript" src="<?php echo js_url('jquery.avgrund'); ?>"></script>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-114x114.png">
	
	<script type="text/javascript">
			$.widget( "custom.catcomplete", $.ui.autocomplete, {
			_renderMenu: function( ul, items ) {
			var that = this,
			currentCategory = "";
			$.each( items, function( index, item ) {
			if ( item.category != currentCategory ) {
			ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
			currentCategory = item.category;
			}
			that._renderItemData( ul, item );
			});
			}
			});

			//Recherche (autocompl�tion)
			jQuery(document).ready(function($) {
				$('.colall').hide();
			$("#recherche" ).catcomplete({
			source: function(request, response) {
			$.ajax({ url: "<?php echo site_url('index/suggestions'); ?>
				",
				data: { term: $("#recherche").val()},
				dataType: "json",
				type: "POST",
				success: function(data){response(data);}
				});
				},
				minLength: 1,
				delay:0,
				select: function(event, ui) {
				if(ui.item){
				$('#recherche').val(ui.item.value);
				}
				$('#recherche_form').submit();}
				});

				//Recherche Artiste (autocompl�tion)

				$("#artiste").autocomplete({
				source : function(request, response) {
				$.ajax({
				url : "<?php echo site_url('disque/suggestions_artiste'); ?>",
				data : {
				term : $("#artiste").val()
				},
				dataType : "json",
				type : "POST",
				success : function(data) {
				response(data);
				}
				});
				},
				minLength : 1,
				delay : 0,
				select : function(event, ui) {
				if (ui.item) {
				$('#artiste').val(ui.item.value);
				}
				}
				});
				$("#listenBy").autocomplete({
				source : function(request, response) {
				$.ajax({
				url : "<?php echo site_url('disque/suggestions_ecoute'); ?>",
				data : {
				term : $("#listenBy").val()
				},
				dataType : "json",
				type : "POST",
				success : function(data) {
				response(data);
				}
				});
				},
				minLength : 1,
				delay : 0,
				select : function(event, ui) {
				if (ui.item) {
				$('#listenBy').val(ui.item.value);
				}
				}
				});
				$("#email")
				//Recherche Label (autocompl�tion)
				$("#diffuseur").autocomplete({
				source : function(request, response) {
				$.ajax({
				url : "<?php echo site_url('disque/suggestions_diffuseur'); ?>",
				data : {
				term : $("#diffuseur").val()
				},
				dataType : "json",
				type : "POST",
				success : function(data) {
				response(data);
				}
				});
				},
				minLength : 1,
				delay : 0,
				select : function(event, ui) {
				if (ui.item) {
				$('#diffuseur').val(ui.item.value);
				}
				}}).blur(function(){
				$("#email").val("");
				$.ajax({
				url : "<?php echo site_url('disque/suggestions_email'); ?>",
				data : {
				term : $("#diffuseur").val()
				},
				dataType : "json",
				type : "POST",
				success : function(data) {
				$("#email").val(data);
				}
				
				});
					
				});
				$('#sauvegarder-btn').click(function(){
						$('#fiche').attr("action","<?php echo site_url("disque/sauvegarde"); ?>").submit();
					});
				function countChecked() {
				// Pour les disques normales et correctes
				var n = $("input:checked").length;
				if(n >= 1) {
			  	$("#supprimer>a").removeClass().addClass("btn");
			  	$("#supprimer>a").click(function(){
			  		$("#tdisque").attr("action","<?php echo site_url("disque/supprimer"); ?>").submit();
			  	});
			  	
			  	$("#exporter>a").removeClass().addClass("btn");
			  	$("#exporter>a").click(function(){
			  		$("#tdisque").attr("action","<?php echo site_url("exporterFiche"); ?>").submit();
			  	});
			  	
			  	$("#modifier>a").removeClass().addClass("btn");
			  	$("#modifier>a").click(function(){
			  		$("#tdisqueI").attr("action","<?php echo site_url("enAttente/modifDisquesEnAttente"); ?>").submit();
			  	});
				  	
			  	$("#supprimerI>a").removeClass().addClass("btn");
			  	$("#supprimerI>a").click(function(){
			  		$("#tdisqueI").attr("action","<?php echo site_url("enAttente/supprimmerDisquesEnAttente"); ?>").submit();
				});
				}
				else {
			  	$("#supprimer>a").removeClass().addClass("btn disabled");
			  	$("#supprimer>a").attr("href", "#");
			  	$("#supprimerI>a").removeClass().addClass("btn disabled");
			  	$("#supprimerI>a").attr("href", "#");
			  	$("#exporter>a").removeClass().addClass("btn disabled");
			  	$("#exporter>a").attr("href", "#");
			  	$("#modifier>a").removeClass().addClass("btn disabled");
			  	$("#modifier>a").attr("href", "#");
			  	$("#tdisque").attr("action","#");
				}
				}
				countChecked();

				$(":checkbox").click(countChecked);

					$("#linkXLS").click(function(){
				$("#exportdisque").attr("action","<?php echo site_url("exporterFiche/xls"); ?>");
				$("#exportdisque").submit();
				});

				$("#linkCSV").click(function(){
				$("#exportdisque").attr("action","<?php echo site_url("exporterFiche/csv"); ?>");
				$("#exportdisque").submit();
				});

				$("#supprAll").click(function(){
				$("#supprimerdisque").attr("action","<?php echo site_url("disque/supprimerAll"); ?>");
				$("#supprimerdisque").submit();
				});
				
				$("#supprAllI").click(function(){
				$("#supprimerdisque").attr("action","<?php echo site_url("enAttente/supprimerAll"); ?>");
				$("#supprimerdisque").submit();
				});
				
				$(".holder").jPages({
				containerID : "disque",
				previous : "←",
				next : "→",
				perPage : 16,
				delay : 10
				});
				
				$(".holder1").jPages({
				containerID : "disque1",
				previous : "←",
				next : "→",
				perPage : 16,
				delay : 10
				});
				
				$(".holder2").jPages({
				containerID : "disque2",
				previous : "←",
				next : "→",
				perPage : 16,
				delay : 10
				});
				});

				function CocheTout(ref, name) {
				var form = ref;

				while (form.parentNode && form.nodeName.toLowerCase() != 'form'){
				form = form.parentNode;
				}

				var elements = form.getElementsByTagName('input');

				for (var i = 0; i < elements.length; i++) {
				if (elements[i].type == 'checkbox' && elements[i].name == name) {
				elements[i].checked = ref.checked;
				}
				}
				}
				// Fonction d'ajout ou de suppression du "loader"
				function ajaxBox_loader(pState)
				{
				// Ajout d'un élement <img> d'id #ajaxBox_loader
				if (pState === true)
				$('.aff-disque').html('').html('<li>&nbsp;</li><li>&nbsp;</li><li><img id="ajaxBox_loader" src="<?php echo img_url('ajax-loader.gif'); ?>" align="center" /></li><li>&nbsp;</li><li>&nbsp;</li>');
				// Suppression de l'élement d'id #ajaxBox_loader
				else
				$('#ajaxBox_loader').remove();
				}

				// Fonction de mise à jour du contenu de la div #ajaxBox
				// Ajout d'un element <p> contenant le message, dans le div #ajaxBox
				function ajaxBox_setText(pText)
				{
				$('#chargement').append('<p>'+ pText +'</p>');
				}

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

  </head>
<body>
<!--[if lt IE 7]>
		<p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or
		<a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
<![endif]-->
