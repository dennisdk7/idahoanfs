<?php
	$servingSize = get_post_meta($post->ID, 'idahoan_product_serving_size', true);
	$calories = get_post_meta($post->ID, 'idahoan_product_calories', true);
	$caloriesFromFat = get_post_meta($post->ID, 'idahoan_product_calories_from_fat', true);
	$totalFat = get_post_meta($post->ID, 'idahoan_product_total_fat', true);
	$totalFatPercent = get_post_meta($post->ID, 'idahoan_product_total_fat_percent', true);
	$saturatedFat = get_post_meta($post->ID, 'idahoan_product_saturated_fat', true);
	$saturatedFatPercent = get_post_meta($post->ID, 'idahoan_product_saturated_fat_percent', true);
	$transFat = get_post_meta($post->ID, 'idahoan_product_trans_fat', true);
	$transFatPercent = get_post_meta($post->ID, 'idahoan_product_trans_fat_percent', true);
	$cholesterol = get_post_meta($post->ID, 'idahoan_product_cholesterol', true);
	$cholesterolPercent = get_post_meta($post->ID, 'idahoan_product_cholesterol_percent', true);
	$sodium = get_post_meta($post->ID, 'idahoan_product_sodium', true);
	$sodiumPercent = get_post_meta($post->ID, 'idahoan_product_sodium_percent', true);
	$potassium = get_post_meta($post->ID, 'idahoan_product_potassium', true);
	$potassiumPercent = get_post_meta($post->ID, 'idahoan_product_potassium_percent', true);
	$totalCarbs = get_post_meta($post->ID, 'idahoan_product_total_carbs', true);
	$totalCarbsPercent = get_post_meta($post->ID, 'idahoan_product_total_carbs_percent', true);
	$dietaryFiber = get_post_meta($post->ID, 'idahoan_product_dietary_fiber', true);
	$dietaryFiberPercent = get_post_meta($post->ID, 'idahoan_product_dietary_fiber_percent', true);
	$sugars = get_post_meta($post->ID, 'idahoan_product_sugars', true);
	$sugarsPercent = get_post_meta($post->ID, 'idahoan_product_sugars_percent', true);
	$protein = get_post_meta($post->ID, 'idahoan_product_protein', true);
	$proteinPercent = get_post_meta($post->ID, 'idahoan_product_protein_percent', true);
	$vitA = get_post_meta($post->ID, 'idahoan_product_vit_a', true);
	$vitAPercent = get_post_meta($post->ID, 'idahoan_product_vit_a_percent', true);
	$vitC = get_post_meta($post->ID, 'idahoan_product_vit_c', true);
	$vitCPercent = get_post_meta($post->ID, 'idahoan_product_vit_c_percent', true);
	$calcium = get_post_meta($post->ID, 'idahoan_product_calcium', true);
	$calciumPercent = get_post_meta($post->ID, 'idahoan_product_calcium_percent', true);
	$iron = get_post_meta($post->ID, 'idahoan_product_iron', true);
	$ironPercent = get_post_meta($post->ID, 'idahoan_product_iron_percent', true);

	$two_col_nutrition = get_post_meta($post->ID, 'two_col_nutrition', true);

	$prepared_calories = get_post_meta($post->ID, 'idahoan_prepared_product_calories', true);
	$prepared_caloriesFromFat = get_post_meta($post->ID, 'idahoan_prepared_product_calories_from_fat', true);
	$prepared_totalFatPercent = get_post_meta($post->ID, 'idahoan_prepared_product_total_fat_percent', true);
	$prepared_saturatedFatPercent = get_post_meta($post->ID, 'idahoan_prepared_product_saturated_fat_percent', true);
	$prepared_transFatPercent = get_post_meta($post->ID, 'idahoan_prepared_product_trans_fat_percent', true);
	$prepared_cholesterolPercent = get_post_meta($post->ID, 'idahoan_prepared_product_cholesterol_percent', true);
	$prepared_sodiumPercent = get_post_meta($post->ID, 'idahoan_prepared_product_sodium_percent', true);
	$prepared_potassiumPercent = get_post_meta($post->ID, 'idahoan_prepared_product_potassium_percent', true);
	$prepared_totalCarbsPercent = get_post_meta($post->ID, 'idahoan_prepared_product_total_carbs_percent', true);
	$prepared_dietaryFiberPercent = get_post_meta($post->ID, 'idahoan_prepared_product_dietary_fiber_percent', true);
	$prepared_sugarsPercent = get_post_meta($post->ID, 'idahoan_prepared_product_sugars_percent', true);
	$prepared_proteinPercent = get_post_meta($post->ID, 'idahoan_prepared_product_protein_percent', true);
	$prepared_vitAPercent = get_post_meta($post->ID, 'idahoan_prepared_product_vit_a_percent', true);
	$prepared_vitCPercent = get_post_meta($post->ID, 'idahoan_prepared_product_vit_c_percent', true);
	$prepared_calciumPercent = get_post_meta($post->ID, 'idahoan_prepared_product_calcium_percent', true);
	$prepared_ironPercent = get_post_meta($post->ID, 'idahoan_prepared_product_iron_percent', true);


	$size = get_post_meta($post->ID, 'idahoan_product_size', true);
	$sku = get_post_meta($post->ID, 'idahoan_product_sku', true);
	$inUnitedStates = get_post_meta($post->ID, 'idahoan_product_united_states', true);
	$inCanada = get_post_meta($post->ID, 'idahoan_product_canada', true);

	$size2 = get_post_meta($post->ID, 'idahoan_product_size_2', true);
	$sku2 = get_post_meta($post->ID, 'idahoan_product_sku_2', true);
	$inUnitedStates2 = get_post_meta($post->ID, 'idahoan_product_united_states_2', true);
	$inCanada2 = get_post_meta($post->ID, 'idahoan_product_canada_2', true);

	$size3 = get_post_meta($post->ID, 'idahoan_product_size_3', true);
	$sku3 = get_post_meta($post->ID, 'idahoan_product_sku_3', true);
	$inUnitedStates3 = get_post_meta($post->ID, 'idahoan_product_united_states_3', true);
	$inCanada3 = get_post_meta($post->ID, 'idahoan_product_canada_3', true);

