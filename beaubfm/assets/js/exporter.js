jQuery(function($){
	$("#linkXLS").click(function(){
		$("#exportdisque").attr("action",CI.site_url+"/exporter/xls");
		$("#exportdisque").submit();
	});
	$("#linkCSV").click(function(){
		$("#exportdisque").attr("action",CI.site_url+"/exporter/csv");
		$("#exportdisque").submit();
	});
});
