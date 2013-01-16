
$(function(){
	$("#supprAll").click(function(){
		$("#supprimerdisque").attr("action",CI.site_url+"/disque/supprimerAll");
		$("#supprimerdisque").submit();
	});
});