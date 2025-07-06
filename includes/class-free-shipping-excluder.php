<?php
/**
 * Free Shipping Excluder Main class
 *
 * @package FreeShippingExcluder
 */

declare( strict_types=1 );

namespace FreeShippingExcluder;

defined( 'ABSPATH' ) || exit;

/**
 * Class Free_Shipping_Excluder
 */
class Free_Shipping_Excluder {
	/**
	 * Constructor to initialize the plugin.
	 */
	public function __construct() {
		add_filter( 'woocommerce_shipping_free_shipping_is_available', array( $this, 'exclude_products_from_free_shipping' ), 10, 3 );
	}

	/**
	 * Exclude specific products from free shipping.
	 *
	 * @param bool                      $is_available    Whether free shipping is available.
	 * @param array                     $package         Package information.
	 * @param WC_Shipping_Free_Shipping $free_shipping_method The shipping method instance.
	 * @return bool
	 */
	public function exclude_products_from_free_shipping( $is_available, $package, $free_shipping_method ): bool {
		$excluded_product_ids = array( 16, 17 ); // Replace with actual product IDs to exclude.

		$total_free_shipping_eligible_cost = 0;

		foreach ( WC()->cart->get_cart() as $cart_item ) {
			if ( ! in_array( $cart_item['product_id'], $excluded_product_ids, true ) ) {
				$total_free_shipping_eligible_cost += $cart_item['line_total'];
			}
		}

		$free_shipping_threshold = (float) $free_shipping_method->get_option( 'min_amount', 0 );

		return $total_free_shipping_eligible_cost >= $free_shipping_threshold;
	}
}
