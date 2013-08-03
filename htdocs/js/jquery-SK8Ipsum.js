(function( $ ){

  $.fn.SK8Ipsum = function( options ) {  

    var tricks = $.extend( {
      'startWith' : 1,
      'paragraphs' : 3
    }, options);

    return this.each(function() {        

      var $this = $(this);
	
		$.ajax({
		type: 'GET',
		url: 'http://sk8ipsum.com/get/'+tricks.paragraphs+'/'+tricks.startWith+'/text/',
		dataType: "html",
		success: function(html){
		 		 $($this).html(html);			
			}
		});

    });

  };
})( jQuery );



