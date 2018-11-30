<?php 
$output = '<div id="widget-meta-events" class="row">';

if( isset( $show_filter ) && $show_filter ) :
	$output .= '<div id="meta-event-filter-container" class="meta-event-filter-container col-12">';
		$output .= '<div class="meta-event-filter-container-inner row justify-content-md-center clearfix">';
			
			$output .= '<div class="meta-event-cat col-2" >';
				//$output .= '<div class="meta-event-cat-inner row clearfix">';
					$output .= '<a href="#meta-event-cat-list" class="meta-event-cat-inner" data-filter="*">';
						$output .=  esc_html__( 'TODOS','primestudio' );
					$output .= '</a>';
				//$output .= '</div><!--end .meta-event-cat-inner -->';
			$output .= '</div><!--end .meta-event-cat -->';

	foreach ( $categories as $cat )
	{
		$cat_background		= get_term_meta( $cat->term_id, 'background', true );
			$output .= '<div class="meta-event-cat col-2">';
				//$output .= '<div class="meta-event-cat-inner row clearfix">';
					$output .= '<a href="#meta-event-cat-list" class="meta-event-cat-inner" data-filter=".' . $cat->slug . '">';
						$output .= strtoupper( $cat->name );
					$output .= '</a>';
				//$output .= '</div><!--end .meta-event-cat-inner -->';
			$output .= '</div><!--end .meta-event-cat -->';
	}
		$output .= '</div><!--end .meta-event-filter-container-inner -->';
	$output .= '</div><!--end .meta-event-filter-container -->';
endif;

	$output .= '<div id="meta-events-container" class="meta-events-container col-12">';
		$output .= '<div class="clearfix meta-events-container-inner-row row">';

	if ( $event->have_posts() ) :

		while ( $event->have_posts() ) : $event->the_post();

			$terms = get_the_terms( $event->ID, 'meta_category' );
			$event_cat =  ( !$terms ) ?  [ 'name' => [], 'slug' => [] ]  : array_reduce( $terms , function( $c, $v )
				{
					$c['name'][] = $v->name;
					$c['slug'][] = $v->slug;
					return $c;
				});

			$output .= '<div class="meta-event col-3 col-md-'.( 12 / $columns ).' '. implode( ' ', $event_cat['slug'] ).'">';
				$output .= '<a href="' . get_the_permalink( $event->ID ) . '" class="meta-event-inner">';

				if( has_post_thumbnail() )
					$output .= '<div class="event-image-holder" style="background-image: url(\'' . get_the_post_thumbnail_url( null, 'medium' ) . '\'); "></div>';
				else
					$output .= '<div class="event-image-holder" style="background-color: #323E48"></div>';
					$output .= '<p class="view-more">' . esc_html__( 'VER MÁS','primestudio' ) . '</p>';
					$output .= '<p class="event-title">'.get_the_title().'<span>'. implode( ' ', $event_cat['name'] ).'</span></p>';

				$output .= '</a><!--/ .meta-event-inner -->';
			$output .= '</div><!--/ .meta-event -->';
		endwhile;
	endif;
	wp_reset_postdata();
		$output .= '</div><!-- end .meta-events-container-inner-row-->';
	$output .= '</div><!-- end #meta-events-container-->';

$output .= '</div><!-- end #widget-meta-events-->';

echo $output;
?>