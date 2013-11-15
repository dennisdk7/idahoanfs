<?php /**
 * Template Name: Nutrition Main Page (with table)
 *
 */ ?>

<?php get_header(); ?>

<?php idahoan_page_header(get_post_meta($post->ID, 'idahoan_page_header', true)); ?>

<section id="oneCol">

	<?php $args = array(
		'depth'        => 0,
		'child_of'     => 161,
		'exclude'      => '',
		'title_li'     => '',
		'echo'         => 1,
		'sort_column'  => 'menu_order, post_title',
		'post_type'    => 'page',
	    'post_status'  => 'publish' 
	); ?>

	<section id="subNavigation" class="clearfix">
		<ul class="subNav">
			<li class="<?php if (is_page('nutrition')) { echo 'current_page_item'; } ?>"><a href="<?php echo home_url(); ?>/nutrition/">All Categories</a></li>
			<?php wp_list_pages( $args ); ?>
		</ul>
	</section>

	<section id="content" class="clearfix post-<?php the_ID(); ?>">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		<?php endwhile; endif; ?>

		<?php wp_reset_query(); ?>

		<?php $idahoan_products_query = new WP_Query( array( 'post_type' => 'idahoan_products', 'order' => "ASC", 'posts_per_page' => '-1' ) ); ?>

		<?php include (TEMPLATEPATH . '/_/inc/page-actions.php' ); ?>

		<div class="PrintArea">
			<table id="compareChart" cellspacing="0" border="0" cellpadding="0">
				<thead>
					<tr><th>Products</th><th>Fortified</th><th>Gluten Free</th><th>Halal</th><th>Kosher</th><th>Kosher D</th><th>Low Sodium</th><th>0 Trans Fat Grams</th><th>No BHA/BHT</th></tr>
				</thead>

				<tbody>
				<?php if ( $idahoan_products_query->have_posts() ) : while ( $idahoan_products_query->have_posts() ) : $idahoan_products_query ->the_post(); ?>
					<tr>
						<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
						<td><?php if(has_term('fortified', 'product_category')) : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-mark.png" alt=""><?php endif; ?></td>
						<td><?php if(has_term('gluten-free', 'product_category')) : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-mark.png" alt=""><?php endif; ?></td>
						<td><?php if(has_term('halal', 'product_category')) : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-mark.png" alt=""><?php endif; ?></td>
						<td><?php if(has_term('kosher', 'product_category')) : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-mark.png" alt=""><?php endif; ?></td>
						<td><?php if(has_term('kosher-d', 'product_category')) : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-mark.png" alt=""><?php endif; ?></td>
						<td><?php if(has_term('low-sodium', 'product_category')) : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-mark.png" alt=""><?php endif; ?></td>
						<td><?php if(has_term('zero-trans-fat-grams', 'product_category')) : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-mark.png" alt=""><?php endif; ?></td>
						<td><?php if(has_term('no-bha-bht', 'product_category')) : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-mark.png" alt=""><?php endif; ?></td>
					</tr>

				<?php endwhile; endif; ?>

				</tbody>
			</table>
		</div>

	</section><!-- #content -->

	<?php if (is_page('nutrition')) : ?>
		<section id="emailOverlay" style="display: none; ">
			<section id="emailContent">
				<article id="emailForm" class="clearfix">

					<div><div class="floatR emailClose"><a href="">Close</a></div></div>

					<h1>Email Nutrition Chart</h1>

					<form id="email-nutrition-info" action="#">
						<label for="email">Send To</label>
						<input type="email" name="email" value="" id="email">
						<input type="submit" class="submit clearfix redButton" name="submit" value="Send Email">
					</form>

					<div id="message"></div>

				</article>
			</section>
		</section>
	<?php endif; ?>

</section>

<?php get_footer(); ?>
