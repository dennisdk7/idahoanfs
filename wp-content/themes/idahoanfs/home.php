<?php /**
 * Template Name: Home Page
 *
 */ ?>

<?php get_header(); ?>

<section id="oneCol">
	<section id="featureSlider">
		<?php include (TEMPLATEPATH . '/_/inc/product-search.php' ); ?>
		<div id="controlsHolder">
			<div id="slider-nav"></div>
			<a href="#" id="rotator_play_pause">||</a>
		</div>
		<?php idahoan_frontpage_slider(); ?>
	</section>

	<section id="features">
		<?php idahoan_homefeature_boxes(); ?>
	</section><!-- #features -->
</section>

<?php get_footer(); ?>
