$(function(){
	$("#supprAllI").click(function(){
		$("#supprimerdisque").attr("action",CI.site_url+"/enAttente/supprimerAll");
		$("#supprimerdisque").submit();
	});	
});
