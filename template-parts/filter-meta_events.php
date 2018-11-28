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
				$output .= '<a href="' . $event->get_permalink() . '" class="meta-event-inner">';

				if( has_post_thumbnail() )
					$output .= '<div class="event-image-holder" style="background-image: url(\'' . get_the_post_thumbnail_url( null, 'medium' ) . '\'); "></div>';
				else
					$output .= '<div class="event-image-holder" style="background-color: #323E48"></div>';
					$output .= '<p class="view-more">' . esc_html__( 'VER MÁS','primestudio' ) . '</p>';
					$output .= '<p class="event-title">'.get_the_title().'<span>'. implode( ' ', $event_cat['name'] ).'</span></p>';

				/*

			$output .= '<div class="event-image-holder" style="background-image: url(\'' . wp_get_attachment_url( $cat_thumbnail_id, 'full' ) . '\'); ">';
				$output .= '</div><!--end .event-image-holder -->';
				$output .= '<p class="event-title text-center truncate">'.$event->post_title.'</p>'; 

			$output .= '<div class="product-outer">';
				$output .= '<div class="product-image-holder">';
				$output .= '<a rel="nofollow" href="' . $event->get_permalink() . '">';
				$output .= sprintf( '%s',$product->get_image( array( '368', '368' ) ) );
				$output .= '</a><!--/ .meta-event -->';
				$output .= '</div>';
				if($ze_product_show_title){
					$output .= '<div class="product-title">';
					$output .= '<a href="'.$product->get_permalink().'">'.get_the_title().'</a>';
					$output .= '</div>';
				}
				if($ze_product_show_price){
					$output .= '<div class="price">';
					$output .= sprintf( '%s',$product->get_price_html() );
					$output .= '</div>';
				}
				$output .= '</div>';*/

				$output .= '</a><!--/ .meta-event-inner -->';
			$output .= '</div><!--/ .meta-event -->';
		endwhile;
	endif;
	wp_reset_postdata();
	$output .= '</div><!-- end .meta-events-container-inner-row-->';
echo $output .= '</div><!-- end #meta-events-container-->';
?>