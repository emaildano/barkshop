<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

add_action( 'get_header', 'remove_storefront_sidebar' );
function remove_storefront_sidebar() {
  if ( is_woocommerce() ) {
 		remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
 	}
}


 function storefront_product_categories( $args ) {

   if ( storefront_is_woocommerce_activated() ) {

     $args = apply_filters( 'storefront_product_categories_args', array(
       'limit' 			      => 50,
       'columns' 			    => 4,
       'child_categories' => 0,
       'orderby' 			    => 'name',
       'title'				    => __( 'Shop by Category', 'storefront' ),
     ) );

     $shortcode_content = storefront_do_shortcode( 'product_categories', apply_filters( 'storefront_product_categories_shortcode_args', array(
       'number'  => intval( $args['limit'] ),
       'columns' => intval( $args['columns'] ),
       'orderby' => esc_attr( $args['orderby'] ),
       'parent'  => esc_attr( $args['child_categories'] ),
     ) ) );

     /**
      * Only display the section if the shortcode returns product categories
      */
     if ( false !== strpos( $shortcode_content, 'product-category' ) ) {

       echo '<section class="storefront-product-section storefront-product-categories" aria-label="' . esc_attr__( 'Product Categories', 'storefront' ) . '">';

       do_action( 'storefront_homepage_before_product_categories' );

       echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

       do_action( 'storefront_homepage_after_product_categories_title' );

       echo $shortcode_content;

       do_action( 'storefront_homepage_after_product_categories' );

       echo '</section>';

     }
   }
 }
