<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);

// removes "related products" from product single
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// hide media features category from blog index
function exclude_category_home( $query ) {
  if ( $query->is_home ) {
    $query->set( 'cat', '-268' );
  }
  return $query;
}

add_filter( 'pre_get_posts', 'exclude_category_home' );

/* add_filter("wpseo_breadcrumb_links", "ihmm_breadcrumb_tweak");

function ihmm_breadcrumb_tweak($links) {
  foreach($links as $key => $value) {
    if($value['text'] == 'Bark Wall Coverings and Wood Products') {
      $links[$key]['text'] = 'Products';
    }
  }
  return $links;
} */

/* add_filter( 'loop_shop_per_page', 'ihmm_products_per_page', 20 );

function ihmm_products_per_page( $cols ) {
  $cols = 15;
  return $cols;
} */

/* add_filter( 'gform_other_choice_value', 'set_placeholder', 10, 2 );
function set_placeholder( $placeholder, $field ) {
  if($field->inputName == 'substrate') {
    return 'other';
  }
  if($field->inputName == 'panel_size') {
    return 'custom';
  }
  return;
} */

add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

function iconic_cart_count_fragments( $fragments ) {
    
    $fragments['li.cart.header-cart-count'] = '<li class="cart header-cart-count">' . WC()->cart->get_cart_contents_count() . '</li>';
    
    return $fragments;
    
}

function ihmm_test($cart_item_data, $cart_id) {
  
  $addons = !empty($cart_item_data['addons']) ? $cart_item_data['addons'] : false;
  if($addons) {
    $price =  $cart_item_data['data']->get_price();
    $regular_price = $cart_item_data['data']->get_regular_price();
    //$sale_price = $cart_item_data['data']->get_sale_price();
    foreach($addons as $key => $addon) {
      if ($addon['name'] == 'Substrate' || $addon['name'] == 'Finish' || $addon['name'] == 'Sanding') {
        $addon_price = $addon['price'];
        $product_id    = $cart_item_data['product_id'];
        $height = get_post_meta($product_id, '_height')[0];
        $width = get_post_meta($product_id, '_width')[0];
        $sqft = round(((($width*$height)/12)/12), 2, PHP_ROUND_HALF_UP);
        $addon_price = $addon_price * $sqft;
        $cart_item_data['addons'][$key]['price'] = $addon_price;

        $price         += (float) $addon_price;
        $regular_price += (float) $addon_price;
        // $sale_price    += (float) $addon_price;
      }
    }
/* 
    $cart_item_data['data']->set_price( $price );

    // Only update regular price if it was defined.
    $has_regular_price = is_numeric( $cart_item_data['data']->get_regular_price( 'edit' ) );
    if ( $has_regular_price ) {
      $cart_item_data['data']->set_regular_price( $regular_price );
    } */

    // Only update sale price if it was defined.
    //$has_sale_price = is_numeric( $cart_item_data['data']->get_sale_price( 'edit' ) );
    //if ( $has_sale_price ) {
    //  $cart_item_data['data']->set_sale_price( $sale_price );
    //}
  }
  return $cart_item_data;
}

add_filter( 'woocommerce_add_cart_item', 'ihmm_test', 2, 100 );

function _get_string_between($string, $start, $end){
  $string = ' ' . $string;
  $ini = strpos($string, $start);
  if ($ini == 0) return '';
  $ini += strlen($start);
  $len = strpos($string, $end, $ini) - $ini;
  return substr($string, $ini, $len);
}

function ihmm_adddon_price_per_sqft_display($markup, $input) {
  if(!empty($input['price_type'] && $input['price_type'] == 'flat_fee')) {
    $markup = str_replace('</span>)', '</span> per sqft)', $markup);
  }
  return $markup;
}

add_filter('woocommerce_product_addons_option_price', 'ihmm_adddon_price_per_sqft_display', 2, 3);

function ihmm_wc_empty_cart_redirect_url() {
	return '/natural-bark-wood-products/';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'ihmm_wc_empty_cart_redirect_url' );