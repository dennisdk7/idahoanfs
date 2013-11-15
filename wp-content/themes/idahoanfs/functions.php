<?php
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain( 'html5reset', TEMPLATEPATH . '/languages' );
 
        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if ( is_readable($locale_file) )
            require_once($locale_file);
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery and custom scripts
	if ( !function_exists(core_mods) ) {
		function core_mods() {
			if ( !is_admin() ) {
				wp_deregister_script('jquery');
				wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"), false);
				wp_enqueue_script('jquery');

                wp_enqueue_script('jqColorbox', '/wp-content/themes/idahoanfs/_/js/jquery.colorbox.min.js');
                wp_enqueue_script('superFish', '/wp-content/themes/idahoanfs/_/js/superfish.js');
                wp_enqueue_script('jqCycle', '/wp-content/themes/idahoanfs/_/js/cycle.js');
                wp_enqueue_script('idahoanValidation', '/wp-content/themes/idahoanfs/_/js/validation.js');
                wp_enqueue_script('idahoanCustom', '/wp-content/themes/idahoanfs/_/js/custom.js');
			}
		}
		core_mods();
	}

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => __('Bottom Right Promo Box Widget','idahoanfs' ),
    		'id'   => 'bottom-right-promobox',
    		'description'   => __( 'This a widget area for the promo box on the bottom right all pages.','idahoanfs' ),
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.


