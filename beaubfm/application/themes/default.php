<!DOCTYPE html>
<html lang="en">
	<head>
		<title>BeaubFM</title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this -> config -> item('charset'); ?>" />
		<!--	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('style'); ?>" />	-->
		<script src="<?php echo js_url('jquery-1.8.2'); ?>"></script>
		<link href="<?php echo css_url('jquery-ui'); ?>" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="<?php echo js_url('jquery-ui'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('ajoutfiche'); ?>"></script>
		
		<link rel="stylesheet/less" type="text/css" href="<?php echo less_url('style'); ?>">
		

		<script src="<?php echo js_url('less'); ?>" type="application/javascript"></script>
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
    	$(document).ready(function() {
				$("#recherche" ).catcomplete({
						source: function(request, response) {
								$.ajax({ url: "<?php echo site_url('index/suggestions'); ?>",
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
			});
			// Fonction d'ajout ou de suppression du "loader"
			function ajaxBox_loader(pState)
			{
			// Ajout d'un élement <img> d'id #ajaxBox_loader
			if (pState === true)
			$('#aff-disque').html('').html('<li>&nbsp;</li><li>&nbsp;</li><li><img id="ajaxBox_loader" src="<?php echo img_url('ajax-loader.gif');?>" align="center" /></li><li>&nbsp;</li><li>&nbsp;</li>');
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
			
			//Recherche Artiste (autocompl�tion)
			$(document).ready(function() {
				$("#artiste").autocomplete({
					source : function(request, response) {
					$.ajax({
							url : "<?php echo site_url('ajoutFiche/suggestions'); ?>",
							data : {
							termArtiste : $("#artiste").val()
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
					$('#fiche').submit();
				}
				});
			}); 
			//Recherche Label (autocompl�tion)
			$(document).ready(function() {
				$("#diffuseur").autocomplete({
					source : function(request, response) {
					$.ajax({
							url : "<?php echo site_url('ajoutFiche/suggestions'); ?>",
							data : {
							termDiffuseur : $("#diffuseur").val()
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
					$('#fiche').submit();
				}
				});
			}); 
		</script>
		<script type="text/javascript" src="<?php echo js_url('less') ?>"></script>
		<script>
			function create_champ_fichier(i) {
				var i2 = i + 1;
				document.getElementById('leschamps_' + i).innerHTML = '<br><label class="lab_import" for="fichier">Fichier ' + i + ':</label> <input size="60" type="file" id="fichier_' + i + '" name="fichier_' + i + '"></span>';
				document.getElementById('leschamps_' + i).innerHTML += (i <= 6) ? '<span id="leschamps_' + i2 + '"><a href="javascript:create_champ_fichier(' + i2 + ')"><i class="icon-plus-sign"></i></a><i class="icon-minus-sign"></i><br></span>' : '';
			}
		</script>
		<!-- Ne fonctionne pas :s
		<script src="<?php echo js_url('less'); ?>" type="text/javascript"></script>
		<link rel="stylesheet/less" type="text/css" href="<?php echo less_url('style'); ?>">
		-->
	</head>
	<body>
		<div id="mainheader">
		  <img src="<?php echo img_url('logo-2.png'); ?>" id="logo" alt="logo " />
		</div>
		
		<div id="main_page">
		
		  <?php echo $output; ?>
		</div>
			
			

		<div id="footer">
			<img src="<?php echo img_url('valide_html5.png'); ?>" id="valideHtml5" alt=" valide HTML5 " />
			<img src="<?php echo img_url('valide_css.png'); ?>" id="valideCSS"  alt=" valide CSS " />
			<p style="font-size: 9px;">
				Page générée en <strong>{elapsed_time}</strong> seconde(s)
			</p>
		</div>
		
</body>
</html>