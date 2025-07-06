<?php
/**
 * Free Shipping Excluder Main class
 *
 * @package FreeShippingExcluder
 */

declare( strict_types=1 );

namespace FreeShippingExcluder;

use WooCommerce\Classes\Shipping\WC_Shipping_Free_Shipping;

defined( 'ABSPATH' ) || exit;

/**
 * Class Free_Shipping_Excluder
 */
class Free_Shipping_Excluder {
	/**
	 * The minimum amount for free shipping.
	 *
	 * @var string
	 */
	public $free_shipping_threshold;

	/**
	 * Constructor to initialize the plugin.
	 */
	public function __construct() {
		add_filter( 'woocommerce_shipping_free_shipping_is_available', array( $this, 'exclude_products_from_free_shipping' ), 10, 3 );
	}

	/**
	 * Exclude specific products from free shipping.
	 *
	 * @return bool
	 */
	public function exclude_products_from_free_shipping(): bool {
		$excluded_product_ids = array( 16, 17 ); // Replace with actual product IDs to exclude.

		$total_free_shipping_eligible_cost = 0;

		foreach ( WC()->cart->get_cart() as $cart_item ) {
			if ( ! in_array( $cart_item['product_id'], $excluded_product_ids, true ) ) {
				$total_free_shipping_eligible_cost += $cart_item['line_total'];
			}
		}

		return $total_free_shipping_eligible_cost >= $this->free_shipping_threshold;
	}
}
