<?php
/**
 * Theme functions.
 *
 * @package Postali Parent
 * @author Postali LLC
 */
// TESTING GITHUB SETUP
 // debug logging function
if (!function_exists('write_log')) {
    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

// Adding Custom Post Types
require_once dirname( __FILE__ ) . '/includes/case-results-cpt.php'; // Custom Post Type Case Results
require_once dirname( __FILE__ ) . '/includes/testimonials-cpt.php'; // Custom Post Type Testimonials
require_once dirname( __FILE__ ) . '/includes/attorneys-cpt.php'; // Custom Post Type Testimonials


add_theme_support( 'post-thumbnails' );


// Enqueue scripts
function postali_parent_scripts() {
    // Adding parent styles
    wp_enqueue_style( 'parent-stylesheet', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'parent-styles', get_template_directory_uri() . '/assets/css/styles.css');

    // Adding parent block styles
    wp_enqueue_style( 'parent-blocks-stylesheet', get_template_directory_uri() . '/blocks/assets/css/styles.css' );
    

    // Adding Parent JS
    wp_register_script('parent-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js',array('jquery'), null, true); 
    wp_enqueue_script('parent-scripts');

    // Add project specific icomoon library here
    // wp_register_style( 'icomoon', 'https://d1azc1qln24ryf.cloudfront.net/152819/PostaliTier1/style-cf.css?l7x1b4', array() );
    // wp_enqueue_style('icomoon');

    // Default block icomoon icons
    wp_register_style( 'default-blocks-icomoon',  get_template_directory_uri() .'/assets/fonts/icomoon/crest-block-icomoon.woff2', array() );
    wp_enqueue_style('default-blocks-icomoon');

    // Add slick library
    wp_register_script('slick-scripts', get_template_directory_uri() . '/assets/js/slick.min.js',array('jquery'), null, true); 
    wp_enqueue_script('slick-scripts');
    wp_register_script('slick-custom', get_template_directory_uri() . '/assets/js/slick-custom.min.js',array('jquery'), null, true); 
    wp_enqueue_script('slick-custom');
    wp_enqueue_style( 'slick-styles', get_template_directory_uri() . '/assets/css/slick.css'); // Enqueue Parent theme styles.css   

    //Register Block Scripts
    wp_register_script('accordion-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/accordions.min.js',array('jquery'), null, true);
    wp_register_script('accordion-horizontal-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/accordions-horizontal.min.js',array('jquery'), null, true);
    wp_register_script('results-scroller-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/results-scroller.min.js',array('jquery'), null, true);
    wp_register_script('process-slider-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/process-slider.min.js',array('jquery'), null, true);
    wp_register_script('tab-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/tabs.min.js',array('jquery'), null, true);
    wp_register_script('video-block-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/video-block.min.js',array('jquery'), null, true);
    wp_register_script('awards-slider-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/awards-slider.min.js',array('jquery'), null, true);
    wp_register_script('countup-custom', get_stylesheet_directory_uri() . '/blocks/assets/js/countup-custom.min.js',array('jquery'), null, true);
    wp_register_script('countup-scripts', get_stylesheet_directory_uri() . '/assets/js/jquery.countup.min.js',array('jquery'), null, true); 
    wp_register_script('waypoints-scripts', get_stylesheet_directory_uri() . '/assets/js/jquery.waypoints.min.js',array('jquery'), null, true); 
}
add_action('wp_enqueue_scripts', 'postali_parent_scripts');

// Enqueue custom scripts for specific blocks
function enqueue_custom_block_assets() {
    if ( has_block( 'acf/counter-group' ) ) {
          wp_enqueue_script('waypoints-scripts');
          wp_enqueue_script('countup-scripts');
          wp_enqueue_script('countup-custom');
    }
    if ( has_block( 'acf/accordion' ) ) {
        wp_enqueue_script('accordion-scripts');
    }
    if ( has_block( 'acf/accordion-horizontal' ) ) {
        wp_enqueue_script('accordion-horizontal-scripts');
    }
    if ( has_block( 'acf/results-scroller' ) ) {
        wp_enqueue_script('results-scroller-scripts');
    }
    if ( has_block( 'acf/slider-process' ) ) {
        wp_enqueue_script('process-slider-scripts');
    }
    if ( has_block( 'acf/tabs' ) ) {
        wp_enqueue_script('tab-scripts');
    }
    if ( has_block( 'acf/video-block' ) || has_block( 'acf/large-video-embed' ) ) {
        wp_enqueue_script('video-block-scripts');
    }
    if ( has_block( 'acf/awards' ) ) {
        wp_enqueue_script('awards-slider-scripts');
    }
}
add_action( 'enqueue_block_assets', 'enqueue_custom_block_assets' );


// Register Site Navigations
function postali_parent_register_nav_menus() {
    register_nav_menus(
        array(
            'header-nav' => __( 'Header Navigation', 'postali' ),
            'footer-nav' => __( 'Footer Navigation', 'postali' ),
            'practice-areas-nav' => __( 'Pratice Areas Navigation', 'postali' ),
        )
    );
}
add_action( 'init', 'postali_parent_register_nav_menus' );


// Add required options pages
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Global Schema',
        'menu_title'    => 'Global Schema',
        'menu_slug'     => 'global-schema',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-networking', // Add this line and replace the second inverted commas with class of the icon you like
        'redirect'      => false
    ));
    
    // acf_add_options_page(array(
    //     'page_title'    => 'Github Settings',
    //     'menu_title'    => 'Github Settings',
    //     'menu_slug'     => 'github-settings',
    //     'capability'    => 'edit_posts',
    //     'icon_url'      => 'dashicons-rest-api',
    //     'redirect'      => false
    // ));

    acf_add_options_page(array(
        'page_title'    => 'Awards',
        'menu_title'    => 'Awards',
        'menu_slug'     => 'awards',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-awards',
        'redirect'      => false
    ));
}

