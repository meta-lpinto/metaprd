(function($){

		 if( $('.event-item').length )
		 {
           var $grid = $('#event-container').isotope({
                 itemSelector : '.event-item',
                 layoutMode: 'vertical'
          		}),
           		$container = $('#event-container');

           $('.event-cat a').on( 'click',  function(e) {
           	e.preventDefault();
           	var filterValue = $(this).data('filter'), 
           		event_count = $(this).data('count');

           	$grid.isotope({ filter: filterValue });
           	$('.event_count').html( event_count );
           	$('.event-cat a').parent().removeClass("selected");
           	$(this).parent().addClass("selected");

           });

          $('.event-cat a').eq(0).trigger('click');
          $container.imagesLoaded().progress( function() {
          	$grid.isotope('layout');
          }); 
		}

})( jQuery );
