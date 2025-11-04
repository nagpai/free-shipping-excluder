<?php
/**
 * Plugin Name: Free Shipping Excluder for WooCommerce
 * Plugin URI: https://github.com/nagpai/free-shipping-excluder
 * Description: Exclude specific products from free shipping.
 * Version: 1.1
 * Tested up to: 6.8.2
 * Author: Nagesh Pai
 * Author URI: https://nagpai.blog
 * Developer: Nagesh Pai
 * Developer URI: https://github.com/nagpai
 * Required Plugins: woocommerce
 * License: GPL-2.0+
 *
 * @package FreeShippingExcluder
 */

declare( strict_types=1 );

namespace FreeShippingExcluder;

defined( 'ABSPATH' ) || exit;

require_once plugin_dir_path( __FILE__ ) . 'includes/class-free-shipping-excluder.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/admin/class-product-shipping-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/admin/class-category-exclusion-settings.php';

new Free_Shipping_Excluder();
new Admin\Product_Shipping_Settings();
new Admin\Category_Exclusion_Settings();
