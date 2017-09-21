/**
 * Infinite load succes hook for Lazyload XT to process new elements.
 *
 * @version 1.1
 *
 * ToDo: concatenate and minify for production -> https://jscompress.com/
 */
;(function( $ ) {
    "use strict";

    $( document ).ready(function() {

        if ( typeof filter !== 'undefined' ) {
            filter.add('infiniteload-load-success', function(){
                // Infinite load succes hook for Lazyload XT to process new elements.
                $(window).lazyLoadXT();
                $('#marker').lazyLoadXT({visibleOnly: true, checkDuplicates: false});
            });
        }

    });

}(jQuery));
