<?php /**
 * Template Name: Sales Materials
 *
 */ ?>

<?php get_header(); ?>

<?php idahoan_page_header(get_post_meta($post->ID, 'idahoan_page_header', true)); ?>

<section id="oneCol">

	<section id="content" class="clearfix salesmaterial">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<h1><?php the_title(); ?></h1>
			<a href="http://get.adobe.com/reader/" target="_blank" class="adobe">Get Adobe Reader</a>

			<?php the_content(); ?>

		<?php endwhile; endif; ?>

		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

	</section>

</section>

<?php get_footer(); ?>
