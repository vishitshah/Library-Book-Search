<?php
/**
 * The template for displaying all single posts
 *
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
    ?>	

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header alignwide">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>		
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
                $author_list = wp_get_post_terms( get_the_ID(), 'book_author', array( 'fields' => 'ids' ) );
                $publisher_list = wp_get_post_terms( get_the_ID(), 'book_publisher', array( 'fields' => 'ids' ) );
            ?>
            <?php 
                if( $author_list ) {
                    $author_term = get_term( $author_list[0] ); 
            ?>
                    <p>
                        <strong><?php echo __( 'Author:', 'book-search' ); ?></strong>
                        <a href="<?php echo get_term_link( $author_term->term_id, 'book_author' ); ?>"><?php echo esc_attr( $author_term->name ); ?></a>
                    </p>
            <?php
                } 
            ?>
            <?php 
                if( $publisher_list ) {
                    $publisher_term = get_term( $publisher_list[0] );                
            ?>
                    <p>
                        <strong><?php echo __( 'Publisher:', 'book-search' ); ?></strong>
                        <a href="<?php echo get_term_link( $publisher_term->term_id, 'book_publisher' ); ?>"><?php echo esc_attr( $publisher_term->name ); ?></a>
                    </p>
            <?php
                }
            ?>
            <?php
                the_excerpt();
            ?>
            <p><strong><?php echo __( 'Price:', 'book-search' ); ?></strong>
            <?php echo get_post_meta( get_the_ID(), '_book_price', true ); ?></p>
            <div class="single-rating"><strong><?php echo __( 'Rating:', 'book-search' ); ?></strong>
                <?php $rating = get_post_meta( get_the_ID(), '_book_rating', true ); 
                    switch ( $rating ) {
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
            </div>
        </div><!-- .entry-content -->
    </article><!-- #post-<?php the_ID(); ?> -->
<?php 
endwhile; // End of the loop.

get_footer();
