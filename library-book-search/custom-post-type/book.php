<?php
/**
 * Register Custom Post Type Book.
 *
 */

$labels = array(
	'name'               => __( 'Book', 'book-search' ),
	'singular_name'      => __( 'Book', 'book-search' ),
	'add_new'            => __( 'Add new book', 'book-search' ),
	'add_new_item'       => __( 'Add new book', 'book-search' ),
	'edit_item'          => __( 'Edit book', 'book-search' ),
	'new_item'           => __( 'New book', 'book-search' ),
	'all_items'          => __( 'All books', 'book-search' ),
	'view_item'          => __( 'View book', 'book-search' ),
	'search_items'       => __( 'Search Books', 'book-search' ),
	'not_found'          => __( 'No Books found', 'book-search' ),
	'not_found_in_trash' => __( 'No Books found in the Trash', 'book-search' ),
	'menu_name'          => __( 'Book', 'book-search' )
);

$args = array(
    'labels'            => $labels,
	'hierarchical' 		=> true,	
	'supports' 			=> array( 'title', 'excerpt' ),
	'public' 			=> true,
	'show_ui' 			=> true,
	'show_in_menu' 		=> true,
	'show_in_nav_menus' => true,
	'publicly_queryable'=> true,
	'exclude_from_search'=> false,
	'has_archive' 		=> true,
	'query_var' 		=> true,
	'can_export' 		=> true,
	'rewrite' 			=> true,
	'capability_type' 	=> 'post',
	'taxonomies'		=> ['book_author', 'book_publisher'],
);

register_post_type( 'book', $args );

/**
 * Register Custom Post type Author
 */
$author_lables = array(
	'singular_name' 	=> __('Author', 'book-search'),
	'all_items' 		=> __('All Authors', 'book-search'),
	'edit_item'			=> __('Edit Author', 'book-search'),
	'view_item' 		=> __('View Author', 'book-search'),
	'update_item' 		=> __('Update Author', 'book-search'),
	'add_new_item' 		=> __('Add New Author', 'book-search'),
	'new_item_name' 	=> __('New Author Name', 'book-search'),
	'search_items' 		=> __('Search Authors', 'book-search'),
	'not_found' 		=> __('No Authors found', 'book-search'),
	'parent_item_colon' => __( 'Parent Publisher', 'book-search' ), 
);

register_taxonomy('book_author', ['book'], [
	'label'				=> __('Authors', 'book-search'),
	'hierarchical' 		=> true,
	'rewrite' 			=> ['slug' => 'book-author'],
	'show_admin_column' => true,
	'show_in_rest' 		=> true,
	'labels' 			=> $author_lables
]);
register_taxonomy_for_object_type('book_author', 'book');

/**
 * Register Custom Post type Publisher
 */
$author_lables = array(
	'singular_name' 	=> __('Publisher', 'book-search'),
	'all_items' 		=> __('All Publishers', 'book-search'),
	'edit_item' 		=> __('Edit Publisher', 'book-search'),
	'view_item' 		=> __('View Publisher', 'book-search'),
	'update_item' 		=> __('Update Publisher', 'book-search'),
	'add_new_item' 		=> __('Add New Publisher', 'book-search'),
	'new_item_name' 	=> __('New Publisher Name', 'book-search'),
	'search_items' 		=> __('Search Publishers', 'book-search'),
	'not_found' 		=> __('No Publishers found', 'book-search'),
	'parent_item_colon' => __( 'Parent Publisher', 'book-search' ), 
);

register_taxonomy('book_publisher', ['book'], [
	'label'				=> __('Publishers', 'book-search'),
	'hierarchical' 		=> true,
	'rewrite' 			=> ['slug' => 'book-publisher'],
	'show_admin_column' => true,
	'show_in_rest' 		=> true,
	'labels' 			=> $author_lables
]);
register_taxonomy_for_object_type('book_publisher', 'book');