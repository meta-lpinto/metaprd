<?php

$output = '<div class="row">';

if( $show_count )
{
	$output .= '<div class="event-filter-info col-12">';
		$output .= '<div class="event-filter-info-inner row clearfix">';
			$output .= '<div class="col-md-6 event_count_info">';
				$output .= esc_html__( 'TOTAL ','primestudio' ) . '<span class="event_count">' . $total_count . '</span>' . esc_html__( ' EVENTS SHOWING','primestudio' );
			$output .= '</div>';
		$output .= '</div><!--end .event-filter-info-inner -->';
	$output .= '</div><!--end .event-filter-info -->';
}

	$output .= '<div id="event-filter-container" class="event-filter-container col-12">';
		$output .= '<div class="event-filter-container-inner row clearfix">';
			$output .= '<div class="event-cat col-4 col-md hover-efect-1" style="background: #323E48" >';
				$output .= '<div class="event-filter-container-bg" background-color: #323E48"></div>'; //style="background-image: url(\'http://meta.local/wp-content/themes/primestudio-child-theme/images/event-default.jpg\');
				$output .= '<div class="event-cat-inner row clearfix">';
					$output .= '<a href="#event-cat-list" class="" data-filter="*" data-count="' . $total_count . '">';
						$output .= '<p class="cat-order">#0</p>';
						$output .= '<div class="cat-title" style="color: #FFF">' . esc_html__( 'ALL','primestudio' ) . '</div>';
					$output .= '</a>';
				$output .= '</div><!--end .event-cat-inner -->';
			$output .= '</div><!--end .event-cat -->';
		

	foreach ( $categories as $nro => $cat )
	{
		$cat_thumbnail_id 	= get_term_meta( $cat->term_id, 'thumbnail_id', true );
		$cat_background		= get_term_meta( $cat->term_id, 'background', true );
		$cat_position		= get_term_meta( $cat->term_id, 'position', true );
		$cat_color			= get_term_meta( $cat->term_id, 'color', true );

			$output .= '<div class="event-cat col-4 col-md hover-efect-1" style="background-color: ' . ( ( $cat_background ) ? $cat_background : '#B5DBD2' ) . '">';
			if( $cat_thumbnail_id ) 
				$output .= '<div class="event-filter-container-bg" style="background-image: url(\'' . wp_get_attachment_url( $cat_thumbnail_id, 'full' ) . '\'); background-color: ' . ( ( $cat_background ) ? $cat_background : '#B5DBD2' ) . '; background-position: ' . ( ( $cat_position ) ? $cat_position : 'center' ) . '"></div>';
				$output .= '<div class="event-cat-inner row clearfix">';
					$output .= '<a href="#event-cat-list" class="" data-filter=".' . $cat->slug . '" data-count="' . $cat->count . '">';
						$output .= '<p class="cat-order">#'. ( $nro+1 ).'</p>';
						$output .= '<div class="cat-title" style="color: ' . ( ( $cat_color ) ? $cat_color : '#FFF' ) . '">' . strtoupper( $cat->description ) . '</div>';
					$output .= '</a>';
					$output .= '<img class="arrow" src="'. get_stylesheet_directory_uri() . '/images/down-arrow.svg" />';
				$output .= '</div><!--end .event-cat-inner -->';
			$output .= '</div><!--end .event-cat -->';
	}
		$output .= '</div><!--end .event-filter-container-inner -->';
	
	$output .= '</div><!--end .event-filter-container -->';
	$output .= '<div id="event-container" class="event-container col-12 col-md-10 col-lg-8 mx-auto">';
		$output .= '<div class="clearfix event-container-inner row">';

	if ( $events ) : 

		foreach( $events as $event ) :

			$terms = get_the_terms( $event->ID, 'tribe_events_cat' );
			$slug =  ( !$terms ) ? '' : array_reduce( $terms , function( $c, $v )
				{
					$c .= ' '. $v->slug;
					return $c;
				});

			$output .= '<div class="event-item wpb_animate_when_almost_visible wpb_start_animation wpb_top-to-bottom col-12 '. $slug . '">'; 

			$output .= '<a href="' . get_the_permalink( $event->ID ) . '" class="event-item-inner row">';
				$output .= '<div class="col-2 event-date"><span class="day">'.tribe_get_start_date( $event->ID, false, 'd' ).'</span><span class="month">'.tribe_get_start_date( $event->ID, false, 'M' ).'<span class="year">'.tribe_get_start_date( $event->ID, false, 'Y' ).'</span></span></div>';
				$output .= '<div class="col-8 event-title truncate">'.$event->post_title.'<span>'. $slug . '</span></div>';
				$output .= '<div class="col-2 event-link">' . esc_html__( 'IR AL EVENTO','primestudio' ) . '</div>';
			$output .= '</a><!--end .event-item-inner -->'; 
			$output .= '</div><!--end .event-item -->';

		endforeach;
	endif;

	wp_reset_postdata();
		$output .= '</div><!-- end .event-container-inner-->';
	$output .= '</div><!-- end #event-container-->';
$output .= '</div>';

echo $output;
?>