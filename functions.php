<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


function custom_menu_item($items, $args) {
    if (is_user_logged_in()) {
        // Récupère les items de menu sous forme de tableau
        $items_array = explode('</li>', $items);

        // Calcul la position où insérer l'élément "Admin"
        $middle_index = floor(count($items_array) / 2);

        // Insère l'élément "Admin" à la position calculée
        array_splice($items_array, $middle_index, 0, '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="'.admin_url().'">Admin</a></li>');

        // Convertit le tableau en chaîne de caractères HTML
        $items = implode('</li>', $items_array) . '</li>';
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'custom_menu_item', 10, 2);