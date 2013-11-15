<?php /**
 * Template Name: Where To Buy (broker search)
 *
 */

	if ($_POST['zipcode'] != '') {
		$zipCode = $_POST['zipcode'];

		if ($zipCode == '') {
			$displayNote = '<span class="error">The Zip Code field is required.</span>';
		} else if (strlen($zipCode) < 5 ) {
			$displayNote = '<span class="error">The Zip Code field must be at least 5 characters in length.</span>';
		} else if (strlen($zipCode) > 5 ) {
			$displayNote = '<span class="error">The Zip Code field can not exceed 5 characters in length.</span>';
		}
		else {
			$displayNote = '<article>Showing Brokers in ' . $zipCode . '</article>';
			$validSearch = true;
		}
		
		// Run stateByZipcode function to see which state the zipcode corresponds to. Returns the state abbreviation.
		$stateByZipCode = test_zipcode($zipCode);

		// Set the regional business manager ID based on what state was chosen
		$west = array('AK', 'WA', 'OR', 'CA', 'HI', 'NV', 'UT', 'ID'); // Brian Smith
		$default = array('MT', 'WY', 'CO', 'AZ', 'NM', 'TX', 'OK'); // Tom Zilligen:
		$central = array('ND', 'SD', 'NE', 'KS', 'MN', 'IA', 'MO', 'WI', 'IL', 'IN', 'MI'); // Dudley Whiteley
		$east = array('OH', 'KY', 'WV', 'VA', 'PA', 'MD', 'DE', 'NJ', 'CT', 'RI', 'NY', 'MA', 'VT', 'NH', 'ME'); // Carlton Bird
		$southEast = array('AR', 'LA', 'MS', 'AL', 'TN', 'GA', 'FL', 'SC', 'NC'); // Ron Shillings
		
		if (in_array($stateByZipCode, $west)) {
		    $regionalBusinessManagerID = '1052';
		}
		if (in_array($stateByZipCode, $default)) {
		    $regionalBusinessManagerID = '1057';
		}
		if (in_array($stateByZipCode, $central)) {
		    $regionalBusinessManagerID = '1056';
		}
		if (in_array($stateByZipCode, $east)) {
		    $regionalBusinessManagerID = '1054';
		}
		if (in_array($stateByZipCode, $southEast)) {
		    $regionalBusinessManagerID = '1055';
		}

	}


?>

<?php get_header(); ?>

<?php idahoan_page_header(get_post_meta($post->ID, 'idahoan_page_header', true)); ?>

