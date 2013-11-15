<?php /**
 * Template Name: Product Search
 *
 */ ?>

<?php

	$home_url = get_home_url();

	$keywords = strtolower($_GET['keywords']); 
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

		<section id="searchBar">
			<h1>Search</h1><br><br>
			<form action="<?php echo get_home_url(); ?>/search" method="get" accept-charset="utf-8">
				<div class="formSearch"><input name="keywords" value="<?php echo $keywords; ?>" id="keywords" placeholder="Search"></div>
				<select name="nutrition" id="nutrition" size="1">
					<option value="">Nutritional Info</option>
					<option value="fortified" <?php if ($nutrititionSearchTerm == 'fortified') {echo 'selected=selected';} ?>>Fortified</option>
					<option value="gluten-free" <?php if ($nutrititionSearchTerm == 'gluten-free') {echo 'selected=selected';} ?>>Gluten Free</option>
					<option value="halal" <?php if ($nutrititionSearchTerm == 'halal') {echo 'selected=selected';} ?>>Halal</option>
					<option value="kosher" <?php if ($nutrititionSearchTerm == 'kosher') {echo 'selected=selected';} ?>>Kosher</option>
					<option value="kosher-d" <?php if ($nutrititionSearchTerm == 'kosher-d') {echo 'selected=selected';} ?>>Kosher D</option>
					<option value="low-sodium" <?php if ($nutrititionSearchTerm == 'low-sodium') {echo 'selected=selected';} ?>>Low Sodium</option>
					<option value="zero-trans-fat-grams" <?php if ($nutrititionSearchTerm == 'zero-trans-fat-grams') {echo 'selected=selected';} ?>>0 Trans Fat Grams</option>
					<option value="no-bha-bht" <?php if ($nutrititionSearchTerm == 'no-bha-bht') {echo 'selected=selected';} ?>>No BHA/BHT</option>
					<option value="allergens" <?php if ($nutrititionSearchTerm == 'allergens') {echo 'selected=selected';} ?>>Allergens</option>
				</select>
				<select name="category" id="category" size="1">
					<option value="">Category</option>
					<option value="real" <?php if ($category == 'real') {echo 'selected=selected';} ?>>REAL Mashed</option>
					<option value="premium" <?php if ($category == 'premium') {echo 'selected=selected';} ?>>Premium Mashed</option>
					<option value="signature" <?php if ($category == 'signature') {echo 'selected=selected';} ?>>Signature Mashed</option>
					<option value="value-advantage" <?php if ($category == 'value-advantage') {echo 'selected=selected';} ?>>Value Advantage</option>
					<option value="casseroles" <?php if ($category == 'casseroles') {echo 'selected=selected';} ?>>Casseroles</option>
					<option value="hashbrowns" <?php if ($category == 'hashbrowns') {echo 'selected=selected';} ?>>Fresh Cut Hash Browns</option>
				</select>
				<p><input type="submit" class="redButton" value="Search"></p>
			</form>
		</section>

		<section id="content">

		<h1>Search Results</h1>

			<?php if ($nutrititionSearchTerm != '' || $category != '') {
				$args = array(
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'product_category',
							'field' => 'slug',
							'terms' => $nutrititionSearchTerm
						),
						array(
							'taxonomy' => 'product_category',
							'field' => 'slug',
							'terms' => $category,
							'operator' => 'IN'
						)
					),
					'posts_per_page' => -1
				);
			} ?>

			<?php if ($category == '' && $nutrititionSearchTerm == '') {
				$args = array( 
					'post_type' => 'idahoan_products',
					'order' => "ASC",
					'posts_per_page' => -1
				);
			} ?>

			<?php $search_query = new WP_Query( $args ); ?>

			<?php if ($search_query->have_posts()) : ?>

				<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

				<ul id="productList">

					<?php if ($keywords == '') : ?>
						<?php while ($search_query->have_posts()) : $search_query->the_post(); ?>
						
							<li class="clearfix">

								<?php the_post_thumbnail('product-list-thumb'); ?>

								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

								<?php the_excerpt(); ?>
							</li>
						<?php endwhile; ?>
					<?php endif; ?>

					<?php if ($keywords != '') : ?>
						<?php $count = 0; ?>
						<?php while ($search_query->have_posts()) : $search_query->the_post(); ?>
							<?php if (strpos(strtolower(get_the_title()), $keywords) !== false) : ?>
								<li class="clearfix">

									<?php the_post_thumbnail('product-list-thumb'); ?>

									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

									<?php the_excerpt(); ?>

									<?php $count++; ?>
								</li>
							<?php endif; ?>
						<?php endwhile; ?>
						<?php if ($count < 1) : ?>
							<li class="defaultMessage"> No results were found per your search criteria. Please search again or browse one of the following categories.
								<ul class="arrowList"> 
									<li><a href="<?php echo get_permalink( '122' ); ?>">Premium Mashed</a></li> 
									<li><a href="<?php echo get_permalink( '133' ); ?>">REAL Mashed</a></li>	 
									<li><a href="<?php echo get_permalink( '140' ); ?>">Signature Mashed</a></li>	 
									<li><a href="<?php echo get_permalink( '143' ); ?>">Value Advantage</a></li>	 
									<li><a href="<?php echo get_permalink( '151' ); ?>">Casseroles</a></li>	 
									<li><a href="<?php echo get_permalink( '156' ); ?>">Fresh Cut Hash Browns</a></li>
								</ul>
							</li>
						<?php endif; ?>
					<?php endif; ?>

					<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

				</ul>

			<?php else: ?>

				<ul id="productList">
					<li class="defaultMessage"> No results were found per your search criteria. Please search again or browse one of the following categories.
						<ul class="arrowList"> 
							<li><a href="<?php echo get_permalink( '122' ); ?>">Premium Mashed</a></li> 
							<li><a href="<?php echo get_permalink( '133' ); ?>">REAL Mashed</a></li>	 
							<li><a href="<?php echo get_permalink( '140' ); ?>">Signature Mashed</a></li>	 
							<li><a href="<?php echo get_permalink( '143' ); ?>">Value Advantage</a></li>	 
							<li><a href="<?php echo get_permalink( '151' ); ?>">Casseroles</a></li>	 
							<li><a href="<?php echo get_permalink( '156' ); ?>">Fresh Cut Hash Browns</a></li>
						</ul>
					</li>
				</ul>

			<?php endif; ?>


		</section>

	</section>

<?php get_footer(); ?>
