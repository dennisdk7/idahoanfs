<?php 
	$course = $_POST['recipe-course'];
	$segment = $_POST['recipe-segment'];
	$product = $_POST['recipe-product'];

	if ($course == 0 && $segment == 0 && $product == 0) {
		$terms = get_terms("recipe_category");
		$recipeTerms = array();
		foreach ($terms as $term) {
			array_push($recipeTerms, $term->term_id);
		}
		$operator = '';
	} else {
		$recipeTerms = array();
		if ($course != 0) {
			$recipeTerms[0] = $course;
		}
		if ($segment != 0) {
			$recipeTerms[1] = $segment;
		}
		if ($product != 0) {
			$recipeTerms[2] = $product;
		}
		$operator = 'AND';
	}

?>

<section id="searchBar">

<h1>Search Recipes</h1><br><br>
<form class="recipe-search clearfix" action="/recipes" method="post">
	<div class="field first">
		<?php 
			$terms = get_terms("recipe_category", array('exclude_tree'  => array(), 'child_of' => 51 ));
			$count = count($terms);
			if ( $count > 0 ){
			 echo '<select id="course" name="recipe-course">';
			 echo '<option value="0">Course</option>';
			 foreach ( $terms as $term ) {
			   echo '<option value="' . $term->term_id . '"';
			   if($course == $term->term_id) { echo 'selected="selected"';}
			   echo '>' . $term->name . '</option>';
			    
			 }
			 echo '</select>';
		 } ?>
	</div>

	<div class="field">
		 <?php 
			$terms = get_terms("recipe_category", array('child_of' => 52 ));
			$count = count($terms);
			if ( $count > 0 ){
			 echo '<select id="segment" name="recipe-segment">';
			 echo '<option value="0">Segment</option>';
			 foreach ( $terms as $term ) {
			   echo '<option value="' . $term->term_id . '"';
			   if($segment == $term->term_id) { echo 'selected="selected"';}
			   echo '>' . $term->name . '</option>';
			    
			 }
			 echo '</select>';
		 } ?>
	</div>

	<div class="field last">
			<?php 
			$terms = get_terms("recipe_category", array('child_of' => 53 ));
			$count = count($terms);
			if ( $count > 0 ){
			 echo '<select id="product" name="recipe-product">';
			 echo '<option value="0">Product</option>';
			 foreach ( $terms as $term ) {
			   echo '<option value="' . $term->term_id . '"';
			   if($product == $term->term_id) { echo 'selected="selected"';}
			   echo '>' . $term->name . '</option>';
			    
			 }
			 echo '</select>';
		 } ?>
	</div>

	 <input class="redButton" type="submit" value="Search">

</form>

</section>