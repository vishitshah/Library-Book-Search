<?php
/*
Plugin Name: Library Book Search
Plugin URI: https://www.example.com
Description: This plugin for test purpose
Version: 1.0
Author: Vishit Shah
Author URI: https://www.vishitshah.com
Text Domain: book-search
*/

/**
 * Defind Class 
 */
defined( 'BOOK_SEARCH_PLUGIN_VERSION' ) or define( 'BOOK_SEARCH_PLUGIN_VERSION', '1.0' );
defined( 'BOOK_SEARCH_ROOT' ) or define( 'BOOK_SEARCH_ROOT', dirname(__FILE__) );
defined( 'BOOK_SEARCH_ROOT_DIR' ) or define( 'BOOK_SEARCH_ROOT_DIR', plugins_url() . '/library-book-search' );
defined( 'BOOK_SEARCH_PLUGIN_PATH' ) or define( 'BOOK_SEARCH_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

if( ! function_exists( 'book_search_load_textdomain' ) ) {

    function book_search_load_textdomain() {

        load_plugin_textdomain( 'book-search', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
    }
}
add_action( 'init', 'book_search_load_textdomain' );

if( ! class_exists('Book_Search') ) {

    class Book_Search {

        // Construct
        public function __construct() {

            require_once( BOOK_SEARCH_ROOT . '/book-search-require-files.php' );

            /* For Book Custom Post Type */
            add_action( 'init', array( $this, 'book_search_register_custom_post_type' ), 1 );
        }

        public function book_search_register_custom_post_type() {

            require_once( BOOK_SEARCH_ROOT .'/custom-post-type/book.php'); 
        }        

    } // end of class
  
    if( ! function_exists( 'book_search_plugins_loaded' ) ) {

        function book_search_plugins_loaded() {

            $Book_Search = new Book_Search();
        }
    }
    add_action( 'plugins_loaded', 'book_search_plugins_loaded' );

} // end of class_exists
