<?php /**
 * Template Name: Filterable Recipe List Page
 *
 */ ?>

<?php get_header(); ?>

<?php idahoan_page_header(get_post_meta($post->ID, 'idahoan_page_header', true)); ?>

<section id="oneCol">

	<?php include (TEMPLATEPATH . '/_/inc/recipe-search.php' ); ?>

	<section id="content" class="clearfix post-<?php the_ID(); ?>">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; endif; ?>

		<?php wp_reset_query(); ?>

		<?php global $wp_query; ?>

		<?php if ($_POST) : ?>

			<?php query_posts( array( 'post_type' => 'idahoan_recipes', 'order' => "ASC", 'posts_per_page' => 10, 'paged' => $paged, 'tax_query' => array(
		array(
			'taxonomy' => 'recipe_category',
			'field' => 'id',
			'terms' => $recipeTerms,
			'operator' => $operator
		)) ) ); ?>
		<?php else : ?>
			<?php query_posts( array( 'post_type' => 'idahoan_recipes', 'order' => "ASC", 'posts_per_page' => 10, 'paged' => $paged ) ); ?>
		<?php endif; ?>

			<ul id="recipeListNew">
		
			<?php $counter = 1; ?>	
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<li class="clearfix<?php if ($counter % 2 == 0) { echo ' last'; } ?>"> 
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('recipes', array('class' => 'photo')); ?></a><h3>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php if (has_excerpt()) : ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>
				</li>

				<?php $counter++; ?>

			<?php endwhile; endif; ?>
		</ul>

		<?php wp_pagenavi(); ?>

		<?php edit_post_link('Edit this entry.', '<p class="clearfix">', '</p>'); ?>

	</section>

</section>

<?php get_footer(); ?>