/*****************************************************************************
CUSTOM FUNCTIONS ADDED BY CODY
*****************************************************************************/

    // Enable WordPress feature image
    add_theme_support( 'post-thumbnails');
    add_image_size( 'home-slider', 690, 415, true );
    add_image_size( 'home-feature-box', 300, 100, true );
    add_image_size( 'products', 175, '', true );
    add_image_size( 'recipes', 125, '', true );
    add_image_size( 'page-header', 590, 268, true );
    add_image_size( 'product-list-thumb', 82, '' );
    add_image_size( 'broker-thumb', 55, '' );

    // Add support for wp_nav_menu... two locations
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'idahoanfs' ),
        'footer' => __( 'Footer Navigation', 'idahoanfs' ),
    ) );

    /////////////////////////////////////////////////////////////////////////
    // IDAHOAN CUSTOM POST TYPES
    /////////////////////////////////////////////////////////////////////////
    function idahoan_custom_init() {
    
        // Add custom post type for homepage middle three boxes
        register_post_type( 'idahoan_home_boxes',
            array(
              'labels' => array(
                'name' => __( 'Home Feature Boxes' ),
                'singular_name' => __( 'Home Feature Boxes' ),
                'add_new_item' => __('Add New Home Feature Box'),
                'edit_item' => __('Edit Home Feature Boxes'),
                'search_items' => __('Search Home Feature Boxes'),
                'not_found' => __('Sorry: Home Feature Box Not Found'),
                'not_found_in_trash' => __('Sorry: Home Feature Box Not Found In Trash'),
              ),
              'rewrite' => array( 'slug' => 'homepage-boxes' ),
              'public' => true,
              'menu_position' => 50,
              'hierarchical' => false,
              'capability_type' => 'page',
              'has_archive' => true,
              'supports' => array('title', 'editor', 'thumbnail', 'page-attributes' ),
              'register_meta_box_cb' => 'idahoan_home_boxes_add_metaboxes'
              )
        );

        // Add custom post type for homepage hero slider
        register_post_type( 'idahoan_front_slider',
            array(
              'labels' => array(
                'name' => __( 'Front Slider' ),
                'singular_name' => __( 'Front Slider' ),
                'add_new_item' => __('Add New Slide'),
                'edit_item' => __('Edit Slide'),
                'search_items' => __('Search Slides'),
                'not_found' => __('Sorry: Slide Not Found'),
                'not_found_in_trash' => __('Sorry: Slide Not Found In Trash'),
              ),
              'rewrite' => array( 'slug' => 'featured-slider' ),
              'public' => true,
              'hierarchical' => false,
              'capability_type' => 'page',
              'has_archive' => true,
              'supports' => array('title', 'editor', 'thumbnail', 'page-attributes' ),
              'register_meta_box_cb' => 'idahoan_front_slider_add_metaboxes'
              )
        );
    }

    add_action( 'init', 'idahoan_custom_init' );

    /////////////////////////////////////////////////////////////////////////////////////////////
    // Add a meta box to home boxe posts for selecting custom options per post
    /////////////////////////////////////////////////////////////////////////////////////////////
    function idahoan_home_boxes_add_metaboxes() {
        add_meta_box('idahoan_meta_options', 'Additional Item Options', 'idahoan_home_boxes_metaboxes', 'idahoan_home_boxes', 'side', 'high');
    }

    // Metabox for additional home boxes options
     
    function idahoan_home_boxes_metaboxes() {
        global $post;
     
        // Noncename needed to verify where the data originated
        echo '<input type="hidden" name="idahoan_home_boxes_noncename" id="idahoan-home-boxes-noncename" value="' .
        wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
     
        // Get the options if already entered
        $image_link_to = get_post_meta($post->ID, 'idahoan_image_link_to', true);
     
        // Echo out option fields ?>
        <div class="misc-pub-section">
        <p><strong>Image Link To Address:</strong></p>
        <input type="text" name="idahoan_image_link_to" value="<?php echo $image_link_to; ?>" class="widefat" />
        </div>
    <?php }

    // Save the Metabox Data
     
    function idahoan_save_home_boxes_meta($post_id, $post) {
     
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !wp_verify_nonce( $_POST['idahoan_home_boxes_noncename'], plugin_basename(__FILE__) )) {
            return $post->ID;
        }
     
        // Is the user allowed to edit the post or page?
        if ( !current_user_can( 'edit_post', $post->ID ))
            return $post->ID;
     
        // Save the data in an array to make it easier to loop though.
     
        $idahoan_home_boxes_meta['idahoan_image_link_to'] = $_POST['idahoan_image_link_to'];
     
        // Add values of $idahoan_home_boxes_meta as custom fields
     
        foreach ($idahoan_home_boxes_meta as $key => $value) { // Cycle through the array!
            if( $post->post_type == 'revision' ) return; // Don't store custom data twice
            $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
                add_post_meta($post->ID, $key, $value);
            }
            if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
        }
     
    }
     
    add_action('save_post', 'idahoan_save_home_boxes_meta', 1, 2); // save the custom fields

    /////////////////////////////////////////////////////////////////////////////////////////////
    // Add a meta box to front hero slider posts for selecting custom options on a per item basis
    /////////////////////////////////////////////////////////////////////////////////////////////
    function idahoan_front_slider_add_metaboxes() {
        add_meta_box('idahoan_meta_options', 'Additional Item Options', 'idahoan_front_slider_metaboxes', 'idahoan_front_slider', 'side', 'high');
    }

    // Metabox for additional front hero slider options
     
    function idahoan_front_slider_metaboxes() {
        global $post;
     
        // Noncename needed to verify where the data originated
        echo '<input type="hidden" name="idahoan_front_slider_noncename" id="idahoan-front-slider-noncename" value="' .
        wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
     
        // Get the options if already entered
        $button_text = get_post_meta($post->ID, 'idahoan_button_text', true);
        $link_to = get_post_meta($post->ID, 'idahoan_link_to', true);
     
        // Echo out option fields ?>
        <div class="misc-pub-section">
        <p><strong>Button Text:</strong></p>
        <input type="text" name="idahoan_button_text" value="<?php echo $button_text; ?>" class="widefat" />
        <p><strong>Button Link To Address:</strong></p>
        <input type="text" name="idahoan_link_to" value="<?php echo $link_to; ?>" class="widefat" />
        </div>
    <?php }

    // Save the Metabox Data
     
    function idahoan_save_slider_meta($post_id, $post) {
     
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !wp_verify_nonce( $_POST['idahoan_front_slider_noncename'], plugin_basename(__FILE__) )) {
            return $post->ID;
        }
     
        // Is the user allowed to edit the post or page?
        if ( !current_user_can( 'edit_post', $post->ID ))
            return $post->ID;
     
        // Save the data in an array to make it easier to loop though.
     
        $idahoan_front_slider_meta['idahoan_link_to'] = $_POST['idahoan_link_to'];
        $idahoan_front_slider_meta['idahoan_button_text'] = $_POST['idahoan_button_text'];
     
        // Add values of $idahoan_front_slider_meta as custom fields
     
        foreach ($idahoan_front_slider_meta as $key => $value) { // Cycle through the array!
            if( $post->post_type == 'revision' ) return; // Don't store custom data twice
            $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
                add_post_meta($post->ID, $key, $value);
            }
            if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
        }
     
    }
     
    add_action('save_post', 'idahoan_save_slider_meta', 1, 2); // save the custom fields

    // Function To Pull Homepage Feature Boxes... Limit 3
    function idahoan_homefeature_boxes() {
    
      global $post;
      $home_feature_query = new WP_Query( array( 'post_type' => 'idahoan_home_boxes', 'order' => "ASC", 'posts_per_page' => 3 ) ); ?>
      
    
      <?php if ( $home_feature_query->have_posts() ) : while ( $home_feature_query->have_posts() ) : $home_feature_query ->the_post();?>
            <article>
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php echo get_post_meta($post->ID, 'idahoan_image_link_to', true); ?>"><?php the_post_thumbnail('home-feature-box'); ?></a>
                <?php endif; ?>
            </article>

      <?php endwhile; endif; ?> 
        
    <?php }

    // Function To Pull Front Slider
    function idahoan_frontpage_slider() {

        global $post;
        $slider_query = new WP_Query( array( 'post_type' => 'idahoan_front_slider', 'orderby' => 'menu_order', 'order' => "ASC", 'posts_per_page' => 5 ) ); ?>
      
        <div id="slideHolder">
            <?php if ( $slider_query->have_posts() ) : while ( $slider_query->have_posts() ) : $slider_query ->the_post(); ?>
            <div class="slide">
                <div id="slideLeft">
                    <ul id="photoRotate">
                        <li><a href="<?php echo get_post_meta($post->ID, 'idahoan_link_to', true); ?>"><?php the_post_thumbnail('home-slider'); ?></a><li>
                    </ul>
                </div>
                <div id="slideRight">
                    <div id="slideRightCurve" class=""></div>
                    <div id="slideRightBg">
                        <ul id="textRotate">
                            <li>
                                <h2><?php the_title(); ?></h2>
                                <?php the_excerpt(); ?>
                                <p>
                                <a href="<?php echo get_post_meta($post->ID, 'idahoan_link_to', true); ?>">
                                    <?php if (get_post_meta($post->ID, 'idahoan_button_text', true) != '') : ?>
                                      <?php echo get_post_meta($post->ID, 'idahoan_button_text', true); ?> >>
                                    <?php else : ?>
                                      Learn More >>
                                    <?php endif; ?>
                                </a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endwhile; endif; ?>
        </div>

    <?php }


    /////////////////////////////////////////////////////////////////////////////////////////////
    // Register Products Custom Post Type
    /////////////////////////////////////////////////////////////////////////////////////////////
    function idahoan_products() {
    
        register_post_type( 'idahoan_products',
            array(
              'labels' => array(
                'name' => __( 'Products' ),
                'singular_name' => __( 'Products' ),
                'add_new_item' => __('Add New Product'),
                'edit_item' => __('Edit Product'),
                'search_items' => __('Search Products'),
                'not_found' => __('Sorry: Product Not Found'),
                'not_found_in_trash' => __('Sorry: Product Not Found In Trash'),
              ),
              'rewrite' => array( 'slug' => 'idahoan-products' ),
              'public' => true,
              'menu_position' => 50,
              'hierarchical' => true,
              'capability_type' => 'page',
              'has_archive' => true,
              'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
              'register_meta_box_cb' => 'idahoan_products_add_metaboxes'
              )
        );
        
        // Add new taxonomy for Products, make it hierarchical (like categories)
        $labels = array(
            'name' => _x( 'Product Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Product Categories', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Product Categories' ),
            'all_items' => __( 'All Product Categories' ),
            'parent_item' => __( 'Parent Product Categories' ),
            'parent_item_colon' => __( 'Parent Product Categories:' ),
            'edit_item' => __( 'Edit Product Category' ),
            'update_item' => __( 'Update Product Category' ),
            'add_new_item' => __( 'Add New Product Category' ),
            'new_item_name' => __( 'New Product Category' ),
        );  
    
        register_taxonomy( 'product_category', array( 'idahoan_products' ), array(
            'hierarchical' => true,
            'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'product-categories' )
        ));

    }
    add_action( 'init', 'idahoan_products' );


    /////////////////////////////////////////////////////////////////////////////////////////////
    // Add a meta boxes to PRODUCT posts for selecting additional product information surch as Nutrition Information, etc.
    /////////////////////////////////////////////////////////////////////////////////////////////
    function idahoan_products_add_metaboxes() {
        add_meta_box('idahoan_meta_options', 'Additional Product Information', 'idahoan_products_metaboxes', 'idahoan_products', 'advanced', 'high');
    }

    // Metabox for additional product information options
     
    function idahoan_products_metaboxes() {
        global $post;
     
        // Noncename needed to verify where the data originated
        echo '<input type="hidden" name="idahoan_products_noncename" id="idahoan-products-noncename" value="' .
        wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
     
        // Get the options if already entered
        $serving_size = get_post_meta($post->ID, 'idahoan_product_serving_size', true);
        $calories = get_post_meta($post->ID, 'idahoan_product_calories', true);
        $calories_from_fat = get_post_meta($post->ID, 'idahoan_product_calories_from_fat', true);
        $total_fat = get_post_meta($post->ID, 'idahoan_product_total_fat', true);
        $total_fat_percent = get_post_meta($post->ID, 'idahoan_product_total_fat_percent', true);
        $saturated_fat = get_post_meta($post->ID, 'idahoan_product_saturated_fat', true);
        $saturated_fat_percent = get_post_meta($post->ID, 'idahoan_product_saturated_fat_percent', true);
        $trans_fat = get_post_meta($post->ID, 'idahoan_product_trans_fat', true);
        $trans_fat_percent = get_post_meta($post->ID, 'idahoan_product_trans_fat_percent', true);
        $cholesterol = get_post_meta($post->ID, 'idahoan_product_cholesterol', true);
        $cholesterol_percent = get_post_meta($post->ID, 'idahoan_product_cholesterol_percent', true);
        $sodium = get_post_meta($post->ID, 'idahoan_product_sodium', true);
        $sodium_percent = get_post_meta($post->ID, 'idahoan_product_sodium_percent', true);
        $potassium = get_post_meta($post->ID, 'idahoan_product_potassium', true);
        $potassium_percent = get_post_meta($post->ID, 'idahoan_product_potassium_percent', true);
        $total_carbs = get_post_meta($post->ID, 'idahoan_product_total_carbs', true);
        $total_carbs_percent = get_post_meta($post->ID, 'idahoan_product_total_carbs_percent', true);
        $dietary_fiber = get_post_meta($post->ID, 'idahoan_product_dietary_fiber', true);
        $dietary_fiber_percent = get_post_meta($post->ID, 'idahoan_product_dietary_fiber_percent', true);
        $sugars = get_post_meta($post->ID, 'idahoan_product_sugars', true);
        $sugars_percent = get_post_meta($post->ID, 'idahoan_product_sugars_percent', true);
        $protein = get_post_meta($post->ID, 'idahoan_product_protein', true);
        $protein_percent = get_post_meta($post->ID, 'idahoan_product_protein_percent', true);
        $vit_a = get_post_meta($post->ID, 'idahoan_product_vit_a', true);
        $vit_a_percent = get_post_meta($post->ID, 'idahoan_product_vit_a_percent', true);
        $vit_c = get_post_meta($post->ID, 'idahoan_product_vit_c', true);
        $vit_c_percent = get_post_meta($post->ID, 'idahoan_product_vit_c_percent', true);
        $calcium = get_post_meta($post->ID, 'idahoan_product_calcium', true);
        $calcium_percent = get_post_meta($post->ID, 'idahoan_product_calcium_percent', true);
        $iron = get_post_meta($post->ID, 'idahoan_product_iron', true);
        $iron_percent = get_post_meta($post->ID, 'idahoan_product_iron_percent', true);

        $two_col_nutrition = get_post_meta($post->ID, 'two_col_nutrition', true);

        // Start fields for second column or "Prepared" column

        $prepared_calories = get_post_meta($post->ID, 'idahoan_prepared_product_calories', true);
        $prepared_calories_from_fat = get_post_meta($post->ID, 'idahoan_prepared_product_calories_from_fat', true);
        $prepared_total_fat_percent = get_post_meta($post->ID, 'idahoan_prepared_product_total_fat_percent', true);
        $prepared_saturated_fat_percent = get_post_meta($post->ID, 'idahoan_prepared_product_saturated_fat_percent', true);
        $prepared_trans_fat_percent = get_post_meta($post->ID, 'idahoan_prepared_product_trans_fat_percent', true);
        $prepared_cholesterol_percent = get_post_meta($post->ID, 'idahoan_prepared_product_cholesterol_percent', true);
        $prepared_sodium_percent = get_post_meta($post->ID, 'idahoan_prepared_product_sodium_percent', true);
        $prepared_potassium_percent = get_post_meta($post->ID, 'idahoan_prepared_product_potassium_percent', true);
        $prepared_total_carbs_percent = get_post_meta($post->ID, 'idahoan_prepared_product_total_carbs_percent', true);
        $prepared_dietary_fiber_percent = get_post_meta($post->ID, 'idahoan_prepared_product_dietary_fiber_percent', true);
        $prepared_vit_a_percent = get_post_meta($post->ID, 'idahoan_prepared_product_vit_a_percent', true);
        $prepared_vit_c_percent = get_post_meta($post->ID, 'idahoan_prepared_product_vit_c_percent', true);
        $prepared_calcium_percent = get_post_meta($post->ID, 'idahoan_prepared_product_calcium_percent', true);
        $prepared_iron_percent = get_post_meta($post->ID, 'idahoan_prepared_product_iron_percent', true);

        // End Fields for second column or "Prepared" column

        $idahoan_size = get_post_meta($post->ID, 'idahoan_product_size', true);
        $idahoan_sku = get_post_meta($post->ID, 'idahoan_product_sku', true);
        $idahoan_united_states_bool = get_post_meta($post->ID, 'idahoan_product_united_states', true);
        $idahoan_canada_bool = get_post_meta($post->ID, 'idahoan_product_canada', true);

        $idahoan_size_2 = get_post_meta($post->ID, 'idahoan_product_size_2', true);
        $idahoan_sku_2 = get_post_meta($post->ID, 'idahoan_product_sku_2', true);
        $idahoan_united_states_bool_2 = get_post_meta($post->ID, 'idahoan_product_united_states_2', true);
        $idahoan_canada_bool_2 = get_post_meta($post->ID, 'idahoan_product_canada_2', true);

        $idahoan_size_3 = get_post_meta($post->ID, 'idahoan_product_size_3', true);
        $idahoan_sku_3 = get_post_meta($post->ID, 'idahoan_product_sku_3', true);
        $idahoan_united_states_bool_3 = get_post_meta($post->ID, 'idahoan_product_united_states_3', true);
        $idahoan_canada_bool_3 = get_post_meta($post->ID, 'idahoan_product_canada_3', true);


     
        // Echo out option fields ?>
        <h2>Nutrition Facts</h2>

        <p><strong>Serving Size:</strong></p>
        <input type="text" name="idahoan_product_serving_size" value="<?php echo $serving_size; ?>" class="regular-text" />

        <p><strong>Column 1 / Unprepared Details</strong></p>

        <p><strong>Calories:</strong></p>
        <input type="text" name="idahoan_product_calories" value="<?php echo $calories; ?>" class="regular-text" />
        <p><strong>Calories From Fat:</strong></p>
        <input type="text" name="idahoan_product_calories_from_fat" value="<?php echo $calories_from_fat; ?>" class="regular-text" />
        <p><strong>Total Fat:</strong></p>
        <input type="text" name="idahoan_product_total_fat" value="<?php echo $total_fat; ?>" class="regular-text" />
        <p><strong>Total Fat Percent:</strong></p>
        <input type="text" name="idahoan_product_total_fat_percent" value="<?php echo $total_fat_percent; ?>" class="regular-text" />
        <p><strong>Saturated Fat:</strong></p>
        <input type="text" name="idahoan_product_saturated_fat" value="<?php echo $saturated_fat; ?>" class="regular-text" />
        <p><strong>Saturated Fat Percent:</strong></p>
        <input type="text" name="idahoan_product_saturated_fat_percent" value="<?php echo $saturated_fat_percent; ?>" class="regular-text" />
        <p><strong>Trans Fat:</strong></p>
        <input type="text" name="idahoan_product_trans_fat" value="<?php echo $trans_fat; ?>" class="regular-text" />
        <p><strong>Trans Fat Percent:</strong></p>
        <input type="text" name="idahoan_product_trans_fat_percent" value="<?php echo $trans_fat_percent; ?>" class="regular-text" />
        <p><strong>Cholesterol:</strong></p>
        <input type="text" name="idahoan_product_cholesterol" value="<?php echo $cholesterol; ?>" class="regular-text" />
        <p><strong>Cholesterol Percent:</strong></p>
        <input type="text" name="idahoan_product_cholesterol_percent" value="<?php echo $cholesterol_percent; ?>" class="regular-text" />
        <p><strong>Sodium:</strong></p>
        <input type="text" name="idahoan_product_sodium" value="<?php echo $sodium; ?>" class="regular-text" />
        <p><strong>Sodium Percent:</strong></p>
        <input type="text" name="idahoan_product_sodium_percent" value="<?php echo $sodium_percent; ?>" class="regular-text" />
        <p><strong>Potassium:</strong></p>
        <input type="text" name="idahoan_product_potassium" value="<?php echo $potassium; ?>" class="regular-text" />
        <p><strong>Potassium Percent:</strong></p>
        <input type="text" name="idahoan_product_potassium_percent" value="<?php echo $potassium_percent; ?>" class="regular-text" />
        <p><strong>Total Carbs:</strong></p>
        <input type="text" name="idahoan_product_total_carbs" value="<?php echo $total_carbs; ?>" class="regular-text" />
        <p><strong>Total Carbs Percent:</strong></p>
        <input type="text" name="idahoan_product_total_carbs_percent" value="<?php echo $total_carbs_percent; ?>" class="regular-text" />
        <p><strong>Dietary Fiber:</strong></p>
        <input type="text" name="idahoan_product_dietary_fiber" value="<?php echo $dietary_fiber; ?>" class="regular-text" />
        <p><strong>Dietary Fiber Percent:</strong></p>
        <input type="text" name="idahoan_product_dietary_fiber_percent" value="<?php echo $dietary_fiber_percent; ?>" class="regular-text" />
        <p><strong>Sugars:</strong></p>
        <input type="text" name="idahoan_product_sugars" value="<?php echo $sugars; ?>" class="regular-text" />
        <p><strong>Sugars Percent:</strong></p>
        <input type="text" name="idahoan_product_sugars_percent" value="<?php echo $sugars_percent; ?>" class="regular-text" />
        <p><strong>Protein:</strong></p>
        <input type="text" name="idahoan_product_protein" value="<?php echo $protein; ?>" class="regular-text" />
        <p><strong>Protein Percent:</strong></p>
        <input type="text" name="idahoan_product_protein_percent" value="<?php echo $protein_percent; ?>" class="regular-text" />
        <p><strong>Vitamin A:</strong></p>
        <input type="text" name="idahoan_product_vit_a" value="<?php echo $vit_a; ?>" class="regular-text" />
        <p><strong>Vitamin A Percent:</strong></p>
        <input type="text" name="idahoan_product_vit_a_percent" value="<?php echo $vit_a_percent; ?>" class="regular-text" />
        <p><strong>Vitamin C:</strong></p>
        <input type="text" name="idahoan_product_vit_c" value="<?php echo $vit_c; ?>" class="regular-text" />
        <p><strong>Vitamin C Percent:</strong></p>
        <input type="text" name="idahoan_product_vit_c_percent" value="<?php echo $vit_c_percent; ?>" class="regular-text" />
        <p><strong>Calcium:</strong></p>
        <input type="text" name="idahoan_product_calcium" value="<?php echo $calcium; ?>" class="regular-text" />
        <p><strong>Calcium Percent:</strong></p>
        <input type="text" name="idahoan_product_calcium_percent" value="<?php echo $calcium_percent; ?>" class="regular-text" />
        <p><strong>Iron:</strong></p>
        <input type="text" name="idahoan_product_iron" value="<?php echo $iron; ?>" class="regular-text" />
        <p><strong>Iron Percent:</strong></p>
        <input type="text" name="idahoan_product_iron_percent" value="<?php echo $iron_percent; ?>" class="regular-text" />

        <p><strong>Does Product Have Unprepared and Prepared Nutrition Info?</strong><br />
            If yes, please check yes here and enter the info for column 2 or "Prepared" below.</p>
        <input type="checkbox" name="two_col_nutrition" value="Yes" <?php if ($two_col_nutrition == 'Yes') { echo ' checked'; } ?> /> Yes, this product has unprepared and prepared nutrition information

        <p><strong>Column 2 / Prepared Details</strong></p>

        <p><strong>Column 2 Calories:</strong></p>
        <input type="text" name="idahoan_prepared_product_calories" value="<?php echo $prepared_calories; ?>" class="regular-text" />
        <p><strong>Column 2 Calories From Fat:</strong></p>
        <input type="text" name="idahoan_prepared_product_calories_from_fat" value="<?php echo $prepared_calories_from_fat; ?>" class="regular-text" />
        <p><strong>Column 2 Total Fat Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_total_fat_percent" value="<?php echo $prepared_total_fat_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Saturated Fat Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_saturated_fat_percent" value="<?php echo $prepared_saturated_fat_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Trans Fat Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_trans_fat_percent" value="<?php echo $prepared_trans_fat_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Cholesterol Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_cholesterol_percent" value="<?php echo $prepared_cholesterol_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Sodium Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_sodium_percent" value="<?php echo $prepared_sodium_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Potassium Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_potassium_percent" value="<?php echo $prepared_potassium_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Total Carbs Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_total_carbs_percent" value="<?php echo $prepared_total_carbs_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Dietary Fiber Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_dietary_fiber_percent" value="<?php echo $prepared_dietary_fiber_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Vitamin A Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_vit_a_percent" value="<?php echo $prepared_vit_a_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Vitamin C Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_vit_c_percent" value="<?php echo $prepared_vit_c_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Calcium Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_calcium_percent" value="<?php echo $prepared_calcium_percent; ?>" class="regular-text" />
        <p><strong>Column 2 Iron Percent:</strong></p>
        <input type="text" name="idahoan_prepared_product_iron_percent" value="<?php echo $prepared_iron_percent; ?>" class="regular-text" />

        <br />
        <h2>Sizes</h2>

        <p><strong>Size:</strong></p>
        <input type="text" name="idahoan_product_size" value="<?php echo $idahoan_size; ?>" class="regular-text" />
        <p><strong>SKU:</strong></p>
        <input type="text" name="idahoan_product_sku" value="<?php echo $idahoan_sku; ?>" class="regular-text" />
        <p><strong>Available In:</strong></p>
        <p><input type="checkbox" name="idahoan_product_united_states" value="True" <?php if ($idahoan_united_states_bool == 'True') { echo 'checked';} ?> /> United States</p>
        <p><input type="checkbox" name="idahoan_product_canada" value="True" <?php if ($idahoan_canada_bool == 'True') { echo 'checked';} ?> /> Canada</p>

        <p><strong>Size 2:</strong></p>
        <input type="text" name="idahoan_product_size_2" value="<?php echo $idahoan_size_2; ?>" class="regular-text" />
        <p><strong>SKU 2:</strong></p>
        <input type="text" name="idahoan_product_sku_2" value="<?php echo $idahoan_sku_2; ?>" class="regular-text" />
        <p><strong>Available In:</strong></p>
        <p><input type="checkbox" name="idahoan_product_united_states_2" value="True" <?php if ($idahoan_united_states_bool_2 == 'True') { echo 'checked';} ?> /> United States</p>
        <p><input type="checkbox" name="idahoan_product_canada_2" value="True" <?php if ($idahoan_canada_bool_2 == 'True') { echo 'checked';} ?> /> Canada</p>

        <p><strong>Size 3:</strong></p>
        <input type="text" name="idahoan_product_size_3" value="<?php echo $idahoan_size_3; ?>" class="regular-text" />
        <p><strong>SKU 3:</strong></p>
        <input type="text" name="idahoan_product_sku_3" value="<?php echo $idahoan_sku_3; ?>" class="regular-text" />
        <p><strong>Available In:</strong></p>
        <p><input type="checkbox" name="idahoan_product_united_states_3" value="True" <?php if ($idahoan_united_states_bool_3 == 'True') { echo 'checked';} ?> /> United States</p>
        <p><input type="checkbox" name="idahoan_product_canada_3" value="True" <?php if ($idahoan_canada_bool_3 == 'True') { echo 'checked';} ?> /> Canada</p>

    <?php }

    // Save the Metabox Data
     
    function idahoan_save_products_meta($post_id, $post) {
     
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !wp_verify_nonce( $_POST['idahoan_products_noncename'], plugin_basename(__FILE__) )) {
            return $post->ID;
        }
     
        // Is the user allowed to edit the post or page?
        if ( !current_user_can( 'edit_post', $post->ID ))
            return $post->ID;
     
        // Save the data in an array to make it easier to loop though.
     
        $idahoan_products_meta['idahoan_product_serving_size'] = $_POST['idahoan_product_serving_size'];
        $idahoan_products_meta['idahoan_product_calories'] = $_POST['idahoan_product_calories'];
        $idahoan_products_meta['idahoan_product_calories_from_fat'] = $_POST['idahoan_product_calories_from_fat'];
        $idahoan_products_meta['idahoan_product_total_fat'] = $_POST['idahoan_product_total_fat'];
        $idahoan_products_meta['idahoan_product_total_fat_percent'] = $_POST['idahoan_product_total_fat_percent'];
        $idahoan_products_meta['idahoan_product_saturated_fat'] = $_POST['idahoan_product_saturated_fat'];
        $idahoan_products_meta['idahoan_product_saturated_fat_percent'] = $_POST['idahoan_product_saturated_fat_percent'];
        $idahoan_products_meta['idahoan_product_trans_fat'] = $_POST['idahoan_product_trans_fat'];
        $idahoan_products_meta['idahoan_product_trans_fat_percent'] = $_POST['idahoan_product_trans_fat_percent'];
        $idahoan_products_meta['idahoan_product_cholesterol'] = $_POST['idahoan_product_cholesterol'];
        $idahoan_products_meta['idahoan_product_cholesterol_percent'] = $_POST['idahoan_product_cholesterol_percent'];
        $idahoan_products_meta['idahoan_product_sodium'] = $_POST['idahoan_product_sodium'];
        $idahoan_products_meta['idahoan_product_sodium_percent'] = $_POST['idahoan_product_sodium_percent'];
        $idahoan_products_meta['idahoan_product_potassium'] = $_POST['idahoan_product_potassium'];
        $idahoan_products_meta['idahoan_product_potassium_percent'] = $_POST['idahoan_product_potassium_percent'];
        $idahoan_products_meta['idahoan_product_total_carbs'] = $_POST['idahoan_product_total_carbs'];
        $idahoan_products_meta['idahoan_product_total_carbs_percent'] = $_POST['idahoan_product_total_carbs_percent'];
        $idahoan_products_meta['idahoan_product_dietary_fiber'] = $_POST['idahoan_product_dietary_fiber'];
        $idahoan_products_meta['idahoan_product_dietary_fiber_percent'] = $_POST['idahoan_product_dietary_fiber_percent'];
        $idahoan_products_meta['idahoan_product_sugars'] = $_POST['idahoan_product_sugars'];
        $idahoan_products_meta['idahoan_product_sugars_percent'] = $_POST['idahoan_product_sugars_percent'];
        $idahoan_products_meta['idahoan_product_protein'] = $_POST['idahoan_product_protein'];
        $idahoan_products_meta['idahoan_product_protein_percent'] = $_POST['idahoan_product_protein_percent'];
        $idahoan_products_meta['idahoan_product_vit_a'] = $_POST['idahoan_product_vit_a'];
        $idahoan_products_meta['idahoan_product_vit_a_percent'] = $_POST['idahoan_product_vit_a_percent'];
        $idahoan_products_meta['idahoan_product_vit_c'] = $_POST['idahoan_product_vit_c'];
        $idahoan_products_meta['idahoan_product_vit_c_percent'] = $_POST['idahoan_product_vit_c_percent'];
        $idahoan_products_meta['idahoan_product_calcium'] = $_POST['idahoan_product_calcium'];
        $idahoan_products_meta['idahoan_product_calcium_percent'] = $_POST['idahoan_product_calcium_percent'];
        $idahoan_products_meta['idahoan_product_iron'] = $_POST['idahoan_product_iron'];
        $idahoan_products_meta['idahoan_product_iron_percent'] = $_POST['idahoan_product_iron_percent'];

        $idahoan_products_meta['two_col_nutrition'] = $_POST['two_col_nutrition'];

        $idahoan_products_meta['idahoan_prepared_product_calories'] = $_POST['idahoan_prepared_product_calories'];
        $idahoan_products_meta['idahoan_prepared_product_calories_from_fat'] = $_POST['idahoan_prepared_product_calories_from_fat'];
        $idahoan_products_meta['idahoan_prepared_product_total_fat_percent'] = $_POST['idahoan_prepared_product_total_fat_percent'];
        $idahoan_products_meta['idahoan_prepared_product_saturated_fat_percent'] = $_POST['idahoan_prepared_product_saturated_fat_percent'];
        $idahoan_products_meta['idahoan_prepared_product_trans_fat_percent'] = $_POST['idahoan_prepared_product_trans_fat_percent'];
        $idahoan_products_meta['idahoan_prepared_product_cholesterol_percent'] = $_POST['idahoan_prepared_product_cholesterol_percent'];
        $idahoan_products_meta['idahoan_prepared_product_sodium_percent'] = $_POST['idahoan_prepared_product_sodium_percent'];
        $idahoan_products_meta['idahoan_prepared_product_potassium_percent'] = $_POST['idahoan_prepared_product_potassium_percent'];
        $idahoan_products_meta['idahoan_prepared_product_total_carbs_percent'] = $_POST['idahoan_prepared_product_total_carbs_percent'];
        $idahoan_products_meta['idahoan_prepared_product_dietary_fiber_percent'] = $_POST['idahoan_prepared_product_dietary_fiber_percent'];
        $idahoan_products_meta['idahoan_prepared_product_vit_a_percent'] = $_POST['idahoan_prepared_product_vit_a_percent'];
        $idahoan_products_meta['idahoan_prepared_product_vit_c_percent'] = $_POST['idahoan_prepared_product_vit_c_percent'];
        $idahoan_products_meta['idahoan_prepared_product_calcium_percent'] = $_POST['idahoan_prepared_product_calcium_percent'];
        $idahoan_products_meta['idahoan_prepared_product_iron_percent'] = $_POST['idahoan_prepared_product_iron_percent'];



        $idahoan_products_meta['idahoan_product_size'] = $_POST['idahoan_product_size'];
        $idahoan_products_meta['idahoan_product_sku'] = $_POST['idahoan_product_sku'];
        $idahoan_products_meta['idahoan_product_united_states'] = $_POST['idahoan_product_united_states'];
        $idahoan_products_meta['idahoan_product_canada'] = $_POST['idahoan_product_canada'];

        $idahoan_products_meta['idahoan_product_size_2'] = $_POST['idahoan_product_size_2'];
        $idahoan_products_meta['idahoan_product_sku_2'] = $_POST['idahoan_product_sku_2'];
        $idahoan_products_meta['idahoan_product_united_states_2'] = $_POST['idahoan_product_united_states_2'];
        $idahoan_products_meta['idahoan_product_canada_2'] = $_POST['idahoan_product_canada_2'];

        $idahoan_products_meta['idahoan_product_size_3'] = $_POST['idahoan_product_size_3'];
        $idahoan_products_meta['idahoan_product_sku_3'] = $_POST['idahoan_product_sku_3'];
        $idahoan_products_meta['idahoan_product_united_states_3'] = $_POST['idahoan_product_united_states_3'];
        $idahoan_products_meta['idahoan_product_canada_3'] = $_POST['idahoan_product_canada_3'];

     
        // Add values of $idahoan_front_slider_meta as custom fields
     
        foreach ($idahoan_products_meta as $key => $value) { // Cycle through the array!
            if( $post->post_type == 'revision' ) return; // Don't store custom data twice
            $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
                add_post_meta($post->ID, $key, $value);
            }
            if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
        }
     
    }
     
    add_action('save_post', 'idahoan_save_products_meta', 1, 2); // save the custom fields


    /////////////////////////////////////////////////////////////////////////////////////////////
    // Register Page Headers Custom Post Type
    /////////////////////////////////////////////////////////////////////////////////////////////
    function register_idahoan_page_header() {
    
        register_post_type( 'idahoan_page_header',
            array(
              'labels' => array(
                'name' => __( 'Page Headers' ),
                'singular_name' => __( 'Page Headers' ),
                'add_new_item' => __('Add New Page Header'),
                'edit_item' => __('Edit Page Header'),
                'search_items' => __('Search Page Header'),
                'not_found' => __('Sorry: Page Header Not Found'),
                'not_found_in_trash' => __('Sorry: Page Header Not Found In Trash'),
              ),
              'rewrite' => false,
              'public' => true,
              'menu_position' => 50,
              'hierarchical' => false,
              'capability_type' => 'page',
              'has_archive' => true,
              'supports' => array('title', 'editor', 'thumbnail', 'page-attributes' ),
              )
        );

    }
    add_action( 'init', 'register_idahoan_page_header' );

    // Function To Pull Front Slider
    function idahoan_page_header($header_id = '') {

        $page_header_query = new WP_Query( array( 'post_type' => 'idahoan_page_header', 'p' => $header_id ) ); ?>

        <?php if ( ($header_id != '' && $page_header_query->have_posts()) ) : while ( $page_header_query->have_posts() ) : $page_header_query ->the_post(); ?>
            <section id="hero" class="clearfix">
                <?php include (TEMPLATEPATH . '/_/inc/product-search.php' ); ?>
                <article id="heroImg">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('page-header'); ?>
                    <?php else : ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/products.jpg" alt="Mashed Potatoes">
                    <?php endif; ?>
                </article>
                <article id="heroTxt">
                    <div id="heroTxtL"></div>
                    <div id="heroTxtR">
                        <h2><?php the_title(); ?></h2>
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            </section>
        <?php endwhile; endif; ?>

    <?php }

    /////////////////////////////////////////////////////////////////////////////////////////////
    // Add a meta box to PAGES for selecting page header
    /////////////////////////////////////////////////////////////////////////////////////////////
    add_action( 'add_meta_boxes', 'idahoan_pages_add_metaboxes' );

    function idahoan_pages_add_metaboxes() {
        add_meta_box('idahoan_meta_options', 'Page Header', 'idahoan_page_metaboxes', 'page', 'side', 'high');
    }
    
    // Metabox for additional front hero slider options
     
    function idahoan_page_metaboxes() {
        global $post;
     
        // Noncename needed to verify where the data originated
        echo '<input type="hidden" name="idahoan_page_noncename" id="idahoan-page-noncename" value="' .
        wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
     
        // Get the options if already entered
        $page_header = get_post_meta($post->ID, 'idahoan_page_header', true);
     
        // Echo out option fields ?>
        <div class="misc-pub-section">
        <p><strong>Which Page Header To Show?:</strong></p>
        <input type="text" name="idahoan_page_header" value="<?php echo $page_header; ?>" class="small" />
        </div>
    <?php }

    // Save the Metabox Data
     
    function idahoan_save_page_meta($post_id, $post) {
     
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !wp_verify_nonce( $_POST['idahoan_page_noncename'], plugin_basename(__FILE__) )) {
            return $post->ID;
        }
     
        // Is the user allowed to edit the post or page?
        if ( !current_user_can( 'edit_post', $post->ID ))
            return $post->ID;
     
        // Save the data in an array to make it easier to loop though.
     
        $idahoan_page_meta['idahoan_page_header'] = $_POST['idahoan_page_header'];
     
        // Add values of $idahoan_front_slider_meta as custom fields
     
        foreach ($idahoan_page_meta as $key => $value) { // Cycle through the array!
            if( $post->post_type == 'revision' ) return; // Don't store custom data twice
            $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
                add_post_meta($post->ID, $key, $value);
            }
            if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
        }
     
    }
     
    add_action('save_post', 'idahoan_save_page_meta', 1, 2); // save the custom fields

    /////////////////////////////////////////////////////////////////////////////////////////////
    // Add a meta box to idahoan_page_header post types for displaying PAGE ID
    /////////////////////////////////////////////////////////////////////////////////////////////
    add_action( 'add_meta_boxes', 'idahoan_page_header_add_metaboxes' );

    function idahoan_page_header_add_metaboxes() {
        add_meta_box('idahoan_meta_options', 'Page Header Identifier', 'idahoan_page_header_metaboxes', 'idahoan_page_header', 'side', 'high');
    }
    
    // Metabox for additional front hero slider options
     
    function idahoan_page_header_metaboxes() {
        global $post;
        echo '<h2 style="text-align : center; font-weight: bold;">' . $post->ID . '</h2>';
        echo '<em>This number is the uniquie identifier for this page header. To add this header to a page, copy the number above and paste it in the "Which Page Header To Show?" field on the page that you want it to display on.</em>';
    }


    /////////////////////////////////////////////////////////////////////////////////////////////
    // Register Recipes Custom Post Type
    /////////////////////////////////////////////////////////////////////////////////////////////
    function idahoan_recipes() {
    
        register_post_type( 'idahoan_recipes',
            array(
              'labels' => array(
                'name' => __( 'Recipes' ),
                'singular_name' => __( 'Recipes' ),
                'add_new_item' => __('Add New Recipe'),
                'edit_item' => __('Edit Recipe'),
                'search_items' => __('Search Recipes'),
                'not_found' => __('Sorry: Recipe Not Found'),
                'not_found_in_trash' => __('Sorry: Recipe Not Found In Trash'),
              ),
              'rewrite' => array( 'slug' => 'idahoan-recipes' ),
              'public' => true,
              'menu_position' => 50,
              'hierarchical' => false,
              'capability_type' => 'page',
              'has_archive' => true,
              'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
              'register_meta_box_cb' => 'idahoan_recipes_add_metaboxes',
              )
        );
        
        // Add new taxonomy for Recipes, make it hierarchical (like categories)
        $labels = array(
            'name' => _x( 'Recipe Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Recipe Categories', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Recipe Categories' ),
            'all_items' => __( 'All Recipe Categories' ),
            'parent_item' => __( 'Parent Recipe Categories' ),
            'parent_item_colon' => __( 'Parent Recipe Categories:' ),
            'edit_item' => __( 'Edit Recipe Category' ),
            'update_item' => __( 'Update Recipe Category' ),
            'add_new_item' => __( 'Add New Recipe Category' ),
            'new_item_name' => __( 'New Recipe Category' ),
        );  
    
        register_taxonomy( 'recipe_category', array( 'idahoan_recipes' ), array(
            'hierarchical' => true,
            'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'product-categories' )
        ));

    }
    add_action( 'init', 'idahoan_recipes' );

    /////////////////////////////////////////////////////////////////////////////////////////////
    // Add a meta box to RECIPES pages for adding a "View Recipe Card" link
    /////////////////////////////////////////////////////////////////////////////////////////////
    
    function idahoan_recipes_add_metaboxes() {
        add_meta_box('idahoan_meta_options', 'Additional Recipe Options', 'idahoan_recipes_metaboxes', 'idahoan_recipes', 'side', 'high');
    }

    // Metabox for additional front hero slider options
     
    function idahoan_recipes_metaboxes() {
        global $post;
     
        // Noncename needed to verify where the data originated
        echo '<input type="hidden" name="idahoan_recipes_noncename" id="idahoan-recipes-noncename" value="' .
        wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
     
        // Get the options if already entered
        $recipe_card_link = get_post_meta($post->ID, 'recipe_card_link', true);
     
        // Echo out option fields ?>
        <div class="misc-pub-section">
        <p><strong>Recipe Card Link:</strong></p>
        <input type="text" name="recipe_card_link" value="<?php echo $recipe_card_link; ?>" class="widefat" />
        </div>
    <?php }

    // Save the Metabox Data
     
    function idahoan_save_recipes_meta($post_id, $post) {
     
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !wp_verify_nonce( $_POST['idahoan_recipes_noncename'], plugin_basename(__FILE__) )) {
            return $post->ID;
        }
     
        // Is the user allowed to edit the post or page?
        if ( !current_user_can( 'edit_post', $post->ID ))
            return $post->ID;
     
        // Save the data in an array to make it easier to loop though.
     
        $idahoan_recipes_meta['recipe_card_link'] = $_POST['recipe_card_link'];
     
        // Add values of $idahoan_front_slider_meta as custom fields
     
        foreach ($idahoan_recipes_meta as $key => $value) { // Cycle through the array!
            if( $post->post_type == 'revision' ) return; // Don't store custom data twice
            $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
                add_post_meta($post->ID, $key, $value);
            }
            if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
        }
     
    }
     
    add_action('save_post', 'idahoan_save_recipes_meta', 1, 2); // save the custom fields


    /////////////////////////////////////////////////////////////////////////////////////////////
    // SHORTCODES
    /////////////////////////////////////////////////////////////////////////////////////////////

    // Shortcode for adding a horizontal divider between content
    function divider( $atts ) {
        
        return '<div class="divider"></div>';
    }
    add_shortcode('divider', 'divider');

    // Shortcode for adding a horizontal divider between content
    function idahoan_list_products ( $atts ) {

        extract(shortcode_atts(array(
            'category' => ''
        ), $atts));
        
        $idahoan_products_query = new WP_Query( array( 'post_type' => 'idahoan_products', 'product_category' => $category, 'order' => "ASC", 'posts_per_page' => -1 ) ); ?>     

        <?php $idahoan_product_list = '<ul id="productList">';

            if ( $idahoan_products_query->have_posts() ) : while ( $idahoan_products_query->have_posts() ) : $idahoan_products_query ->the_post();
                
            

                $idahoan_product_list .= '<li class="clearfix">';
                $idahoan_product_list .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( $post->ID, 'product-list-thumb', array('class' => 'photo') ) . '</a>';
                $idahoan_product_list .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                $idahoan_product_list .= '<p>' . get_the_excerpt() . '</p>';
                $idahoan_product_list .= '</li>';
            
            endwhile; endif;

        $idahoan_product_list .= '</ul>';

        return $idahoan_product_list; 
    }
    add_shortcode('listproducts', 'idahoan_list_products');


    ///////////////////////////////
    // Register button in tinyMCE for adding product listing to a page by category
    ///////////////////////////////

    function register_button( $buttons ) {
        array_push( $buttons, "|", "productlist" );
        return $buttons;
    }
    function add_plugin( $plugin_array ) {
        $plugin_array['productlist'] = get_template_directory_uri() . '/_/js/productlist.js';
        return $plugin_array;
    }

    function idahoan_product_listing_button() {

        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
            return;
        }

        if ( get_user_option('rich_editing') == 'true' ) {
            add_filter( 'mce_external_plugins', 'add_plugin' );
            add_filter( 'mce_buttons', 'register_button' );
        }

    }

    add_action('init', 'idahoan_product_listing_button');

    /**
 * Search SQL filter for matching against post title only.
 */