?>


<?php get_header(); ?>

	<section id="oneCol">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php // 
			if ($_POST['emailPage'] == 1) {

				//Grab Variables	
				$email = $_POST['email'];
				$emailImage = get_the_post_thumbnail($id, "products");
				
				//to email
				$sendTo = $email;
				$from = 'codyjgacek@gmail.com';
				$subject = "Idahoan Food Service : Product Recommendation";
				$headers = "MIME-Version: 1.0\r\n";
				$headers.= "Content-type: text/html; charset=utf-8\r\n";
				$headers.= "From: Idahoan Food Service <donotreply@idahoanfoodservice.com>";
				
				$message = "<h2>Idahoan Foodservice Product: " . get_the_title() . "</h2>";
				$message .= $emailImage;
				$message .= '<p>' .substr(get_the_content(), 0,250) . ' ...</p>';
				$message .= '<a href="' . get_permalink() . '">View Full Product Description and Nutrition Information >></a>';
				
				$sendProductEmail = mail($sendTo, $subject, $message, $headers);

			} ?>

			<section id="content" class="clearfix post-<?php the_ID(); ?>">

				<div id="breadCrumbTrail">
					<?php include (TEMPLATEPATH . '/_/inc/page-actions.php' ); ?>
					<?php idahoan_breadcrumbs($post->ID); ?>
				</div>
					    
				<div id="pageContents">

					<hgroup id="contentTitle">
						<h1 class="fn"><?php the_title(); ?></h1>
					</hgroup>

					<section id="productInfo" class="hrecipe clearfix">

						<article id="productLeft">
								<div id="productImage">
									<?php the_post_thumbnail('products'); ?>
								</div>

								<div id="nutritionArea">

									<?php if($two_col_nutrition == True) : ?>
										<table border="0" cellspacing="0" cellpadding="0">
											<tbody>
											<tr><td colspan="3" class="thickBorder"> <h4>Nutrition Facts</h4> Serving Size: <?php echo $servingSize; ?>	 </td> </tr>
											<tr><td width="70%"><strong>Amount Per Serving</strong></td><td width="15%" align="right"><strong>Unprepared</strong></td><td width="15%" align="right"><strong>Prepared</strong></td> </tr>
											<tr><td><h6>Calories</h6></td><td class="value"><?php echo $calories; ?></td><td class="value"><?php echo $prepared_calories; ?></td> </tr>
											<tr><td class="indentedInfo noBorder">Calories from fat</td><td class="value noBorder"><?php echo $caloriesFromFat; ?></td><td class="value noBorder"><?php echo $prepared_caloriesFromFat; ?></td> </tr>
											<tr><td colspan="3" class="thickBorder"></td> </tr>
											<tr><td colspan="3" align="right" class="alignR"><strong>% Daily Value*</strong></td> </tr>
											<tr><td><b>Total Fat</b> <?php echo $totalFat; ?>*</td><td class="value"><?php echo $totalFatPercent; ?></td><td class="value"><?php echo $prepared_totalFatPercent; ?></td> </tr>
											<tr><td class="indentedInfo">Saturated Fat <?php echo $saturatedFat; ?></td><td class="value"><?php echo $saturatedFatPercent; ?></td><td class="value"><?php echo $prepared_saturatedFatPercent; ?></td> </tr>
											<tr><td class="indentedInfo">Trans Fat 0g</td><td class="value">&nbsp;</td><td class="value">&nbsp;</td> </tr>
											<tr><td><b>Cholesterol</b> <?php echo $cholesterol; ?></td><td class="value"><?php echo $cholesterolPercent; ?></td><td class="value"><?php echo $prepared_cholesterolPercent; ?></td> </tr>
											<tr><td><b>Sodium</b> <?php echo $sodium; ?></td><td class="value"><?php echo $sodiumPercent; ?></td><td class="value"><?php echo $prepared_sodiumPercent; ?></td> </tr>
											<tr><td><b>Potassium</b> <?php echo $potassium; ?></td><td class="value"><?php echo $potassiumPercent; ?></td><td class="value"><?php echo $prepared_potassiumPercent; ?></td> </tr>
											<tr><td><b>Total Carbohydrates</b> <?php echo $totalCarbs; ?></td><td class="value"><?php echo $totalCarbsPercent; ?></td><td class="value"><?php echo $prepared_totalCarbsPercent; ?></td> </tr>
											<tr><td class="indentedInfo">Dietary Fiber <?php echo $dietaryFiber; ?></td><td class="value"><?php echo $dietaryFiberPercent; ?></td><td class="value"><?php echo $prepared_dietaryFiberPercent; ?></td> </tr>
											<tr><td class="indentedInfo">Sugars <?php echo $sugars; ?></td><td class="value">&nbsp;</td><td class="value">&nbsp;</td> </tr>
											<tr><td class="noBorder"><b>Protein</b> <?php echo $protein; ?></td><td class="value noBorder">&nbsp;</td><td class="value noBorder">&nbsp;</td> </tr>
											<tr><td colspan="3" class="thickBorder"></td> </tr>
											<tr><td>Vitamin A </td><td class="value"><?php echo $vitAPercent; ?></td><td class="value"><?php echo $prepared_vitAPercent; ?></td> </tr>
											<tr><td>Vitamin C </td><td class="value"><?php echo $vitCPercent; ?></td><td class="value"><?php echo $prepared_vitCPercent; ?></td> </tr>
											<tr><td>Calcium</td><td class="value"><?php echo $calciumPercent; ?></td><td class="value"><?php echo $prepared_calciumPercent; ?></td> </tr>
											<tr><td>Iron</td><td class="value"><?php echo $ironPercent; ?></td><td class="value"><?php echo $prepared_ironPercent; ?></td> </tr>
											<tr><td colspan="3" class="noBorder">*Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.</td> </tr>
											</tbody>
										</table>

									<?php else: ?>

									<table border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr><td colspan="2" class="thickBorder"> <h4>Nutrition Facts</h4> Serving Size: <?php echo $servingSize; ?></td></tr>
											<tr><td width="70%"><strong>Amount Per Serving</strong></td> <td width="15%" align="right"><strong></strong></td></tr>
											<tr><td><h6>Calories</h6></td> <td class="value"><?php echo $calories; ?></td></tr>
											<tr><td class="indentedInfo noBorder">Calories from fat</td><td class="value noBorder"><?php echo $caloriesFromFat; ?></td></tr>
											<tr><td colspan="2" class="thickBorder"></td></tr>
											<tr><td colspan="2" align="right" class="alignR"><strong>% Daily Value*</strong></td></tr>
											<tr><td><b>Total Fat</b> <?php echo $totalFat; ?>*</td> <td class="value"><?php echo $totalFatPercent; ?></td></tr>
											<tr><td class="indentedInfo">Saturated Fat <?php echo $saturatedFat; ?></td><td class="value"><?php echo $saturatedFatPercent; ?></td></tr>
											<tr><td class="indentedInfo">Trans Fat 0g</td><td class="value">&nbsp;</td></tr>
											<tr><td><b>Cholesterol</b> <?php echo $cholesterol; ?></td><td class="value"><?php echo $cholesterolPercent; ?></td></tr>
											<tr><td><b>Sodium</b> <?php echo $sodium; ?></td> <td class="value"><?php echo $sodiumPercent; ?></td></tr>
											<tr><td><b>Potassium</b> <?php echo $potassium; ?></td><td class="value"><?php echo $potassiumPercent; ?></td></tr>
											<tr><td><b>Total Carbohydrates</b> <?php echo $totalCarbs; ?></td><td class="value"><?php echo $totalCarbsPercent; ?></td></tr>
											<tr><td class="indentedInfo">Dietary Fiber <?php echo $dietaryFiber; ?></td><td class="value"><?php echo $dietaryFiberPercent; ?></td></tr>
											<tr><td class="indentedInfo">Sugars <?php echo $sugars; ?></td><td class="value">&nbsp;</td></tr>
											<tr><td class="noBorder"><b>Protein</b> <?php echo $protein; ?></td><td class="value noBorder">&nbsp;</td></tr>
											<tr><td colspan="2" class="thickBorder"></td></tr>
											<tr><td>Vitamin A </td> <td class="value"><?php echo $vitAPercent; ?></td></tr>
											<tr><td>Vitamin C </td> <td class="value"><?php echo $vitCPercent; ?></td></tr>
											<tr><td>Calcium</td> <td class="value"><?php echo $calciumPercent; ?></td></tr>
											<tr><td>Iron</td> <td class="value"><?php echo $ironPercent; ?></td></tr>
											<tr><td colspan="2" class="noBorder">*Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.</td></tr>
										</tbody>
									</table>

									<?php endif; ?>

								</div>

						</article>

						<article id="productRight">
							<?php the_content(); ?>
							<div class="divider"></div>
							<?php if ($size != '') : ?>
								<div>
									<h3>Sizes</h3>
									<table id="sizeList">
										<tbody>
											<tr><th>Size</th><th>SKU</th><th>Available In</th></tr>
											<tr><td><?php echo $size; ?></td><td><?php echo $sku; ?></td><td><?php if ($inUnitedStates == 'True') : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/country-icons/united-states.jpg" alt="United States"> <?php endif; ?><?php if ($inCanada == 'True') : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/country-icons/canada.jpg" alt="Canada"><?php endif; ?></td></tr>
											<?php if ($size2 != '') : ?>
											<tr><td><?php echo $size2; ?></td><td><?php echo $sku2; ?></td><td><?php if ($inUnitedStates2 == 'True') : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/country-icons/united-states.jpg" alt="United States"> <?php endif; ?><?php if ($inCanada2 == 'True') : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/country-icons/canada.jpg" alt="Canada"><?php endif; ?></td></tr>
											<?php endif; ?>
											<?php if ($size3 != '') : ?>
											<tr><td><?php echo $size3; ?></td><td><?php echo $sku3; ?></td><td><?php if ($inUnitedStates3 == 'True') : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/country-icons/united-states.jpg" alt="United States"> <?php endif; ?><?php if ($inCanada3 == 'True') : ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/country-icons/canada.jpg" alt="Canada"><?php endif; ?></td></tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							<?php endif; ?>
						</article>
									
						<?php edit_post_link('Edit this entry','','.'); ?>

					</section>
				
				</div><!-- #pageContents -->

				<section id="emailOverlay" style="display: none; ">
					<section id="emailContent">
						<article id="emailForm" class="clearfix">

							<div><div class="floatR emailClose"><a href="">Close</a></div></div>

							<h1><?php the_title(); ?></h1>

							<form id="email-product-info" action="" method="post">
								<label for="email">Send To</label>
								<input type="email" name="email" value="" id="email">
								<input type="hidden" name="product" value="2" id="product">
								<input type="hidden" name="emailPage" value="1">
								<input type="submit" class="submit clearfix redButton" name="submit" value="Send Email">
							</form>

							<div id="message"></div>

						</article>
					</section>
				</section>

			</section>

		<?php endwhile; endif; ?>

	</section>
	
<?php get_footer(); ?>