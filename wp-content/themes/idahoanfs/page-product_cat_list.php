<?php /**
 * Template Name: Product Category List
 *
 */ ?>

<?php get_header(); ?>

<?php idahoan_page_header(get_post_meta($post->ID, 'idahoan_page_header', true)); ?>

<section id="oneCol">

	<?php $args = array(
		'depth'        => 0,
		'child_of'     => 4,
		'exclude'      => '685',
		'title_li'     => '',
		'echo'         => 1,
		'sort_column'  => 'menu_order, post_title',
		'post_type'    => 'page',
	    'post_status'  => 'publish' 
	); ?>

	<?php if (!is_page('faqs')) : ?>
		<section id="subNavigation" class="clearfix">
			<ul class="subNav">
				<li class="<?php if (is_page('products')) { echo 'current_page_item'; } ?>"><a href="<?php echo home_url(); ?>/products/">All Products*</a></li>
				<?php wp_list_pages( $args ); ?>
			</ul>
		</section>
	<?php endif; ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<section id="content" class="clearfix post-<?php the_ID(); ?>">

				<?php the_content(); ?>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		</section>

	<?php endwhile; endif; ?>

</section>

<?php get_footer(); ?>
