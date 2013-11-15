<?php 
	$nutrititionSearchTerm = $_GET['nutrition'];
	$category = $_GET['category'];

	if ($nutrititionSearchTerm == '' && $category != '') {
		$nutrititionSearchTerm = $category;
	}

	if ($category == '' && $nutrititionSearchTerm != '') {
		$category = $nutrititionSearchTerm;
	}

?>

<?php get_header(); ?>

	<section id="oneCol">

		<section id="content">

			<?php $args = array(
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_category',
						'field' => 'slug',
						'terms' => 'gluten-free'
					),
					array(
						'taxonomy' => 'product_category',
						'field' => 'slug',
						'terms' => 'hashbrowns',
						'operator' => 'IN'
					)
				)
			); ?>

		<?php $search_query = new WP_Query( $args ); ?>

		<?php if ($search_query->have_posts() ) : ?>

			<h1>Search Results</h1>

			<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

			<ul id="productList">

				<?php while ($search_query->have_posts()) : $search_query->the_post(); ?>

					<li class="clearfix">

						<?php the_post_thumbnail('product-list-thumb'); ?>

						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

						<?php the_excerpt(); ?>

					</li>

				<?php endwhile; ?>

				<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

			<?php else : ?>

				<h2>No posts found.</h2>

			</ul>

			<?php endif; ?>

		</section>

	</section>

<?php get_footer(); ?>
