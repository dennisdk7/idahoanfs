<?php /**
 * Template Name: Recipe List Page
 *
 */ ?>

<?php get_header(); ?>

<?php idahoan_page_header(get_post_meta($post->ID, 'idahoan_page_header', true)); ?>

<section id="oneCol">

	<section id="content" class="clearfix post-<?php the_ID(); ?>">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; endif; ?>

		<?php wp_reset_query(); ?>

		<?php global $wp_query; ?>

		<?php query_posts( array( 'post_type' => 'idahoan_recipes', 'order' => "ASC", 'posts_per_page' => 20, 'paged' => $paged ) ); ?>
		<?php $counter = 1; ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<ul id="recipeList">

				<li class="clearfix"> 
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('product-list-thumb', array('class' => 'photo')); ?></a><h3>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php if (has_excerpt()) : ?>
							<?php the_excerpt(); ?>
						<?php endif; ?>
				</li>

				<?php $counter++; ?>

			<?php endwhile; endif; ?>

			</ul>

		<nav>
		    <?php previous_posts_link('&laquo; Newer') ?>
		    <?php next_posts_link('Older &raquo;') ?>
		</nav>

		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

	</section>

</section>

<?php get_footer(); ?>
