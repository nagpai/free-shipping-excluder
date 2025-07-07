<?php
/**
 * Plugin Name: Free Shipping Excluder for WooCommerce
 * Description: Exclude specific products from free shipping.
 * Version: 1.0
 * Author: Nagesh Pai
 * Developer: Nagesh Pai
 * Required Plugins: 'woocommerce
 * License: GPL-2.0+
 *
 * @package FreeShippingExcluder
 */

declare( strict_types=1 );

namespace FreeShippingExcluder;

defined( 'ABSPATH' ) || exit;

require_once plugin_dir_path( __FILE__ ) . 'includes/class-free-shipping-excluder.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/admin/class-free-shipping-excluder-settings.php';

new Free_Shipping_Excluder();
new Admin\Free_Shipping_Excluder_Settings();
