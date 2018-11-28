<?php 
	
$output = '<div id="meta-events-container" class="meta-events-container col-12">';
	$output .= '<div class="clearfix meta-events-container-inner-row row">';

	if ( $event->have_posts() ) :

		while ( $event->have_posts() ) : $event->the_post();

			$terms = get_the_terms( $event->ID, 'meta_category' );
			$event_cat =  ( ! $terms ) ? [ 'name' => [] ] : array_reduce( $terms , function( $c, $v )
				{
					$c['name'][] = $v->name;
					return $c;
				});

			$output .= '<div class="meta-event col-3 col-md-'.( 12 / $columns ).'">';
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
echo $output .= '</div><!-- end #meta-events-container-->';
?>