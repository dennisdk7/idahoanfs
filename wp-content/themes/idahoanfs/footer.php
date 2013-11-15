			<section id="promo">
				<article id="promoSearch">
					<h3>Where to buy</h3>
					<form action="<?php echo home_url(); ?>/buy/" method="post" accept-charset="utf-8">
						<div class="formSearch">
							<input name="zipcode" value="" placeholder="Enter a Zip Code">
						</div>
						<p><input type="submit" name="" value="Search" id="search" class="submit clearfix redButton"></p>
					</form> 

					<span class="salesMaterials"><a href="<?php echo home_url(); ?>/buy/media">View Sales Materials</a></span>
				</article>
				<article id="vidPromo">
					<a class="homeVideo cboxElement" href="http://www.youtube.com/embed/s3NePZS3P60?rel=0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/feature-3.jpg" height="94" width="120" alt=""></a>
					<h4>Watch Our Video</h4>
					<p><a class="homeVideo cboxElement" href="http://www.youtube.com/embed/s3NePZS3P60?rel=0">This is your chance to see where real Idaho<sup>®</sup> potatoes come from</a>.</p>
				</article>
				<article id="promoFeed">
					<?php dynamic_sidebar('Bottom Right Promo Box Widget'); ?>
				</article>
			</section>

		</div><!-- #main -->

		<footer>
			<?php //ADD WORDPRESS CUSTOM MENU
		    	wp_nav_menu( array( 'container' => false, 'menu_class' => 'nav', 'theme_location' => 'footer', 'fallback_cb' => 'false' ) );
		    ?>
		    <a href="http://idahoan.com/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/idahoan.jpg" alt="Idahoan" class="footerLogo"></a>
			<span>Copyright <?php echo date('Y'); ?> Idahoan. All Rights Reserved</span>
			<ul id="socMed">
				<li><a href="http://twitter.com/#!/IdahoanFoods"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/twitter.png" alt="Twitter"></a></li>
				<li><a href="http://www.linkedin.com/company/103649?trk=tyah"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/linkedin.jpg" alt="LinkedIn"></a></li>
				<li><a href="http://www.facebook.com/idahoanfoods"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/fb.jpg" alt="Facebook"></a></li>
				<li><a href="http://www.youtube.com/user/IdahoanFoods"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/youtube.jpg" alt="Idahoan Youtube"></a></li>
				<li><a href="http://www.famousidahopotatobowl.com/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/idahobowl.png" alt="Idaho Bowl"></a></li>
				<li><a href="http://www.idahopotato.com/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer/idaho.jpg" alt="Idaho Potato Commission"></a></li>
			</ul>

		</footer>

	</div><!-- #container -->

	<?php wp_footer(); ?>

<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
	 
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->
	
</body>

</html>
