console.log('<li>&nbsp;</li><li>&nbsp;</li><li><img id="ajaxBox_loader" src="'+CI.img_url+'"ajax-loader.gif" align="center" /></li><li>&nbsp;</li><li>&nbsp;</li>');

jQuery(function($){
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
