<?php /**
 * Template Name: Try Free Promo
 *
 */ ?>

<?php get_header(); ?>

	<?php idahoan_page_header(get_post_meta($post->ID, 'idahoan_page_header', true)); ?>

	<section id="oneCol" class="promo-page">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<section id="content" class="clearfix post-<?php the_ID(); ?>">

					<?php the_content(); ?>

				<?php edit_post_link('Edit this entry.', '<p class="clear">', '</p>'); ?>

			</section>

		<?php endwhile; endif; ?>

	</section>

<?php get_footer(); ?>
