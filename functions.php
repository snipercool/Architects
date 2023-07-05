<?php
/**
 * architects functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package architects
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function architects_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on architects, use a find and replace
		* to change 'architects' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'architects', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'architects' ),
			'footer' => esc_html__( 'Footer', 'architects' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	function wpdocs_remove_menus(){
		remove_menu_page( 'jetpack' );            //Jetpack* 
		remove_menu_page( 'edit-comments.php' );          //Comments
		remove_menu_page( 'edit.php' ); 		
	  }
	  add_action( 'admin_menu', 'wpdocs_remove_menus' );

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'architects_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'architects_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function architects_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'architects_content_width', 640 );
}
add_action( 'after_setup_theme', 'architects_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function architects_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'architects' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'architects' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'architects_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function architects_scripts() {
	global $wp_query;
	wp_enqueue_style( 'architects-style', get_template_directory_uri().'/dist/css/app.css', array(), _S_VERSION );
	wp_enqueue_style( 'animate-style', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), _S_VERSION );

	
	wp_enqueue_script('architects-script', get_template_directory_uri() . '/dist/js/app.js', array('jquery'), _S_VERSION, true);

    wp_localize_script('architects-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action( 'wp_enqueue_scripts', 'architects_scripts' );

function load_admin_style() {
	wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/admin-style.css' );
  }
  add_action( 'admin_enqueue_scripts', 'load_admin_style' );

/* ---------------------------------
   -------  ACF Functions  ---------
   --------------------------------- */

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();	
}

add_filter('block_categories_all', 'custom_cat_blocks', 10, 2);
function custom_cat_blocks( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'architects',
				'title' => __( 'Architects', 'architects' ),
			),
		)
	);
}

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {
    if( function_exists('acf_register_block_type') ) { 
		//Text with image - 2 sections
        acf_register_block_type(array(
            'name'              => 'text-with-image',
            'title'             => __('Text with image'),
            'render_template'   => '/template-parts/image-with-text.php',
            'category'          => 'architects',
            'icon'              => 'align-pull-right',
            'keywords'          => array('images', 'text', 'block'),
        ));
    }
}

/* ---------------------------------
   ------  Custom Functions  -------
   --------------------------------- */

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
	   return $data;
	}
  
	$filetype = wp_check_filetype( $filename, $mimes );
  
	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
  
}, 10, 4 );
  
function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
  
function fix_svg() {
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
    }
add_action( 'admin_head', 'fix_svg' );

// Add custom post types and taxonomies

function custom_post_tax()
{
	// Custom post types
	$labels = array(
		'name'               => __( 'Projecten', '_themename' ),
		'singular_name'      => __( 'Project', '_themename' ),
		'menu_name'          => __( 'Projecten', '_themename' ),
		'name_admin_bar'     => __( 'Projecten', '_themename' ),
		'add_new'            => __( 'Nieuwe Project', '_themename' ),
		'add_new_item'       => __( 'Nieuwe Project toevoegen', '_themename' ),
		'new_item'           => __( 'Nieuwe Project', '_themename' ),
		'edit_item'          => __( 'Project bewerken', '_themename' ),
		'view_item'          => __( 'Project bekijken', '_themename' ),
		'all_items'          => __( 'Alle Projecten', '_themename' ),
		'search_items'       => __( 'Project zoeken', '_themename' ),
		'parent_item_colon'  => __( 'Hoofd Project', '_themename' ),
		'not_found'          => __( 'Geen Projecten gevonden.', '_themename' ),
		'not_found_in_trash' => __( 'Geen Projecten gevonden in de prullenmand.', '_themename' )
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'project', 'with_front' => false),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 21,
		'menu_icon'			 => 'dashicons-archive',		
		'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes')
	);
	register_post_type( 'projecten', $args );

	// Custom Taxonomies

	$labels = array(
		'name'              => __( 'Categoriëen', '_themename' ),
		'singular_name'     => __( 'Categorie', '_themename' ),
		'search_items'      => __( 'Search Categoriëen', '_themename' ),
		'all_items'         => __( 'All Categoriëen', '_themename' ),
		'parent_item'       => __( 'Parent Categorie', '_themename' ),
		'parent_item_colon' => __( 'Parent Categorie:', '_themename' ),
		'edit_item'         => __( 'Edit Categorie', '_themename' ),
		'update_item'       => __( 'Update Categorie', '_themename' ),
		'add_new_item'      => __( 'Add New Categorie', '_themename' ),
		'new_item_name'     => __( 'New Categorie', '_themename' ),
		'menu_name'         => __( 'Categoriëen', '_themename' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,	
		'rewrite'           => array( 'slug' => 'category','with_front' => false),

	);
	register_taxonomy( 'project_category', array( 'projecten'), $args );
}
add_action( 'init', 'custom_post_tax' );

/* ---------------------------------
   ------  Custom shortcodes  ------
   --------------------------------- */

   

/* ---------------------------------
   ----------  Ajax calls  ---------
   --------------------------------- */

   add_action("wp_ajax_nopriv_get_filtered_projects", "get_filtered_projects");
   add_action("wp_ajax_get_filtered_projects", "get_filtered_projects");
   
   function get_filtered_projects(){
    $cat = $_POST['category'];

    $args = array(
        'post_type'      => 'projecten',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'post_status'    => 'publish',
    );

    // Add category filter to the query if it is present
    if (!empty($cat)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'project_category',
                'field'    => 'slug',
                'terms'    => $cat,
            ),
        );
    }

    $projects = new WP_Query($args);
    if ($projects->have_posts()) {
		$counter = 1;
        while ($projects->have_posts()) {
            $projects->the_post();
			$project_classes = 'project';
			if ($counter === 1 || ($counter - 5) % 6 === 0 || ($counter - 7) % 6 === 0) {
				$project_classes .= ' big';
			}
			if ($terms[0]->slug == 'appartementen' || $terms[0]->slug == 'parkings' ){ $value = 'vanaf:';}else{ $value = '';}
            echo '<div class="'.$project_classes.'" data-aos="fade-up">';
            echo '<h2 class="text-right ko-mobile">'.get_the_title().'<br><span class="price">'.$value.' € '.get_field('proj_price').'</span></h2>';
            echo '<p>Bekijk project</p>';
            echo '<div class="pic" style="background-image: url(' . get_the_post_thumbnail_url() . ')"></div>';
            echo '<a class="project-link" href="'.the_permalink().'"></a>';
            echo '<div class="arrow">';
            echo '<svg fill="none" viewBox="0 0 20 20" height="20" width="20" xmlns="http://www.w3.org/2000/svg">';
            echo '<path xmlns="http://www.w3.org/2000/svg" d="M12.2929 5.29289C12.6834 4.90237 13.3166 4.90237 13.7071 5.29289L19.7071 11.2929C19.8946 11.4804 20 11.7348 20 12C20 12.2652 19.8946 12.5196 19.7071 12.7071L13.7071 18.7071C13.3166 19.0976 12.6834 19.0976 12.2929 18.7071C11.9024 18.3166 11.9024 17.6834 12.2929 17.2929L16.5858 13L5 13C4.44772 13 4 12.5523 4 12C4 11.4477 4.44772 11 5 11L16.5858 11L12.2929 6.70711C11.9024 6.31658 11.9024 5.68342 12.2929 5.29289Z" fill="#ffffff"></path>';
            echo '</svg>';
            echo '</div>';
            echo '</div>';
			$counter++;
        }
        wp_reset_postdata();
    }
    wp_die();
}