// Add required ACF fields for options pages
function parent_crest_acf_options_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_5a9b9b0b9e9b6',
        'title' => 'Global Schema',
        'fields' => array (
            array (
                'key' => 'field_5a9b9b0b9e9b7',
                'label' => 'Global Schema',
                'name' => 'global_schema',
                'type' => 'textarea',
                'instructions' => '<strong>Do not</strong> include script tags. They will be added automatically.'
            )
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'global-schema'
                ),
            ),
        ),
    ));

    // acf_add_local_field_group(array(
    //     'key' => 'group_15a9b9b0b9e9b6',
    //     'title' => 'Github Settings',
    //     'fields' => array (
    //         array (
    //             'key' => 'field_15a9b9b0b9e9b7',
    //             'label' => 'Github Token',
    //             'name' => 'github_token',
    //             'type' => 'password',
    //         )
    //     ),
    //     'location' => array (
    //         array (
    //             array (
    //                 'param' => 'options_page',
    //                 'operator' => '==',
    //                 'value' => 'github-settings'
    //             ),
    //         ),
    //     ),
    // ));
}
add_action('acf/init', 'parent_crest_acf_options_fields');

// Add ability to add SVG to Wordpress Media Library
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// Add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


// Enable upload for webp image files
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');


// Enable preview / thumbnail for webp image files.
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );
        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }
    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);


// Display Current Year as shortcode - [year]
function year_shortcode () {
    $year = date_i18n ('Y');
    return $year;
}
add_shortcode ('year', 'year_shortcode');


// WP Backend Menu area taller
add_action('admin_head', 'taller_menus');
function taller_menus() {
    echo '<style>
        .posttypediv div.tabs-panel {
            max-height:500px !important;
        }
    </style>';
}


