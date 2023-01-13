( function( $ ) {

    "use strict";
    
    $( document ).ready(function() {

        // Search Book Ajax
        $( '#library-search-form' ).on('submit', function(e){
            e.preventDefault();
            var _this = $( this );
            var form = jQuery('#library-search-form').serialize() + '&paged=' + '1';        
            var formValue = new FormData;        
            formValue.append( 'action', 'search_library' );        
            formValue.append( 'book_search', form );            
            $.ajax({
                type : 'POST',
                url  : bookMain.ajaxurl,
                data : formValue,
                processData: false, 
                contentType: false,
                success: function (result) {
                    $( '.search-result-data' ).html( result );               
                }
            });
        });

        // AJAX PAGINATION
        $('.search-result-data').on('click', 'a.page-numbers', function(e) {    
            e.preventDefault();
            var link = jQuery(this).attr('href');
            var paged = link.split("=");        
            var form = jQuery('#library-search-form').serialize() + '&paged=' + paged[1];        
            var formValue = new FormData;
            formValue.append( 'action', 'search_library' );        
            formValue.append( 'book_search', form );        
            $.ajax({
                type : 'POST',
                url  : bookMain.ajaxurl,
                data : formValue,
                processData: false, 
                contentType: false,
                success: function (result) {        
                    $( '.search-result-data' ).html( result );               
                }
            });
        });

        $("#price-range").slider({
            step: 50,
            range: true, 
            min: 0, 
            max: 3000, 
            values: [0, 3000], 
            slide: function(event, ui) {                
                $("#value1").val(ui.values[0]);
                $("#value2").val(ui.values[1]);
            }
        });
        $("#value1").val($("#value1").slider("values", 0) );
        $("#value2").val($("#value2").slider("values", 1) );         
    });
})( jQuery );