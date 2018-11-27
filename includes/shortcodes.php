<?php

function filter_tribe_events_handle( $atts, $content = null )
{
  extract( shortcode_atts( array(
   'max_events'           =>  -1,
   'show_count'           =>  0,
   'exclude_cat'          =>  '',
   'no_of_columns'         =>  6
 ), $atts, 'filter' ) );

  $css_class = '';

  //$exclude_cat_arr   = explode(',', $filter_cat);
  $tax_query[]      = [ 
    'taxonomy' => 'tribe_events' //,'field'    => 'term_id', 'terms'    => $filter_cat_arr
  ];

  $events       = tribe_get_events( array( 'posts_per_page' => $max_events ) );
  $categories   = get_categories( [ 
    'taxonomy'  => 'tribe_events_cat', 
    'orderby'   => 'date',
    'order'     => 'ASC' 
  ]);

  $total_count    = isset( $events ) ? count( $events ) : 0 ;
  $output         = "";

  if (! wp_script_is( 'isotope', 'enqueued' ) )
    wp_enqueue_script( 'isotope', 
      get_theme_file_uri( 'js/isotope.pkgd.min.js' ), 
      array('jquery'), '', true );

  if (! wp_script_is( 'images-loaded', 'enqueued' ) )
    wp_enqueue_script( 'images-loaded', 
      get_theme_file_uri( 'js/imagesloaded.pkgd.min.js' ), 
        array('jquery'), '', true );

  wp_enqueue_script( 'event-filter', 
    get_theme_file_uri( 'js/event-filter.js' ), 
    array('isotope', 'images-loaded'), '', true );

  wp_enqueue_style( 'event-filter-style', 
    get_theme_file_uri( 'css/event-filter-style.css' ), 
    array(), '' );

  set_query_var( 'events',        $events );
  set_query_var( 'categories',    $categories );
  set_query_var( 'show_count',    $show_count );
  set_query_var( 'total_count',   $total_count );
  set_query_var( 'no_of_columns',  $no_of_columns );

  get_template_part( 'template-parts/filter', 'tribe_events' );
}

/*function filter_meta_event_handle( $atts, $content = null )
{
  extract( shortcode_atts( array(
   'section_title'        =>  '',
   'filter_cat'           =>  '',
   'cat_icon'             =>  'Yes',
   'cat_filter_masonry'   =>  '',
   'cat_icon_position'    =>  '2',
   'cat_filter_position'  =>  '1',
   'filter_top_alignment' =>  'left',
   'filter_design'        =>  'salon',
   'no_of_column'         =>  'col-md-3',
   'show_title'           =>  1,
   'show_price'           =>  1,
   'filter_style'         =>  '',
 ), $atts, 'filter' ) );

  $css_class = '';

  if( $filter_style )
  {
    //Design Options settings class need to imlemented as per requirement
    $css_class = apply_filters( 
      VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 
      vc_shortcode_custom_css_class( $filter_style, ' ' ), '', $atts['filter_style'] );
  }

  $section_title    = rawurldecode( base64_decode( strip_tags( $section_title ) ) );
  $filter_cat_arr   = explode(',', $filter_cat);
  $tax_query[]      = [ 
    'taxonomy' => 'tribe_events' //,'field'    => 'term_id', 'terms'    => $filter_cat_arr
  ];

  $args['post_type']      = 'tribe_events';
  $args['posts_per_page'] = -1;

  if( count( $tax_query ) > 0 )
  {
    $args['tax_query'] = $tax_query;
  }

  //$query = new WP_Query( $args );
  $query = tribe_get_events( array( 'posts_per_page' => -1 ) );
  echo "<pre>"; var_dump( $query ); die();
  $total_count    = isset( $query ) ? $query->post_count : 0 ;
  $output         = "";

  /******** VIEW/TEMPLATE FILE, CSS & JS INCLUDE START *******
  if (! wp_script_is( 'isotope', 'enqueued' ) )
    wp_enqueue_script( 'isotope', ZE_VC_PLUGIN_JS_URI. 'vendor/isotope.pkgd.min.js', array('jquery'), ZE_VC_VERSION, true );

  if (! wp_script_is( 'images-loaded', 'enqueued' ) )
    wp_enqueue_script( 'images-loaded', ZE_VC_PLUGIN_JS_URI. 'vendor/imagesloaded.pkgd.min.js', array('jquery'), ZE_VC_VERSION, true );

  wp_enqueue_script( 'event-filter', 
    ZE_VC_PLUGIN_JS_URI . 'custom/event-filter.js', 
    array('isotope', 'images-loaded'), ZE_VC_VERSION, true );

  wp_localize_script( 'event-filter', 
    'zevcproductfilter', 
    array('masonry' => $cat_filter_masonry) );

  wp_enqueue_style( 'event-filter-style', 
    ZE_VC_PLUGIN_CSS_URI . 'custom/event-filter-style.css', 
    array(), ZE_VC_VERSION );


  require ( 'events_filter_template.php' );


  return $output;
}*/

add_shortcode( "filter_tribe_events", "filter_tribe_events_handle" );

?>