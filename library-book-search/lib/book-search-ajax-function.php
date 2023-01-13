<?php
/**
 * Book Search Register Style Js.
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }  
	
	/*
	 * Search form Ajax
	 */    
    add_action( 'wp_ajax_search_library','search_library_book_data' );
    add_action( 'wp_ajax_nopriv_search_library','search_library_book_data' );

    if( ! function_exists( 'search_library_book_data' ) ) {
        function search_library_book_data(){                
                        
            $meta_query = $taxquery = $author_tax_args = $publisher_tax_args = $search_data = [];
            wp_parse_str( $_POST['book_search'], $search_data );

            $title      = $search_data['book_name'];
            $author     = $search_data['author'];
            $publisher  = $search_data['publisher'];
            $rating     = $search_data['bookrating'];
            $minprice   = $search_data['minprice'];
            $maxprice   = $search_data['maxprice'];

            if ( $title || $author || $publisher || $rating || $minprice || $maxprice ) {

                $paged = ( isset( $search_data['paged'] ) ) ? $search_data['paged'] : 1;
                $args = array(
                    'post_type' => 'book',
                    'posts_per_page' => 5,
                    'paged' => $paged
                );

                /* if Title is added */
                if( !empty( $title ) ) {
                    $args['s'] = $title;
                }
                
                /* if $author variable is selected.*/
                if(!empty( $author ) ) {
                    array_push( $taxquery,array(
                        'taxonomy' => 'book_author',
                        'field' => 'slug',
                        'terms' => $author,
                    ));
                }

                /* if $publisher variable is selected. */
                if( !empty( $publisher ) ) {
                    array_push( $taxquery,array(
                        'taxonomy' => 'book_publisher',
                        'field' => 'slug',
                        'terms' => $publisher,
                    ));
                }

                /* if $taxquery has array; */
                if( $author || $publisher ){
                    $args['tax_query'] = $taxquery;
                }
                
                /* Rating Meta data */
                if( ! empty( $rating ) ) {

                    array_push( $meta_query,array(
                        'key'       => '_book_rating',
                        'value'     => $rating,
                        'compare'   => '=',
                    ));
                }

                /* Price slider Meta data */
                if( $minprice || $maxprice ) {

                    array_push( $meta_query,array(
                        'key'       => '_book_price',
                        'value'     => array( $minprice, $maxprice ),
                        'compare'   => 'BETWEEN',
                        'type' => 'NUMERIC'
                    ));                    
                }

                /* if $meta_query has array; */
                if( !empty( $meta_query ) ){
                    $args['meta_query'] = $meta_query;
                }

                $search_result = new WP_Query( $args );

                ?>
                <div class="container result-wrapper">
                    <?php if( $search_result->have_posts() ) { ?>
                        <table>
                            <tr>
                                <th><?php echo __( 'Book Name', 'book-search' ); ?></th>
                                <th><?php echo __( 'Price', 'book-search' ); ?></th>
                                <th><?php echo __( 'Author', 'book-search' ); ?></th>
                                <th><?php echo __( 'Publisher', 'book-search' ); ?></th>
                                <th><?php echo __( 'Rating', 'book-search' ); ?></th>
                            </tr>
                            <?php
                                while($search_result->have_posts()) {
                                    $search_result->the_post();
                                        $id = get_the_ID();
                                        $author_list = wp_get_post_terms( $id, 'book_author', array( 'fields' => 'names' ) );
                                        $publisher_list = wp_get_post_terms( $id, 'book_publisher', array( 'fields' => 'names' ) );
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo get_permalink( $id ); ?>"><?php echo get_the_title( $id ); ?></a></td>
                                            <td><?php echo get_post_meta( $id, '_book_price', true ); ?></td>
                                            <td><?php echo $author_list[0]; ?></td>
                                            <td><?php echo $publisher_list[0]; ?></td>
                                            <td><?php $rating = get_post_meta( $id, '_book_rating', true ); ?>
                                                <?php switch ( $rating ) {
                                                    case 1:
                                                        $class = ' one';
                                                        break;
                                                    case 2:
                                                        $class = ' two';
                                                        break;
                                                    case 3:
                                                        $class = ' three';
                                                        break;
                                                    case 4:
                                                        $class =  ' four';
                                                        break;
                                                    case 5:
                                                        $class = ' five';
                                                        break;
                                                } ?>
                                                <div class="rating-wrap">
                                                    <div class="star-wrap<?php echo $class; ?>">
                                                        <img src="<?php echo BOOK_SEARCH_ROOT_DIR; ?>/assets/images/1star.png" class="star1">
                                                        <img src="<?php echo BOOK_SEARCH_ROOT_DIR; ?>/assets/images/2star.png" class="star2">
                                                        <img src="<?php echo BOOK_SEARCH_ROOT_DIR; ?>/assets/images/3star.png" class="star3">
                                                        <img src="<?php echo BOOK_SEARCH_ROOT_DIR; ?>/assets/images/4star.png" class="star4">
                                                        <img src="<?php echo BOOK_SEARCH_ROOT_DIR; ?>/assets/images/5star.png" class="star5">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                }
                                wp_reset_postdata(); 
                                ?>
                        </table>
                        <div class="pagination">
                            <?php echo search_library_pagination($search_result, $paged); ?>
                        </div>
                    <?php
                        } else {
                            echo '<div class="container no-data-wrapper">';
                                echo '<h2>'.__( 'No Data found', 'book-search' ). '</h2>';
                            echo '</div>';
                        }
                    ?>
                </div>
                <?php
                    
            } else {
                echo '<div class="container no-data-wrapper">';
                    echo '<h2>'.__( 'No Data found', 'book-search' ). '</h2>';
                echo '</div>';
            }
            die();
        }
    }