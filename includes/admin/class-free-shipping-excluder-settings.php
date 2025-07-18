<?php
/**
 * Admin settings for Free Shipping Excluder plugin.
 *
 * @package FreeShippingExcluder
 */

declare( strict_types = 1 );

namespace FreeShippingExcluder\Admin;

use FreeShippingExcluder\Free_Shipping_Excluder;
use WooCommerce\Classes\Shipping\WC_Shipping_Free_Shipping;
defined( 'ABSPATH' ) || exit;

/**
 * Class Free_Shipping_Excluder_Settings
 */
class Free_Shipping_Excluder_Settings {
	/**
	 * Constructor to initialize the settings.
	 */
	public function __construct() {
		add_filter( 'woocommerce_shipping_instance_form_fields_free_shipping', array( $this, 'add_exclude_products_setting' ), 10, 3 );
	}
	/**
	 * Add a setting to exclude specific products from free shipping.
	 *
	 * @param array $settings Existing settings.
	 * @return array Modified settings.
	 */
	public function add_exclude_products_setting( array $settings ): array {
		$settings['excluded_products'] = array(
			'title'       => __( 'Exclude Products from Free Shipping', 'free-shipping-excluder' ),
			'type'        => 'text',
			'description' => __( 'Add product IDs to exclude their cost from the free shipping minimum threshold. Separate multiple product IDs by commas.', 'free-shipping-excluder' ),
			'class'       => 'wc-free-shipping-excluder-select',
			'default'     => '',
		);

		return $settings;
	}
}
