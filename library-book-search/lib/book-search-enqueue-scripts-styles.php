<?php
/**
 * Book Search Register Style Js.
 * 
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }  
	
	/*
	 * Enqueue scripts and styles.
	 */
	if( ! function_exists( 'book_search_register_style_js' ) ) {
		function book_search_register_style_js() {

			/* To remove other plugin Font Awesome icon */

			/* Bootstarp css Enqueue */
			wp_register_style( 'bootstrap', BOOK_SEARCH_ROOT_DIR . '/assets/css/bootstrap.min.css', null, '3.3.6' );
			wp_enqueue_style( 'bootstrap' );

			wp_enqueue_style( 'jquery-ui-css', BOOK_SEARCH_ROOT_DIR .'/assets/css/jquery-ui.css', array(), '', 'all' );

			wp_register_style( 'custom-book-search', BOOK_SEARCH_ROOT_DIR . '/assets/css/custom.css', null, '3.3.6' );
			wp_enqueue_style( 'custom-book-search' );
			

			/* Bootstarp Js Enqueue */
			wp_register_script( 'bootstrap', BOOK_SEARCH_ROOT_DIR.'/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true);
			wp_enqueue_script( 'bootstrap' );

			/* Custom Js Enqueue */
			wp_register_script( 'search-library-main', BOOK_SEARCH_ROOT_DIR.'/assets/js/main.js', array( 'jquery', 'jquery-ui-slider' ), BOOK_SEARCH_PLUGIN_VERSION, true );
			wp_enqueue_script( 'search-library-main' );
			wp_localize_script( 'search-library-main', 'bookMain', array( 
				'ajaxurl'	=> admin_url( 'admin-ajax.php' ),
			) );
			
		}
	}
	add_action( 'wp_enqueue_scripts', 'book_search_register_style_js' );