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
		add_filter( 'woocommerce_cart_item_name', array( $this, 'show_free_shipping_disabled_notice' ), 10, 3 );
	}

	/**
	 * Show a notice below the product in the cart/checkout if it disables free shipping.
	 *
	 * @param string $product_name Product name.
	 * @param array  $cart_item    Cart item data.
	 * @param string $cart_item_key Cart item key.
	 * @return string Modified product name.
	 */
	public function show_free_shipping_disabled_notice( string $product_name, array $cart_item, string $cart_item_key ): string {
		if ( isset( $cart_item['product_id'] ) ) {
			$product_disables_free_shipping = get_post_meta( $cart_item['product_id'], '_disable_free_shipping', true );

			if ( 'yes' === $product_disables_free_shipping ) {
				// Append the notice to the product name.
				$notice = sprintf(
					'<div class="free-shipping-disabled-notice" style="color: #ba2626; font-size: 0.85em; margin-top: 4px; font-weight: 500;">%s</div>',
					esc_html__( 'This product disables free shipping for the entire order.', 'free-shipping-excluder' )
				);
				$product_name .= $notice;
			}
		}

		return $product_name;
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
		// Get array of excluded product IDs from comma-separated string in settings.
		$excluded_product_ids = $free_shipping_method->get_option( 'excluded_products', '' );

		$total_free_shipping_eligible_cost = 0;

		foreach ( WC()->cart->get_cart() as $cart_item ) {
			$product_id = (string) $cart_item['product_id'];

			// Check if product completely disables free shipping if in cart.
			$product_disables_free_shipping = get_post_meta( $cart_item['product_id'], '_disable_free_shipping', true );
			if ( 'yes' === $product_disables_free_shipping ) {
				return false;
			}

			// Check if product is excluded via product-level meta setting.
			$product_excluded_meta = get_post_meta( $cart_item['product_id'], '_exclude_from_free_shipping', true );
			$is_excluded_by_meta   = 'yes' === $product_excluded_meta;

			// Check if product belongs to an excluded category.
			$is_excluded_by_category = $this->is_product_in_excluded_category( $cart_item['product_id'] );

			// If product is not excluded by either method, include it in the calculation.
			if ( ! $is_excluded_by_meta && ! $is_excluded_by_category ) {
				$total_free_shipping_eligible_cost += $cart_item['line_total'];
			}
		}

		$free_shipping_threshold = (float) $free_shipping_method->get_option( 'min_amount', 0 );

		return $total_free_shipping_eligible_cost >= $free_shipping_threshold;
	}

	/**
	 * Check if a product belongs to an excluded category.
	 *
	 * @param int $product_id Product ID.
	 * @return bool True if product is in an excluded category, false otherwise.
	 */
	private function is_product_in_excluded_category( int $product_id ): bool {
		// Get all categories for this product.
		$product_categories = wp_get_post_terms( $product_id, 'product_cat', array( 'fields' => 'ids' ) );

		// If there's an error or no categories, return false.
		if ( is_wp_error( $product_categories ) || empty( $product_categories ) ) {
			return false;
		}

		// Check if any of the product's categories are excluded.
		foreach ( $product_categories as $category_id ) {
			$exclude_from_free_shipping = get_term_meta( $category_id, 'exclude_from_free_shipping', true );
			if ( 'yes' === $exclude_from_free_shipping ) {
				return true;
			}
		}

		return false;
	}
}
