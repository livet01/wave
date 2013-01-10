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

  <!-- This would be a good place to use a CDN version of jQueryUI if needed -->
	<?php echo Assets::js(); ?>

</body>
</html>
