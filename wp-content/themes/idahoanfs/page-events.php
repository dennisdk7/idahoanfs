<?php /**
 * Template Name: Events Page
 *
 */ ?>

<?php get_header(); ?>

<section id="oneCol">

	<section id="content" class="clearfix post-<?php the_ID(); ?>">

		<h1 class="noHero"><?php the_title(); ?></h1>

		<?php query_posts( 'cat=1' ); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<ul class="events-list">
				<li>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>">View More Details >></a>
				</li>
			</ul>

		<?php endwhile; endif; ?>

		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

	</section>

</section>

<?php get_footer(); ?>
