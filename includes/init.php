<?php 
if ( ! defined( 'ABSPATH' ) ) die( 'Accessing this file directly is denied.' );

/*-----------------------------------------------*
Enqueue Style , Script ( new bootstrap )
/*-----------------------------------------------*/
function enqueue_styles_scripts()
{

    $parent_style    = 'orbisius_ct_primestudio_child_theme_parent_style';
    $parent_base_dir = 'primestudio';

    //parent style
    wp_enqueue_style( $parent_style,
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme( $parent_base_dir ) ? wp_get_theme( $parent_base_dir )->get('Version') : ''
    );
    
    //child theme style
    wp_enqueue_style( 'primestudio-style',
        get_stylesheet_directory_uri() . '/style.css',
        [ $parent_style ],
        wp_get_theme()->get('Version')
    );

    //new bootstrap style
    wp_enqueue_style( 'bootstrap',  
        get_stylesheet_directory_uri() . '/css/bootstrap.min.css',
        '', '4.1.1'
    );

    //new bootstrap script
    wp_enqueue_script( 'bootstrap-js',  
        get_stylesheet_directory_uri() . '/js/bootstrap.min.js',
        '', '4.1.1'
    );

    //new custom script
    wp_enqueue_script( 'hala-child-custom-js', 
        get_stylesheet_directory_uri() .  '/js/custom.js', 
        [ 'jquery' ], '', true 
    );
}

function wptuts_add_color_picker( $hook ) {
 
    if( is_admin() ) { 
     
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
         
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', get_theme_file_uri( 'js/custom-admin.js' ), array( 'wp-color-picker' ), false, true ); 
    }
}

function add_custom_mime_types( $mimes )
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

function cptui_register_my_cpts()
{
    /**
     * Post Type: Meta Events.
     */

    $labels = [
        'name'                  => esc_html__( 'Meta Events',                   'primestudio' ),
        'singular_name'         => esc_html__( 'Meta Event',                    'primestudio' ),
        'menu_name'             => _x( 'Meta Events', 'admin menu',             'primestudio' ),
        'name_admin_bar'        => _x( 'Meta Event', 'add new on admin bar',    'primestudio' ),
        'add_new'               => esc_html__( 'Add New Event',                 'primestudio' ),
        'add_new_item'          => esc_html__( 'Add New Event',                 'primestudio' ),
        'edit_item'             => esc_html__( 'Edit Event',                    'primestudio' ),
        'new_item'              => esc_html__( 'New Event',                     'primestudio' ),
        'view_item'             => esc_html__( 'View Event',                    'primestudio' ),
        'all_items'             => esc_html__( 'All Meta Event',                'primestudio' ),
        'search_items'          => esc_html__( 'Search Event',                  'primestudio' ),
        'not_found'             => esc_html__( 'No Event found',                'primestudio' ),
        'not_found_in_trash'    => esc_html__( 'No Event found in Trash',       'primestudio' ),
        'menu_name'             => esc_html__( 'Meta Events',                   'primestudio' )
    ];

    $args = array(
        "label"                 => __( "Meta Events", "" ),
        "labels"                => $labels,
        "description"           => "",
        "public"                => true,
        "publicly_queryable"    => true,
        "show_ui"               => true,
        "delete_with_user"      => false,
        "show_in_rest"          => true,
        "rest_base"             => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive"           => "meta_archive",
        "show_in_menu"          => true,
        "show_in_nav_menus"     => true,
        "exclude_from_search"   => false,
        "capability_type"       => "post",
        "map_meta_cap"          => true,
        "hierarchical"          => false,
        "rewrite"               => array( "slug" => "meta_event", "with_front" => true ),
        "query_var"             => true,
        "menu_position"         => 8,
        "menu_icon"             => "dashicons-calendar",
        "supports"              => array( "title", "editor", "thumbnail", "excerpt", "custom-fields", "revisions", "page-attributes" ),
        "taxonomies"            => array( "post_tag", "meta_category" ),
    );

    register_post_type( "meta_event", $args );
}

function cptui_register_my_taxes()
{
    /**
     * Taxonomy: Meta Categories.
     */

    $labels = [
        'name'              => esc_html__( 'Meta Events Categories',    'primestudio' ),
        'singular_name'     => esc_html__( 'Meta Category',             'primestudio' ),
        'search_items'      => esc_html__( 'Search Categories',         'primestudio' ),
        'all_items'         => esc_html__( 'All Categories',            'primestudio' ),
        'parent_item'       => esc_html__( 'Parent Category',           'primestudio' ),
        'parent_item_colon' => esc_html__( 'Parent Category:',          'primestudio' ),
        'edit_item'         => esc_html__( 'Edit Category',             'primestudio' ),
        'update_item'       => esc_html__( 'Update Category',           'primestudio' ),
        'add_new_item'      => esc_html__( 'Add New Category',          'primestudio' ),
        'new_item_name'     => esc_html__( 'New Category Name',         'primestudio' ),
        'menu_name'         => esc_html__( 'Meta Categories',           'primestudio' )
    ];

    $args = array(
        "label"                     => __( "Meta Categories", "" ),
        "labels"                    => $labels,
        "public"                    => true,
        "publicly_queryable"        => true,
        "hierarchical"              => true,
        "show_ui"                   => true,
        "show_in_menu"              => true,
        "show_in_nav_menus"         => true,
        "query_var"                 => true,
        "rewrite"                   => array( 'slug'  => 'meta_category', 'with_front' => true, ),
        "show_admin_column"         => true,
        "show_in_rest"              => true,
        "rest_base"                 => "meta_category",
        "rest_controller_class"     => "WP_REST_Terms_Controller",
        "show_in_quick_edit"        => false,
        );

    register_taxonomy( "meta_category", array( "meta_event" ), $args );
}

add_action( 'init',                     'cptui_register_my_taxes' );
add_action( 'init',                     'cptui_register_my_cpts'  ); 
add_action( 'wp_enqueue_scripts',       'enqueue_styles_scripts'  );
add_action( 'admin_enqueue_scripts',    'wptuts_add_color_picker' );

add_filter('upload_mimes','add_custom_mime_types');
?>