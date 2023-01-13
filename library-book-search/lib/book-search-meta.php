<?php
/**
 * Book Search Register Style Js.
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }  
	
	/*
	 * Create Custom Meta
	 */	
    function book_search_meta() {
        add_meta_box("book-meta-box", "Book Details", "book_search_markup", "book", "normal", "high", null);
    }
    add_action("add_meta_boxes", "book_search_meta");

	/*
	 * Create Custom meta boxes
	 */    
    if( !function_exists( 'book_search_markup' ) ) {
        function book_search_markup( $object ) {
            wp_nonce_field(basename(__FILE__), "meta-box-nonce");
            ?>
            <div class="wrapper">
                <label for="price"><?php echo __( 'Price', 'book-search' ); ?></label>
                <input name="_book_price" type="text" value="<?php echo get_post_meta( $object->ID, "_book_price", true ); ?>"><br /><br />
                <label for="rating"><?php echo __( 'Book Rating', 'book-search' ); ?></label>
                <select name="_book_rating">
                    <?php 
                        $option_values = array( 1, 2, 3, 4, 5 );
                        foreach( $option_values as $key => $value ) {
                            if( $value == get_post_meta( $object->ID, "_book_rating", true ) ) {
                                ?>
                                    <option selected><?php echo $value; ?></option>
                                <?php
                            }
                            else {
                                ?>
                                    <option><?php echo $value; ?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
            </div>
        <?php  }
    }

	/*
	 * Save Custom boxes
	 */    
    if( !function_exists( 'book_serach_save_meta_box' ) ) {     
        function book_serach_save_meta_box( $post_id, $post, $update ) {
            if ( !isset( $_POST["meta-box-nonce"] ) || !wp_verify_nonce( $_POST["meta-box-nonce"], basename(__FILE__) ) )
                return $post_id;

            if( !current_user_can("edit_post", $post_id ) )
                return $post_id;

            if( defined("DOING_AUTOSAVE") && DOING_AUTOSAVE )
                return $post_id;

            $slug = "book";
            if( $slug != $post->post_type ) {
                return $post_id;
            }

            $price = $rating = "";

            if( isset( $_POST["_book_price"] ) ) {
                $price = $_POST["_book_price"];
            }   
            update_post_meta( $post_id, "_book_price", $price );

            if( isset( $_POST["_book_rating"] ) ) {
                $rating = $_POST["_book_rating"];
            }   
            update_post_meta( $post_id, "_book_rating", $rating );
        }
    }
    add_action( "save_post_book", "book_serach_save_meta_box", 10, 3 );