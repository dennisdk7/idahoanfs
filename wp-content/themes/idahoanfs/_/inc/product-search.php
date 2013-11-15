<div id="productSearchBtn"><a href="#" class="revealButton">product search</a> </div>
<div id="productSearchFull">
	<form action="<?php echo get_home_url(); ?>/search" method="get" accept-charset="utf-8">
		<div class="formSearch"><input name="keywords" value="" id="keywords" placeholder="Search"></div><br>
		<select name="nutrition" id="nutrition" size="1">
			<option value="">Nutritional Info</option>
			<option value="fortified">Fortified</option>
			<option value="gluten-free">Gluten Free</option>
			<option value="halal">Halal</option>
			<option value="kosher">Kosher</option>
			<option value="kosher-d">Kosher D</option>
			<option value="low-sodium">Low Sodium</option>
			<option value="zero-trans-fat-grams">0 Trans Fat Grams</option>
			<option value="no-bha-bht">No BHA/BHT</option>
			<option value="allergens">Allergens</option>
		</select> <br><br>
		<select name="category" id="category" size="1">
			<option value="">Category</option>
			<option value="real">REAL Mashed</option>
			<option value="premium">Premium Mashed</option>
			<option value="signature">Signature Mashed</option>
			<option value="value-advantage">Value Advantage</option>
			<option value="casseroles">Casseroles</option>
			<option value="hashbrowns">Fresh Cut Hash Browns</option>
		</select>
		<p><input type="submit" class="redButton" value="Search"></p>
	</form>
</div>