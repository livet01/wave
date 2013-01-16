function ac_return(field, item){
	// on met en place l'expression r�guli�re
	var regex = new RegExp('[345]', 'i');
	// on l'applique au contenu
	var nomimage = regex.exec($(item).innerHTML);
	//on r�cup�re l'id
	id = nomimage[0].replace('', '');
	// et on l'affecte au champ cach�
	$(field.name+'_id').value = id;
	// log
	$(field.name+'_log').innerHTML = '<br/><img src="personne/'+id+'.png" /> - '+$F(field.name)+'<br/>';
}

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
			$.ajax({ url: CI.site_url+'/index/suggestions',
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
				url : CI.site_url+'/disque/suggestions_artiste',
				data : { term : $("#artiste").val() },
				dataType : "json",
				type : "POST",
				success : function(data) {response(data);}
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
	url : CI.site_url+'/disque/suggestions_ecoute',
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
	url : CI.site_url+'/disque/suggestions_diffuseur',
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
	url : CI.site_url+'/disque/suggestions_email',
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
	});
	// Fonction d'ajout ou de suppression du "loader"
	function ajaxBox_loader(pState)
	{
	// Ajout d'un élement <img> d'id #ajaxBox_loader
	if (pState === true)
		$('.aff-disque').html('').html('<li>&nbsp;</li><li>&nbsp;</li><li><img id="ajaxBox_loader" src="'+CI.img_url+'ajax-loader.gif" align="center" /></li><li>&nbsp;</li><li>&nbsp;</li>');
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
