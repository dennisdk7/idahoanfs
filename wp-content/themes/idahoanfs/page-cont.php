<?php get_header(); ?>

	<?php idahoan_page_header(get_post_meta($post->ID, 'idahoan_page_header', true)); ?>

	<section id="oneCol">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<section id="content" class="clearfix post-<?php the_ID(); ?>">

					<?php the_content(); ?>

					<form action="/company/contact/save" method="post" id="contact_form" class="contactForm">
						<ul>
							<li><label for="first_name">First Name <span class="required">*</span></label><br>
							<input type="text" name="first_name" value="" id="first_name" class="required active"></li>
							
							<li><label for="last_name">Last Name <span class="required">*</span></label><br>
							<input type="text" name="last_name" value="" id="last_name" class="required active"></li>
							
							<li><label for="email">Email <span class="required">*</span></label><br>
							<input type="text" name="email" value="" id="email" class="required active"></li>

							<li><label for="phone">Phone </label><br>
							<input type="text" name="phone" value="" id="phone" class="required active">
							</li>
						</ul>

						<div class="floatL"><label for="comment">Comment</label><br>
							<textarea name="comment" id="comment"></textarea>
						</div>

						<div class="floatL fullRow"> <input class="checkbox" type="checkbox" name="certify" id="certify" value="1">
							<label for="certify">I certify that I am 18 years or older <span class="required">*</span></label>
						</div>
						<div class="floatL">
							<input type="submit" name="" value="Contact Us" id="contact_us" class="submit clearfix redButton">
						</div>
					</form>

				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

			</section>

		<?php endwhile; endif; ?>

	</section>

<?php get_footer(); ?>