// Add Search Bar to Top Nav
function mainmenu_navsearch($items, $args) {
    if ($args->theme_location == 'header-nav') {
        ob_start();
        ?>
        <li class="menu-item menu-item-search search-holder">
            <form class="navbar-form-search" role="search" method="get" action="/">
                <div class="search-form-container hdn" id="search-input-container">
                    <div class="search-input-group">
                        <div class="form-group">
                            <input type="text" name="s" placeholder="Search for..." id="search-input-5cab7fd94d469" value="" class="form-control">
                            <label for="s">search for... </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-search" id="search-button"><span class="icon-search-icon" aria-hidden="true"></span></button>
            </form>	
        </li>

        <?php
        $new_items = ob_get_clean();

        $items .= $new_items;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'mainmenu_navsearch', 10, 2);


// Add template column to page list in wp-admin
function page_column_views( $defaults ) {
    $defaults['page-layout'] = __('Template');
    return $defaults;
}
add_filter( 'manage_pages_columns', 'page_column_views' );

function page_custom_column_views( $column_name, $id ) {
    if ( $column_name === 'page-layout' ) {
        $set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
        if ( $set_template == 'default' ) {
            echo 'Default';
        }
        $templates = get_page_templates();
        ksort( $templates );
        foreach ( array_keys( $templates ) as $template ) :
            if ( $set_template == $templates[$template] ) echo $template;
        endforeach;
    }
}
add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );


// debug logging function
if (!function_exists('write_log')) {
    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}


// Automatic theme updates from the GitHub repository
// function automatic_GitHub_updates($data) {
//     // Theme information
//     //$theme   = basename(get_template_directory()); // Folder name of the current theme
//     $theme = 'crest-controller-theme-main';
//     $current = wp_get_theme()->get('Version'); // Get the version of the current theme
//     // GitHub information	    
//     $user = 'Postali-Webdev'; // The GitHub username hosting the repository
//     $repo = 'Crest-Controller-Theme'; // Repository name as it appears in the URL
//     $token = get_field('github_token', 'option'); //https://github.com/settings/personal-access-tokens/new
//     $file = @json_decode(@file_get_contents('https://api.github.com/repos/'.$user.'/'.$repo.'/releases/latest', false,
//             stream_context_create(['http' => ['header' => "User-Agent: ".$user."\r\nAuthorization: token $token\r\n"]])
//         ));

//     if($file) {
//         $zip_source = $file->zipball_url;
//         $update = filter_var($file->tag_name, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
//         // Only return a response if the new version number is higher than the current version
//         if($update > $current) {
//             $data->response[$theme] = array(
//                 'theme'       =>  'crest-controller-theme-main',
//                 // Strip the version number of any non-alpha characters (excluding the period)
//                 // This way you can still use tags like v1.1 or ver1.1 if desired
//                 'new_version' => $update,
//                 'url'         => 'https://github.com/'.$user.'/'.$repo,
//                 'package'     => $zip_source
//             );
//         }
//     }
//     return $data;

//     echo $data;    
// }
// add_filter('pre_set_site_transient_update_themes', 'automatic_GitHub_updates', 100, 1);



// function rename_updated_theme($true, $hook_extra, $result) {
//     // Check if the updated theme is the one we want to rename
//     if ($hook_extra['theme'] === 'crest-controller-theme-main') {
//         // Get the path to the updated theme
//         $theme_dir = $result['destination'];
//         // Rename the theme directory
//         $new_theme_dir = WP_CONTENT_DIR . '/themes/crest-controller-theme-main';
//         if (rename($theme_dir, $new_theme_dir)) {
//             // Rename successful
//         } else {
//             // Rename failed, log an error
//             error_log("Failed to rename theme directory to $new_theme_dir");
//         }   
//     }
// }
// add_action('upgrader_post_install', 'rename_updated_theme', 10, 3);



// add_filter('http_request_args', function($parsed_args, $url) {
//     $token = get_field('github_token', 'option'); //https://github.com/settings/personal-access-tokens/new
//     $user = 'Postali-Webdev'; // The GitHub username hosting the repository
//     $repo = 'Crest-Controller-Theme'; // Repository name as it appears in the URL

//     if (str_contains($url, "$user/$repo")) {
//         $parsed_args['headers'] = ['Authorization'=> 'token '.$token];
//     }
//     return $parsed_args;
// }, 10, 2);

