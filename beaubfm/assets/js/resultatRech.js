/*$(function(){
	var $lt = 0, $gt = 15, $dispag = 15;
	var $result = "tr:gt(0)";
	var $max = $('input[name=dismax]').val();
	var $tab_gt_lt = new Array();
		
	//$($result+":gt("+$gt+")").hide();
	//$($result+":lt("+$lt+")").hide();
	
	for($i = 0 ; $i < $max ; $i+=15)
		$tab_gt_lt.push(new Array($i, $i+15));
	
	
	
	//$("tr:gt(0):lt(100)").hide(2000);
});*/

$(function(){
$("div.holder").jPages({
containerID : "disque",
previous : "?",
next : "?",
perPage : 20,
delay : 20
});
});
