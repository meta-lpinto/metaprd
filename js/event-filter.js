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

    if( $('.meta-event-cat').length )
   {
         var $grid = $('#meta-events-container').isotope({
               itemSelector : '.meta-event',
               layoutMode: 'fitRows',
               percentPosition: true,
               fitRows: { gutter: 0 }
            }),
            $container = $('#meta-events-container');

         $('.meta-event-cat a').on( 'click',  function(e) {
          e.preventDefault();
          var filterValue = $(this).data('filter');
          console.log(filterValue);

          $grid.isotope({ filter: filterValue });
          $('.meta-event-cat a').parent().removeClass("selected");
          $(this).parent().addClass("selected");

         });

        $('.meta-event-cat a').eq(0).trigger('click');
        $container.imagesLoaded().progress( function() {
          $grid.isotope('layout');
        }); 
  }

})( jQuery );
