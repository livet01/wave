    </div><!--/.container-->
    
    <footer class="footer">
	        
			<p>Copyright Wave 2012- 2013</p>
			<p>
			<img src="<?php echo img_url('valide_html5.png'); ?>" id="valideHtml5" alt=" valide HTML5 " />
			<img src="<?php echo img_url('valide_css.png'); ?>" id="valideCSS"  alt=" valide CSS " />
			</p>
	</footer>
	
	<?php echo theme_view('parts/modal_login'); ?>

	<div id="debug"></div>
  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo js_path(); ?>jquery-1.7.2.min.js"><\/script>')</script>
  <?php if(class_exists('Importer')) { ?>
  <script type="text/javascript" src="<?php echo js_url("plupload/plupload"); ?>"></script>
  <script type="text/javascript" src="<?php echo js_url("plupload/plupload.flash"); ?>"></script>
  <script type="text/javascript" src="<?php echo js_url("plupload/plupload.html5"); ?>"></script>
  <script type="text/javascript" src="<?php echo js_url("plupload/i18n/fr"); ?>"></script>
  <script type="text/javascript" >
  	var uploader = new plupload.Uploader({
		runtimes: 'html5,flash',
		container: 'plupload',
		browse_button: 'browse',
		drop_element:"droparea",
		url:'<?php echo site_url("importer/envoi"); ?>',
		flash_swf_url: '<?php echo base_url()."assets/js/plupload/plupload.flash.swf"; ?>',
		multipart : true,
		urlstream_upload: true,
		max_file_size: "2mb",
		filters : [
			{title : "Document files", extensions : "xls,xlsx,csv"}
		]
                                       
	});
	
	uploader.bind('UploadProgress',function(up, file){
		$('#'+file.id).find('.bar').css('width',file.percent+"%");
		
	});

	uploader.init();
	
	uploader.bind('FilesAdded',function(up,files) {
		var filelist = $('#filelist');
		for(var i in files){
			var file = files[i]
			filelist.prepend('<div id="'+file.id+'" class="file">'+file.name+' ('+plupload.formatSize(file.size)+')<div class="progress progress-striped active"><div class="bar"></div></div></div>');
		}
		$('#droparea').removeClass('hover');
		uploader.start();
		uploader.refresh();
	});
	
	uploader.bind('Error',function(up,err){
		$('#box-erreur').find('.modal-body>p').html('').html(err.message);
		$('#box-erreur').modal('show');
		$('#droparea').removeClass('hover');
		uploader.start();
		uploader.refresh();
	});
	
	uploader.bind('FileUploaded',function(up,file,response){
		data = jQuery.parseJSON(response.response);
		if(data.error) {
			$('#'+file.id).addClass('alert').html('').html(data.message);
		}
		else {
			$('#'+file.id).addClass('alert').addClass('alert-info').html('').html('<img class="chargement" src="<?php echo img_url("ajax-loader.gif"); ?>">Traitement en cours ... <span class="nb-disque"><strong class="act-nb-dis">0</strong>/'+data.nombre+' disques analysés.');
			
			decompte(file,0,data.nombre);
			$.ajax({
				url : "<?php echo base_url().index_page().'/importer/traitement/'; ?>"+data.name,
				success: function(rep,textStatus,jqXHR) {
					dataRetour = jQuery.parseJSON(rep);
					if(dataRetour.error)
						$('#'+file.id).removeClass('alert-info').removeClass('file').addClass('alert-error').html('').html('<a class="close" data-dismiss="alert" href="#">&times;</a>'+dataRetour.message);
					else 
						$('#'+file.id).removeClass('alert-info').removeClass('file').addClass('alert-success').html('').html('<a class="close" data-dismiss="alert" href="#">&times;</a>'+dataRetour.message);
					
				}
				});
		}
		
	});
	function decompte(file,pos,nb) {
		$('#'+file.id).find('.act-nb-dis').html('').html(pos);
		if(pos<nb){
			setTimeout(function(){decompte(file,pos+1,nb);},2);
		}
	}
	
	jQuery(function($) {
		
		$('#droparea').bind({
			dragover : function(e) {
				$(this).addClass('hover');
			},
			dragleave : function(e) {
				$(this).removeClass('hover');
			}
		});
	});
  </script>
  <?php } ?>
  <!-- This would be a good place to use a CDN version of jQueryUI if needed -->
	<?php echo Assets::js(); ?>

</body>
</html>
