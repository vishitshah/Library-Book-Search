<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }
    
    /* Enqueue scripts and styles. */
    require_once( BOOK_SEARCH_ROOT . '/lib/book-search-enqueue-scripts-styles.php' );

    /* Custom Meta creation */
    require_once( BOOK_SEARCH_ROOT . '/lib/book-search-meta.php' );

    /* Create Shortcode */
    require_once( BOOK_SEARCH_ROOT . '/lib/book-search-shortcode.php' );

    /* General Functions */
    require_once( BOOK_SEARCH_ROOT . '/lib/book-search-general-function.php' );

    /* Ajax Function */
    require_once( BOOK_SEARCH_ROOT . '/lib/book-search-ajax-function.php' );    