<section id="oneCol">

	<section id="content" class="clearfix post-<?php the_ID(); ?>">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; endif; ?>

		<section>
			<div id="brokerSearch">
				<form action="" method="post" accept-charset="utf-8">
					<div class="formSearch">
						<input name="zipcode" id="buySearch" value="" placeholder="Enter a Zip Code">
					</div>
					<input type="submit" name="" value="Search" id="search" class="submit clearfix redButton">
				</form>
			</div>
			<?php echo $displayNote; ?>
		</section>

		<ul id="brokerList">
			<li class="header">Brokers</li>

			<?php $idahoan_brokers_query = new WP_Query( array( 'post_type' => 'idahoan_brokers', 'tax_query' => array( array('taxonomy' => 'broker_category', 'field' => 'slug', 'terms' => 'brokers')), 'order' => "ASC", 'posts_per_page' => '-1' ) ); ?>

			<?php while ( $idahoan_brokers_query->have_posts() && $validSearch == true ) : $idahoan_brokers_query ->the_post(); ?>

				<?php
					// Get the broker meta option values and store in variables
			        $contact_phone = get_post_meta($post->ID, 'idahoan_contact_phone', true);
			        $contact_email = get_post_meta($post->ID, 'idahoan_contact_email', true);
			        $contact_company = get_post_meta($post->ID, 'idahoan_contact_company', true);
			        $contact_company_address = get_post_meta($post->ID, 'idahoan_contact_company_address', true);
			        $contact_company_city = get_post_meta($post->ID, 'idahoan_contact_company_city', true);
			        $contact_company_state = get_post_meta($post->ID, 'idahoan_contact_company_state', true);
			        $contact_company_zip = get_post_meta($post->ID, 'idahoan_contact_company_zip', true);
			        $states_serviced = explode(' ', get_post_meta($post->ID, 'idahoan_states_serviced', true));

					//print_r($states_serviced);

			        $counter = 0;
	        	?>
				<?php if (in_array($stateByZipCode, $states_serviced)) : ?>
				<li>
					<?php the_post_thumbnail('broker-thumb', array('class' => 'logo')); ?>
					<div class="brokerLeftCol">
						<strong><?php echo $contact_company; ?></strong><br>
						<?php echo $contact_company_address; ?><br>
						<?php echo $contact_company_city; ?> <?php echo $contact_company_state; ?> <?php echo $contact_company_zip; ?><br>
					</div>
					<div class="brokerRightCol">
						contact: <?php the_title(); ?>
						<?php if($contact_phone != '') {echo '<br>phone: ' . $contact_phone;} ?>
						<?php if($contact_email != '') {echo '<br>email: ' . $contact_email;} ?>
					</div>

					<?php if ($contact_email != '') : ?>
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/envelope.png" class="envelope" alt="Email <?php echo $contact_company; ?>">
						
						<div class="mailContactForm" style="display: none; ">
							<form action="<?php echo get_stylesheet_directory_uri(); ?>/_/functions/formProcessor.php" method="post" class="broker_contact_form validate_contact">
								<input type="hidden" name="broker" value="1">
								<input type="hidden" name="zipcode" value="<?php echo $zipCode; ?>" id="zipcode">
								<input type="hidden" name="contact_email" value="<?php echo $contact_email; ?>" id="contact_email">

								<ul>
									<li><label for="name">Name <span class="required">*</span></label><br>
									<input type="text" name="name" value="" id="name" class="required active"> </li>
									<li><label for="email">Email <span class="required">*</span></label><br>
									<input type="text" name="email" value="" id="email" class="required active">
									</li>
									<li><label for="phone">Phone</label><br>
									<input type="text" name="phone" value="" id="phone" class="required active">
									</li>
									<li> <br><input class="checkbox" type="checkbox" name="certify" id="certify" value="1"><label for="certify">I certify that I am 18 years or older <span class="required">*</span></label>
									</li>
								</ul>
								<div class="clearL">
									<input type="submit" name="" value="Send Info" id="contact_us" class="submit clearfix redButton">
								</div>
							</form>
						</div>
					<?php endif; ?>

				</li>
				<?php endif; $counter++; ?>
			<?php endwhile; ?>

			<?php if ($validSearch == true && $counter == 0) : ?>
				<li class="defaultMessage">No Brokers serve the zip code <?php echo $zipCode; ?>.</li>
			<?php elseif ($_POST['zipcode'] == '') : ?>
				<li class="defaultMessage">Use the search above to find a broker in your zip code</li>
			<?php endif; ?>

		</ul>

		<ul id="bdmList">
			<li class="header">Regional Business Managers</li>

			<?php $idahoan_regional_brokers_query = new WP_Query( array( 'post_type' => 'idahoan_brokers', 'p' => $regionalBusinessManagerID, 'tax_query' => array( array('taxonomy' => 'broker_category', 'field' => 'slug', 'terms' => 'regional-business-managers')), 'order' => "ASC", 'posts_per_page' => '1' ) ); ?>

			<?php while ( $idahoan_regional_brokers_query->have_posts() && $validSearch == true ) : $idahoan_regional_brokers_query ->the_post(); ?>


				<?php
					// Get the broker meta option values and store in variables
			        $contact_phone = get_post_meta($post->ID, 'idahoan_contact_phone', true);
			        $contact_email = get_post_meta($post->ID, 'idahoan_contact_email', true);
			        $contact_company = get_post_meta($post->ID, 'idahoan_contact_company', true);
	        	?>

				<li>
					<strong><?php echo $contact_company; ?></strong><br>
					<div id="dbmLeft">
						contact: <?php the_title(); ?>
						<?php if ($contact_phone != ''){ echo '<br>phone: ' . $contact_phone; } ?>
						<?php if ($contact_email != ''){ echo '<br>email: ' . $contact_email; } ?>
					</div>
					<?php if ($contact_email != '') : ?>
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/envelope.png" class="envelope" alt="Email Idahoan® Regional Business Manager">
						<div class="mailContactForm">
							<form action="<?php echo get_stylesheet_directory_uri(); ?>/_/functions/formProcessor.php" method="post" id="rbm_form" class="validate_contact">
								<input type="hidden" name="broker" value="1">
								<input type="hidden" name="zipcode" value="<?php echo $zipCode; ?>" id="zipcode">
								<input type="hidden" name="contact_email" value="<?php echo $contact_email; ?>" id="contact_email">
								<ul> 
									<li><label for="name">Name <span class="required">*</span></label><br>
										<input type="text" name="name" value="" id="name" class="required active">
									</li> 
									<li><label for="email">Email <span class="required">*</span></label><br>
										<input type="text" name="email" value="" id="email" class="required active">
									</li> 
									<li><label for="phone">Phone </label><br>
										<input type="text" name="phone" value="" id="phone" class="required active">
									</li> 
									<li><input class="checkbox" type="checkbox" name="certify" id="certify" value="1"> <label for="certify">I certify that I am 18 years or older <span class="required">*</span></label>
									</li>
								</ul>
								<div class="clearL">
									<input type="submit" name="" value="Send Info" id="contact_us" class="submit clearfix redButton">
								</div>
							</form>
						</div>
					<?php endif; ?>
				</li>

			<?php endwhile; ?>

		</ul>

		<?php edit_post_link('Edit this entry.', '<p class="clear">', '</p>'); ?>

	</section><!-- #content -->

</section>

<?php get_footer(); ?>
