<?php get_header(); ?>

	<section id="oneCol">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<section id="content" class="clearfix post-<?php the_ID(); ?>">

				<div id="breadCrumbTrail"> <a href="<?php echo home_url(); ?>/menu-ideas">Idahoan® Menu Ideas</a> » <?php the_title(); ?></div>

				<div id="pageContents">

					<hgroup id="contentTitle">
						<h1 class="fn"><?php the_title(); ?></h1>
					</hgroup>

					<section id="productInfo" class="hrecipe clearfix">

						<article id="productLeft">
								<div id="productImage">
									<?php the_post_thumbnail('products', array('class' => 'photo')); ?>
								</div>
						</article>

						<article id="productRight">
								<?php the_content(); ?>
						</article>
									
						<?php edit_post_link('Edit this entry','','.'); ?>

					</section>
				
				</div><!-- #pageContents -->

			</section>

		<?php endwhile; endif; ?>

	</section>
	
<?php get_footer(); ?>