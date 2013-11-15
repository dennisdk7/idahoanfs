<?php /**
 * Template Name: Solutions Page
 *
 */ 


	if (is_page('361')) {
		$leftColHeading = 'for K-12 Schools';
		$productCat = 'k-12';
	} else if (is_page('367')) {
		$leftColHeading = 'for Restaurants';
		$productCat = 'restaurants';
	} else if (is_page('373')) {
		$leftColHeading = 'for Colleges & Universities';
		$productCat = 'colleges-universities';
	} else if (is_page('388')) {
		$leftColHeading = 'for Military';
		$productCat = 'military';
	} else if (is_page('393')) {
		$leftColHeading = 'for Business & Industry';
		$productCat = 'business-industry';
	} else if (is_page('398')) {
		$leftColHeading = 'for Hospitality';
		$productCat = 'hospitality';
	} else if (is_page('402')) {
		$leftColHeading = 'for Healthcare';
		$productCat = 'healthcare';
	} else {
		$leftColHeading = '';
	}
?>

<?php get_header(); ?>

	<section id="twoCol">

		<aside id="leftPromo" class="clearfix">
			<article id="leftContent">

				<?php $idahoan_product_query = new WP_Query( array( 'post_type' => 'idahoan_products', 'product_category' => $productCat, 'orderby' => 'rand', 'posts_per_page' => '2' ) ); ?>

				<h3>Featured Products <?php echo $leftColHeading; ?></h3>

				<ul>
					<?php if ( $idahoan_product_query->have_posts() ) : while ( $idahoan_product_query->have_posts() ) : $idahoan_product_query ->the_post(); ?>

						<li> 
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('products'); ?></a>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<?php the_excerpt(); ?>
						</li>

					<?php endwhile; endif; ?>

					<?php wp_reset_query(); ?>
				</ul>

				</article> <article id="leftPromoBottom"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/left-promo-bottom.jpg" alt="" title="">
			</article>
		</aside>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<section id="content" class="clearfix post-<?php the_ID(); ?>">

				<h1 class="noHero"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/solutions-icon.jpg" alt="" title=""><?php the_title(); ?></h1>
				<?php the_content(); ?>

				<?php endwhile; endif; ?>

				<?php wp_reset_query(); ?>

				<?php $idahoan_recipes_query = new WP_Query( array( 'post_type' => 'idahoan_recipes', 'orderby' => 'rand', 'posts_per_page' => '2' ) ); ?>

				<h2>Featured Recipes</h2>

				<ul id="featRecipe">
					<?php if ( $idahoan_recipes_query->have_posts() ) : while ( $idahoan_recipes_query->have_posts() ) : $idahoan_recipes_query ->the_post(); ?>

						<li> 
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('products', array('class' => ' alignright photoTrim')); ?></a>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div><?php the_content(); ?></div>
						</li>

					<?php endwhile; endif; ?>
				</ul>

				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

			</section>

	</section>

<?php get_footer(); ?>