add_filter( 'block_categories_all' , function( $categories ) {
    // Adding a new category.
	$categories[] = array(
		'slug'  => 'postali-blocks',
		'title' => 'Postali Crest Blocks'
	);
	return $categories;
} );


/* ACF Register Blocks */
function postali_crest_register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/accordions' );
    register_block_type( __DIR__ . '/blocks/accordions-horizontal' );
    register_block_type( __DIR__ . '/blocks/attorneys-block' );
    register_block_type( __DIR__ . '/blocks/awards-block' );
    register_block_type( __DIR__ . '/blocks/banner-block' );
    register_block_type( __DIR__ . '/blocks/columns' );
    register_block_type( __DIR__ . '/blocks/contact-block' );
    register_block_type( __DIR__ . '/blocks/cta-block' );
    register_block_type( __DIR__ . '/blocks/link-block' );
    register_block_type( __DIR__ . '/blocks/map-block' );
    register_block_type( __DIR__ . '/blocks/related-resources' );
    register_block_type( __DIR__ . '/blocks/results-scroller' );
    register_block_type( __DIR__ . '/blocks/slider-process' );
    register_block_type( __DIR__ . '/blocks/tabs' );
    register_block_type( __DIR__ . '/blocks/testimonials-block' );
    register_block_type( __DIR__ . '/blocks/video-block' );
    register_block_type( __DIR__ . '/blocks/large-video-block' );
    register_block_type( __DIR__ . '/blocks/theme-button' );
    register_block_type( __DIR__ . '/blocks/ordered-list-block' );
    register_block_type( __DIR__ . '/blocks/resource-cards' );
    register_block_type( __DIR__ . '/blocks/single-testimonial' );
    register_block_type( __DIR__ . '/blocks/counter-block' );
    register_block_type( __DIR__ . '/blocks/randomized-single-testimonial' );
}
add_action( 'init', 'postali_crest_register_acf_blocks' );

function my_allowed_block_types( $allowed_block_types, $editor_context ) {

    $allowed_blocks = [
        'core/paragraph',
        'core/image',
        'core/heading',
        'core/list',
        'core/table',
        'core/columns',
        'core/group',
        'core/spacer',
        'core/separator',
        'core/custom-html',
        'core/form',
        'yoast-seo/breadcrumbs',
        'acf/accordion',
        'acf/accordion-horizontal',
        'acf/attorneys-block',
        'acf/awards',
        'acf/banner-block',
        'acf/columns',
        'acf/contact',
        'acf/cta-block',
        'acf/large-video-embed',
        'acf/links',
        'acf/map',
        'acf/related',
        'acf/results-scroller',
        'acf/slider-process',
        'acf/tabs',
        'acf/testimonials-block',
        'acf/video-block',
        'acf/crest-button',
        'acf/ordered-list',
        'acf/resource-cards',
        'acf/single-testimonial',
        'acf/counter-group',
        'acf/random-testimonial'
    ];
    return $allowed_blocks;
}
add_filter( 'allowed_block_types', 'my_allowed_block_types', 10, 2 );

// Widget Logic Conditionals (ancestor)
function is_tree( $pid ) {
    global $post;

        if ( is_page($pid) )

        return true;

    $anc = get_post_ancestors( $post->ID );

        foreach ( $anc as $ancestor ) {

        if( is_page() && $ancestor == $pid ) {
            return true;
        }
    }
    return false;
}


function my_plugin_enqueue_block_editor_assets() {
	wp_enqueue_script(
		'extended-group-script',
		get_template_directory_uri() . '/assets/js/src/extended-group-script.js', // Or your plugin dir
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-compose', 'wp-hooks' ),
		null,
		true
	);

    wp_enqueue_script(
		'extended-column-script',
		get_template_directory_uri() . '/assets/js/src/extended-column-script.js', // Or your plugin dir
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-compose', 'wp-hooks' ),
		null,
		true
	);

    wp_enqueue_style( 'admin-stylesheet', get_template_directory_uri() . '/admin-editor-assets/css/styles.css' );
}
add_action( 'enqueue_block_editor_assets', 'my_plugin_enqueue_block_editor_assets' );
