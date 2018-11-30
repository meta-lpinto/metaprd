<?php

function filter_tribe_events_handle( $atts, $content = null )
{
  extract( shortcode_atts( array(
   'max_events'           =>  -1,
   'show_count'           =>  0,
   'exclude_cat'          =>  ''
 ), $atts ) );

  $events       = tribe_get_events([ 
    'posts_per_page' => $max_events 
  ]);

  $categories   = get_categories([ 
    'taxonomy'  => 'tribe_events_cat', 
    'orderby'   => 'id',
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

  if (! wp_script_is( 'event-filter', 'enqueued' ) )
    wp_enqueue_script( 'event-filter', 
      get_theme_file_uri( 'js/event-filter.js' ), 
      array('isotope', 'images-loaded'), '', true );

  if (! wp_style_is( 'event-filter-style', 'enqueued' ) )
  wp_enqueue_style( 'event-filter-style', 
    get_theme_file_uri( 'css/event-filter-style.css' ), 
    array(), '' );

  set_query_var( 'events',         $events );
  set_query_var( 'categories',     $categories );
  set_query_var( 'show_count',     $show_count );
  set_query_var( 'total_count',    $total_count );

  get_template_part( 'template-parts/filter', 'tribe_events' );
}

function filter_meta_events_handle( $atts, $content = null )
{
  extract( shortcode_atts( array( 
    'columns'     => 4,
    'max_events'  => -1,
    'show_filter' => 0,
    'orderby'     => 'id',
    'order'       => 'DESC'
  ), $atts ) );

  if (! wp_script_is( 'isotope', 'enqueued' ) )
    wp_enqueue_script( 'isotope', 
      get_theme_file_uri( 'js/isotope.pkgd.min.js' ), 
      array('jquery'), '', true );

  if (! wp_script_is( 'images-loaded', 'enqueued' ) )
    wp_enqueue_script( 'images-loaded', 
      get_theme_file_uri( 'js/imagesloaded.pkgd.min.js' ), 
        array('jquery'), '', true );

  if (! wp_script_is( 'event-filter', 'enqueued' ) )
    wp_enqueue_script( 'event-filter', 
      get_theme_file_uri( 'js/event-filter.js' ), 
      array('isotope', 'images-loaded'), '', true );

  if (! wp_style_is( 'event-filter-style', 'enqueued' ) )
    wp_enqueue_style( 'event-filter-style', 
      get_theme_file_uri( 'css/event-filter-style.css' ), 
      array(), '' );
  
  $event = new WP_Query( [ 
    'post_type'       => 'meta_event', 
    'orderby'         => $orderby, 
    'order'           => $order,
    'posts_per_page'  => $max_events
  ]);

  if( $show_filter )
  {
    $categories   = get_categories( [ 
      'taxonomy'  => 'meta_category', 
      'orderby'   => 'id',
      'order'     => 'ASC' 
    ]);

    set_query_var( 'show_filter', 1 );
    set_query_var( 'categories', $categories );
  }
  
  
  set_query_var( 'event', $event );
  set_query_var( 'columns', $columns );
  get_template_part( 'template-parts/filter', 'meta_events' );
}

add_shortcode( "filter_tribe_events", "filter_tribe_events_handle" );
add_shortcode( "filter_meta_events",  "filter_meta_events_handle" );

?>