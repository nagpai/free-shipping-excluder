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

		wp_add_inline_script(
			'wc-admin-meta-boxes',
			"
			jQuery(document).ready(function($) {
				var removedElements = [];
				
				// Function to toggle shipping fields visibility for virtual products
				function toggleShippingFieldsForVirtual() {
					var isVirtual = $('#_virtual').is(':checked');
					
					if (isVirtual) {
						// Save and remove default shipping fields for virtual products
						removedElements = [];
						
						$('#shipping_product_data .options_group').each(function() {
							var \$group = $(this);
							// Keep only the group that contains our custom fields
							if (\$group.find('#_exclude_from_free_shipping').length === 0 && \$group.find('#_disable_free_shipping').length === 0) {
								removedElements.push({
									element: \$group.clone(true),
									index: \$group.index()
								});
								\$group.remove();
							}
						});
						
						// Also remove the Shipping Class dropdown
						var \$shippingClass = $('#shipping_product_data p.form-field.shipping_class_field');
						if (\$shippingClass.length) {
							removedElements.push({
								element: \$shippingClass.clone(true),
								index: \$shippingClass.index()
							});
							\$shippingClass.remove();
						}
					} else {
						// Restore previously removed elements
						if (removedElements.length > 0) {
							// Sort by original index to maintain order
							removedElements.sort(function(a, b) {
								return a.index - b.index;
							});
							
							// Restore elements
							removedElements.forEach(function(item) {
								var children = $('#shipping_product_data').children();
								if (item.index >= children.length) {
									$('#shipping_product_data').append(item.element);
								} else {
									item.element.insertBefore(children.eq(item.index));
								}
							});
							
							removedElements = [];
						}
					}
				}

				// Run on page load
				toggleShippingFieldsForVirtual();

				// Run when virtual checkbox changes
				$('#_virtual').on('change', function() {
					toggleShippingFieldsForVirtual();
				});
			});
			"
		);
	}
}
