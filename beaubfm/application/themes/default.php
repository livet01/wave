<!DOCTYPE html>
<html lang="en">
	<head>
		<title>BeaubFM</title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this -> config -> item('charset'); ?>" />
		<!--	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('style'); ?>" />	-->
		<script src="<?php echo js_url('jquery-1.8.2'); ?>"></script>
		<link href="<?php echo css_url('jquery-ui'); ?>" rel="stylesheet" type="text/css"/>
		<link href="<?php echo css_url('jPages'); ?>" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="<?php echo js_url('jquery-ui'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('ajoutfiche'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jPages'); ?>"></script>
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
    			//Lorsque vous cliquez sur un lien de la classe poplight et que le href commence par #
$('a.poplight[href^=#]').click(function() {
	var popID = $(this).attr('rel'); //Trouver la pop-up correspondante
	var popURL = $(this).attr('href'); //Retrouver la largeur dans le href

	//Récupérer les variables depuis le lien
	var query= popURL.split('?');
	var dim= query[1].split('&');
	var popWidth = dim[0].split('=')[1]; //La première valeur du lien

	//Faire apparaitre la pop-up et ajouter le bouton de fermeture
	$('#' + popID).fadeIn().css({
		'width': Number(popWidth)
	})
	.prepend('');

	//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
	var popMargTop = ($('#' + popID).height() + 80) / 2;
	var popMargLeft = ($('#' + popID).width() + 80) / 2;

	//On affecte le margin
	$('#' + popID).css({
		'margin-top' : -popMargTop,
		'margin-left' : -popMargLeft
	});

	//Effet fade-in du fond opaque
	$('body').append(''); //Ajout du fond opaque noir
	//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
	$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

	return false;
});

//Fermeture de la pop-up et du fond
$('a.close, #fade').live('click', function() { //Au clic sur le bouton ou sur le calque...
	$('#fade , .popup_block').fadeOut(function() {
		$('#fade, a.close').remove();  //...ils disparaissent ensemble
	});
	return false;
});

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
				$('#fiche').submit();
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
				$('#fiche').submit();
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
				$('#fiche').submit();
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
			
				function countChecked() {
				  var n = $("input:checked").length;
				  if(n >= 1) {
				  	$("#exporter").removeClass().addClass("btn-large-action");
				  	$("#exporter").click(function(){
				  		
				  		$("#tdisque").submit();
				  		
				  	});
				  }
				  else {
				  	$("#exporter").removeClass().addClass("btn-large-action-nonActif");
				  	$("#exporter").attr("href", "#");
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
			
		
		</script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
		<script>
  $(function(){
    $("div.holder").jPages({
      containerID : "disque",
      previous : "←",
      next : "→",
      perPage : 15,
      delay : 10
    });
  });
  </script>
				<script>
			


			
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
					$("#leschamps_" + i).html("<a href='javascript:create_champ_fichier("+(i)+")'><i class='icon-plus-sign'></i></a><a href='javascript:del_champ_fichier("+(i-1)+")'><i class='icon-minus-sign'></i></a>");
				}
				else {
					$("#leschamps_" + i).html("<a href='javascript:create_champ_fichier("+(i)+")'><i class='icon-plus-sign'></i></a>");
				}
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
			<p style="font-size: 9px;">
				Page générée en <strong>{elapsed_time}</strong> seconde(s)
			</p>
		</div>

	</body>
</html>