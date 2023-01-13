<?php
/**
 * Book Search Register Style Js.
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }  
	
	/*
	 * Shortcode for Book Search form
	 */    
    if( ! function_exists( 'display_search_form' ) ) {
        function display_search_form() {
            ?>
                <form method="post" id="library-search-form">
                    <div class="container">
                        <h2><?php echo __( 'Book Search', 'book-search' ); ?></h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name"><?php echo __( 'Book Title:', 'book-search' ); ?></label>
                                <input name="book_name" type="text">
                            </div>
                            <div class="col-sm-6">
                                <label for="author"><?php echo __( 'Author:', 'book-search' ); ?></label>
                                <input name="author" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="publisher"><?php echo __( 'Publisher:', 'book-search' ); ?></label>
                                <?php                                 
                                    $terms = get_terms( 'book_publisher', array( 'hide_empty' => false, ) );
                                ?>
                                <select name="publisher" id="publisher">
                                    <option value=""></option>
                                    <?php
                                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                            foreach( $terms as $term ) {
                                                ?>
                                                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="rating"><?php echo __( 'Rating:', 'book-search' ); ?></label>
                                <select name="bookrating" id="bookrating">
                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option> 
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="slider-box">
                                    <label for="priceRange"><?php echo __( 'Price:', 'book-search' ); ?></label>
                                    <div id="price-range" class="slider"></div>
                                    <div class="row">
                                        <div class="col-sm-6"> 
                                            <input name="minprice" type="text" value="0" id="value1" readonly>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <input name="maxprice" type="text" value="3000" id="value2" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="search"><?php echo __( 'Search', 'book-search' ); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="search-result-data"></div>
            <?php
        }
    }
    add_shortcode( 'display_search_form', 'display_search_form' );