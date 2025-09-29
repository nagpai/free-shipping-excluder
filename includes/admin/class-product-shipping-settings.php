<?php
/**
 * Product shipping settings for Free Shipping Excluder plugin.
 *
 * @package FreeShippingExcluder
 */

declare( strict_types = 1 );

namespace FreeShippingExcluder\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Class Product_Shipping_Settings
 */
class Product_Shipping_Settings {
	/**
	 * Constructor to initialize the product settings.
	 */
	public function __construct() {
		add_action( 'woocommerce_product_options_shipping', array( $this, 'add_exclude_from_free_shipping_field' ) );
		add_action( 'woocommerce_process_product_meta', array( $this, 'save_exclude_from_free_shipping_field' ) );
	}

	/**
	 * Add checkbox field to exclude product from free shipping calculation.
	 *
	 * @return void
	 */
	public function add_exclude_from_free_shipping_field(): void {
		woocommerce_wp_checkbox(
			array(
				'id'          => '_exclude_from_free_shipping',
				'label'       => __( 'Exclude from free shipping', 'free-shipping-excluder' ),
				'description' => __( 'Exclude this product from free shipping threshold calculations. This product\'s cost will not count towards the minimum amount required for free shipping.', 'free-shipping-excluder' ),
				'desc_tip'    => true,
			)
		);
	}

	/**
	 * Save the exclude from free shipping field value.
	 *
	 * @param int $post_id Product ID.
	 * @return void
	 */
	public function save_exclude_from_free_shipping_field( int $post_id ): void {
		// Verify nonce for security.
		if ( ! isset( $_POST['woocommerce_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['woocommerce_meta_nonce'] ) ), 'woocommerce_save_data' ) ) {
			return;
		}

		// Check user permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Don't save on autosave.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		$exclude_from_free_shipping = isset( $_POST['_exclude_from_free_shipping'] ) ? 'yes' : 'no';
		update_post_meta( $post_id, '_exclude_from_free_shipping', $exclude_from_free_shipping );
	}
}
