function CocheTout(ref, name) 
{
	var form = ref;

	while (form.parentNode && form.nodeName.toLowerCase() != 'form')
	{
		form = form.parentNode;
	}

	var elements = form.getElementsByTagName('input');

	for (var i = 0; i < elements.length; i++) 
	{
		if (elements[i].type == 'checkbox' && elements[i].name == name) 
		{
			elements[i].checked = ref.checked;
		}
	}
}

jQuery(function($){
	function countChecked() {
		// Pour les disques normales et correctes
		var n = $("input:checked").length;
		if(n >= 1) {
		  	$("#supprimer>a").removeClass().addClass("btn");
		  	$("#supprimer>a").click(function(){
		  		$("#tdisque").attr("action",CI.site_url+"/disque/supprimer").submit();
		  	});
		  	
		  	$("#exporter>a").removeClass().addClass("btn");
		  	$("#exporter>a").click(function(){
		  		$("#tdisque").attr("action",CI.site_url+"/exporter").submit();
		  	});
		  	
		  	$("#modifier>a").removeClass().addClass("btn");
		  	$("#modifier>a").click(function(){
		  		$("#tdisqueI").attr("action",CI.site_url+"/enAttente/modifier").submit();
		  	});
			  	
		  	$("#supprimerI>a").removeClass().addClass("btn");
		  	$("#supprimerI>a").click(function(){
		  		$("#tdisqueI").attr("action",CI.site_url+"/enAttente/supprimer").submit();
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
});
