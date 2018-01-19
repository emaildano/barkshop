<?php

/**
 * List function files by name to be included
 *
 * @var   array List of function file names
 * @since 1.0.0
 */
$function_includes = [
  'config-settings',          // Variables and Theme Support
  'config-conditionals',      // Config Conditionals
  'theme-assets',             // Scripts and stylesheets
  'theme-modules',            // Modular HTML Components
  'theme-utilities',         // Custom Functions for Practical Purposes

  /* Uncomment as needed */
  // 'misc/extend-post-types',      // Custom Post Types
  // 'misc/extend-taxonomy',        // Custom Taxonomies
  // 'misc/extend-admin',           // Customize WP Admin
  // 'misc/extend-queries',         // Alterations to queries via hooks
];


/**
 * Loop through files and require them
 *
 * @since  1.0.0
 */
foreach ( $function_includes as $filename ) {

  $filepath = 'lib/' . $filename . '.php';
  require_once locate_template($filepath);

}

unset($filename, $filepath);


if ( ! function_exists( 'storefront_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
		<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'storefront' ) ) ); ?></span></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location'	=> 'primary',
					'container_class'	=> 'primary-navigation',
					)
			);

			wp_nav_menu(
				array(
					'theme_location'	=> 'handheld',
					'container_class'	=> 'handheld-navigation',
					)
			);
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}
