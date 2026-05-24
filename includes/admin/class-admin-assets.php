<?php
/**
 * Admin assets for Free Shipping Excluder plugin.
 *
 * @package FreeShippingExcluder
 */

declare( strict_types = 1 );

namespace FreeShippingExcluder\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Class Admin_Assets
 */
class Admin_Assets {
	/**
	 * Constructor to initialize admin assets.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_product_edit_scripts' ) );
	}

	/**
	 * Enqueue scripts for product edit page.
	 *
	 * @param string $hook Current admin page hook.
	 * @return void
	 */
	public function enqueue_product_edit_scripts( string $hook ): void {
		// Only load on product edit pages.
		if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
			return;
		}

		global $post;
		if ( ! $post || 'product' !== $post->post_type ) {
			return;
		}

		wp_enqueue_script(
			'free-shipping-excluder-admin-virtual-product-edit',
			plugins_url(
				'assets/js/free-shipping-excluder-admin-virtual-product-edit.js',
				dirname( __DIR__, 2 ) . '/free-shipping-excluder.php'
			),
			array( 'jquery', 'wc-admin-meta-boxes' ),
			'1.0.0',
			true
		);
	}
}
