<?php
/**
 * Book Search Register Style Js.
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }  
	
	/*
	 * Pagination Function
	 */   
    if ( !function_exists( 'search_library_pagination' ) ) {
        function search_library_pagination( $the_query=NULL, $paged=1 ) {
    
            global $wp_query;
            $the_query = !empty($the_query) ? $the_query : $wp_query;
    
            if ( $the_query->max_num_pages > 1 ) {
                $big = 999999999; // need an unlikely integer
                $items = paginate_links(apply_filters('search_library_pagination_links', array(
                    'base'      => str_replace( $big, '%#%', esc_url(get_pagenum_link( $big ) ) ),
                    'format'    => '?paged=%#%',
                    'prev_next' => TRUE,
                    'current'   => max(1, $paged),
                    'total'     => $the_query->max_num_pages,
                    'type'      => 'array',
                    'prev_text' => __( 'Previous', 'book-search' ),
                    'next_text' => __( 'Next', 'book-search' ),
                    'end_size'  => 1,
                    'mid_size'  => 1
                )));                
    
                $pagination = "<div class=\"col-sm-12 text-center\"><div class=\"ic-pagination\"><ul><li>";
                $pagination .= join("</li><li>", (array)$items);
                $pagination .= "</li></ul></div></div>";
    
                echo apply_filters( 'seach_library_custom_pagination', $pagination, $items, $the_query );
            }
        }
    }


    /*
	 * Filter the single_template with our book search function
	 */     
    add_filter('single_template', 'book_search_single_template', 99);
    if( ! function_exists( 'book_search_single_template' ) ) {
        function book_search_single_template($single) {

            global $post;

            /* Checks for single template by post type */
            if ( $post->post_type == 'book' ) {        
                if ( file_exists( BOOK_SEARCH_ROOT . '/single-book.php' ) ) {
                    return BOOK_SEARCH_ROOT . '/single-book.php';
                }
            }
            return $single;
        }
    }