function __search_by_title_only( $search, &$wp_query )
{
    global $wpdb;

    if ( empty( $search ) )
        return $search; // skip processing - no search term in query

    $q = $wp_query->query_vars;    
    $n = ! empty( $q['exact'] ) ? '' : '%';

    $search =
    $searchand = '';

    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( like_escape( $term ) );
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }

    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }

    return $search;
}
add_filter( 'posts_search', '__search_by_title_only', 500, 2 );


/*****************************************************************************
END CUSTOM FUNCTIONS ADDED BY CODY
*****************************************************************************/



/////////////////////////////////////////////////////////////////////////////////////////////
    // Register Products Custom Post Type
    /////////////////////////////////////////////////////////////////////////////////////////////
    function idahoan_brokers() {
    
        register_post_type( 'idahoan_brokers',
            array(
              'labels' => array(
                'name' => __( 'Brokers' ),
                'singular_name' => __( 'Brokers' ),
                'add_new_item' => __('Add New Broker'),
                'edit_item' => __('Edit Broker'),
                'search_items' => __('Search Brokers'),
                'not_found' => __('Sorry: Broker Not Found'),
                'not_found_in_trash' => __('Sorry: Broker Not Found In Trash'),
              ),
              'rewrite' => array( 'slug' => 'idahoan-brokers' ),
              'public' => true,
              'menu_position' => 90,
              'hierarchical' => true,
              'capability_type' => 'page',
              'has_archive' => true,
              'supports' => array('title', 'thumbnail', 'page-attributes' ),
              'register_meta_box_cb' => 'idahoan_brokers_add_metaboxes'
              )
        );
        
        // Add new taxonomy for Products, make it hierarchical (like categories)
        $labels = array(
            'name' => _x( 'Broker Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Broker Categories', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Broker Categories' ),
            'all_items' => __( 'All Broker Categories' ),
            'parent_item' => __( 'Parent Broker Categories' ),
            'parent_item_colon' => __( 'Parent Broker Categories:' ),
            'edit_item' => __( 'Edit Broker Category' ),
            'update_item' => __( 'Update Broker Category' ),
            'add_new_item' => __( 'Add New Broker Category' ),
            'new_item_name' => __( 'New Broker Category' ),
        );  
    
        register_taxonomy( 'broker_category', array( 'idahoan_brokers' ), array(
            'hierarchical' => true,
            'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'broker-categories' )
        ));

    }
    add_action( 'init', 'idahoan_brokers' );


    /////////////////////////////////////////////////////////////////////////////////////////////
    // Add a meta boxes to BROKER posts for adding broker information
    /////////////////////////////////////////////////////////////////////////////////////////////
    function idahoan_brokers_add_metaboxes() {
        add_meta_box('idahoan_meta_options', 'Broker Information', 'idahoan_brokers_metaboxes', 'idahoan_brokers', 'advanced', 'high');
    }

    // Metabox for additional broker information options
     
    function idahoan_brokers_metaboxes() {
        global $post;
     
        // Noncename needed to verify where the data originated
        echo '<input type="hidden" name="idahoan_brokers_noncename" id="idahoan-brokers-noncename" value="' .
        wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
     
        // Get the options if already entered
        $contact_phone = get_post_meta($post->ID, 'idahoan_contact_phone', true);
        $contact_email = get_post_meta($post->ID, 'idahoan_contact_email', true);
        $contact_company = get_post_meta($post->ID, 'idahoan_contact_company', true);
        $contact_company_address = get_post_meta($post->ID, 'idahoan_contact_company_address', true);
        $contact_company_city = get_post_meta($post->ID, 'idahoan_contact_company_city', true);
        $contact_company_state = get_post_meta($post->ID, 'idahoan_contact_company_state', true);
        $contact_company_zip = get_post_meta($post->ID, 'idahoan_contact_company_zip', true);
        $states_serviced = get_post_meta($post->ID, 'idahoan_states_serviced', true);

     
        // Echo out option fields ?>
        <h2>Broker Contact & Company Information</h2>

        <p><strong>Broker Contact Phone:</strong></p>
        <input type="text" name="idahoan_contact_phone" value="<?php echo $contact_phone; ?>" class="regular-text" />
        <p><strong>Broker Contact Email:</strong></p>
        <input type="text" name="idahoan_contact_email" value="<?php echo $contact_email; ?>" class="regular-text" />
        <p><strong>Company Name:</strong></p>
        <input type="text" name="idahoan_contact_company" value="<?php echo $contact_company; ?>" class="regular-text" />
        <p><strong>Company Address:</strong></p>
        <input type="text" name="idahoan_contact_company_address" value="<?php echo $contact_company_address; ?>" class="regular-text" />
        <p><strong>Company City:</strong></p>
        <input type="text" name="idahoan_contact_company_city" value="<?php echo $contact_company_city; ?>" class="regular-text" />
        <p><strong>Company State:</strong></p>
        <input type="text" name="idahoan_contact_company_state" value="<?php echo $contact_company_state; ?>" class="regular-text" />
        <p><strong>Company Zip:</strong></p>
        <input type="text" name="idahoan_contact_company_zip" value="<?php echo $contact_company_zip; ?>" class="regular-text" />
        <p><strong>Please enter state or states serviced, separated by commas.</strong></p>
        <p>Single state example: ID<br />
        Multiple states example: AZ, CA, ID</p>
        </p>
        <input type="text" name="idahoan_states_serviced" value="<?php echo $states_serviced; ?>" class="regular-text" />


    <?php }

    // Save the Metabox Data
     
    function idahoan_save_brokers_meta($post_id, $post) {
     
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !wp_verify_nonce( $_POST['idahoan_brokers_noncename'], plugin_basename(__FILE__) )) {
            return $post->ID;
        }
     
        // Is the user allowed to edit the post or page?
        if ( !current_user_can( 'edit_post', $post->ID ))
            return $post->ID;
     
        // Save the data in an array to make it easier to loop though.
     
        $idahoan_brokers_meta['idahoan_contact_phone'] = $_POST['idahoan_contact_phone'];
        $idahoan_brokers_meta['idahoan_contact_email'] = $_POST['idahoan_contact_email'];
        $idahoan_brokers_meta['idahoan_contact_company'] = $_POST['idahoan_contact_company'];
        $idahoan_brokers_meta['idahoan_contact_company_address'] = $_POST['idahoan_contact_company_address'];
        $idahoan_brokers_meta['idahoan_contact_company_city'] = $_POST['idahoan_contact_company_city'];
        $idahoan_brokers_meta['idahoan_contact_company_state'] = $_POST['idahoan_contact_company_state'];
        $idahoan_brokers_meta['idahoan_contact_company_zip'] = $_POST['idahoan_contact_company_zip'];
        $idahoan_brokers_meta['idahoan_states_serviced'] = $_POST['idahoan_states_serviced'];


     
        // Add values of $idahoan_brokers_meta as custom fields
     
        foreach ($idahoan_brokers_meta as $key => $value) { // Cycle through the array!
            if( $post->post_type == 'revision' ) return; // Don't store custom data twice
            $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
                add_post_meta($post->ID, $key, $value);
            }
            if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
        }
     
    }
     
    add_action('save_post', 'idahoan_save_brokers_meta', 1, 2); // save the custom fields


    function test_zipcode ($zipCode) {
        if ($zipCode >= '99500' && $zipCode  <= '99999' ) {
            return 'AK';
        }
        else if ($zipCode >= '35000' && $zipCode  <= '36999' ) {
            return 'AL';
        }
        else if ($zipCode >= '71600' && $zipCode  <= '72999' ) {
            return 'AR';
        }
        else if ($zipCode >= '85001' && $zipCode  <= '86599' ) {
            return 'AZ';
        }
        else if ($zipCode >= '90000' && $zipCode  <= '96199' ) {
            return 'CA';
        }
        else if ($zipCode >= '80000' && $zipCode  <= '81699' ) {
            return 'CO';
        }
        else if ($zipCode >= '06800' && $zipCode  <= '06999' ) {
            return 'CT';
        }
        else if ($zipCode >= '20001' && $zipCode  <= '20599' ) {
            return 'DC';
        }
        else if ($zipCode >= '19700' && $zipCode  <= '19999' ) {
            return 'DE';
        }
        else if ($zipCode >= '32100' && $zipCode  <= '34999' ) {
            return 'FL';
        }
        else if ($zipCode >= '30000' && $zipCode  <= '31999' ) {
            return 'GA';
        }
        else if ($zipCode >= '96700' && $zipCode  <= '96899' ) {
            return 'HI';
        }
        else if ($zipCode >= '50000' && $zipCode  <= '52899' ) {
            return 'IA';
        }
        else if ($zipCode >= '83200' && $zipCode  <= '83899' ) {
            return 'ID';
        }
        else if ($zipCode >= '60000' && $zipCode  <= '62999' ) {
            return 'IL';
        }
        else if ($zipCode >= '83200' && $zipCode  <= '83899' ) {
            return 'IO';
        }
        else if ($zipCode >= '46000' && $zipCode  <= '47999' ) {
            return 'IN';
        }
        else if ($zipCode >= '66000' && $zipCode  <= '67499' ) {
            return 'KS';
        }
        else if ($zipCode >= '40000' && $zipCode  <= '42799' ) {
            return 'KY';
        }
        else if ($zipCode >= '70000' && $zipCode  <= '71499' ) {
            return 'LA';
        }
        else if ($zipCode >= '01000' && $zipCode  <= '02799' ) {
            return 'MA';
            echo 'Greater';
        }
        else if ($zipCode >= '20600' && $zipCode  <= '21999' ) {
            return 'MD';
        }
        else if ($zipCode >= '03000' && $zipCode  <= '04999' ) {
            return 'ME';
        }
        else if ($zipCode >= '48000' && $zipCode  <= '49799' ) {
            return 'MI';
        }
        else if ($zipCode >= '55000' && $zipCode  <= '56799' ) {
            return 'MN';
        }
        else if ($zipCode >= '63000' && $zipCode  <= '65899' ) {
            return 'MO';
        }
        else if ($zipCode >= '38600' && $zipCode  <= '39599' ) {
            return 'MS';
        }
        else if ($zipCode >= '59000' && $zipCode  <= '59999' ) {
            return 'MT';
        }
        else if ($zipCode >= '27000' && $zipCode  <= '28999' ) {
            return 'NC';
        }
        else if ($zipCode >= '58000' && $zipCode  <= '58899' ) {
            return 'ND';
        }
        else if ($zipCode >= '68000' && $zipCode  <= '69399' ) {
            return 'NE';
        }
        else if ($zipCode >= '03000' && $zipCode  <= '03899' ) {
            return 'NH';
        }
        else if ($zipCode >= '07000' && $zipCode  <= '08999' ) {
            return 'NJ';
        }
        else if ($zipCode >= '87000' && $zipCode  <= '88499' ) {
            return 'NM';
        }
        else if ($zipCode >= '89000' && $zipCode  <= '89899' ) {
            return 'NV';
        }
        else if ($zipCode >= '10000' && $zipCode  <= '14999' ) {
            return 'NY';
        }
        else if ($zipCode >= '43000' && $zipCode  <= '45899' ) {
            return 'OH';
        }
        else if ($zipCode >= '73000' && $zipCode  <= '74999' ) {
            return 'OK';
        }
        else if ($zipCode >= '97000' && $zipCode  <= '97999' ) {
            return 'OR';
        }
        else if ($zipCode >= '15000' && $zipCode  <= '16999' ) {
            return 'PA';
        }
        else if ($zipCode >= '00600' && $zipCode  <= '00799' ) {
            return 'PR';
        }
        else if ($zipCode >= '02800' && $zipCode  <= '02999' ) {
            return 'RI';
        }
        else if ($zipCode >= '29000' && $zipCode  <= '29999' ) {
            return 'SC';
        }
        else if ($zipCode >= '57000' && $zipCode  <= '57799' ) {
            return 'SD';
        }
        else if ($zipCode >= '37000' && $zipCode  <= '38599' ) {
            return 'TN';
        }
        else if ($zipCode >= '75000' && $zipCode  <= '79999' ) {
            return 'TX';
        }
        else if ($zipCode >= '84000' && $zipCode  <= '84799' ) {
            return 'UT';
        }
        else if ($zipCode >= '20101' && $zipCode  <= '24279' ) {
            return 'VA';
        }
        else if ($zipCode >= '98001' && $zipCode  <= '99403' ) {
            return 'WA';
        }
        else if ($zipCode >= '53001' && $zipCode  <= '54990' ) {
            return 'WI';
        }
        else {
            return false;
        }

    }

    function idahoan_breadcrumbs($id) {
        $cat_premium = array (525, 532, 536);
        $cat_real = array (605, 611, 608, 602);
        $cat_signature = array (614);
        $cat_value_advantage = array (629, 623, 620, 617, 626);
        $cat_casseroles = array (647, 644, 641);
        $cat_hash_browns = array (653);

        if (in_array($id, $cat_premium)) {
            $category_segment = '<a href="' . get_home_url() . '/products/premium-mashed">Premium Mashed</a> &gt;&gt; ';
        }

        elseif (in_array($id, $cat_real)) {
            $category_segment = '<a href="' . get_home_url() . '/products/real-mashed">REAL Mashed</a> &gt;&gt; ';
        }

        elseif (in_array($id, $cat_signature)) {
            $category_segment = '<a href="' . get_home_url() . '/products/signature">Signature Mashed</a> &gt;&gt; ';
        }

        elseif (in_array($id, $cat_value_advantage)) {
            $category_segment = '<a href="' . get_home_url() . '/products/value-advantage">Value Advantage</a> &gt;&gt; ';
        }

        elseif (in_array($id, $cat_casseroles)) {
        $category_segment = '<a href="' . get_home_url() . '/products/casseroles">Casseroles</a> &gt;&gt; ';
        }

        elseif (in_array($id, $cat_hash_browns)) {
            $category_segment = '<a href="' . get_home_url() . '/products/fresh-cut-hash-browns">Fresh Cut Hash Browns</a> &gt;&gt; ';
        }

        else {
            $category_segment = '';
        }

        echo '<a href="http://idahoanfoodservice.com/products/">Idahoan® Products</a> &gt;&gt; '; if ($category_segment != '') {echo $category_segment;} the_title();
    }



?>