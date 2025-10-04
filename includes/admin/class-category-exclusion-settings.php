<?php
/**
 * Category exclusion settings for Free Shipping Excluder plugin.
 *
 * @package FreeShippingExcluder
 */

declare( strict_types = 1 );

namespace FreeShippingExcluder\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Class Category_Exclusion_Settings
 */
class Category_Exclusion_Settings {
	/**
	 * Constructor to initialize the category settings.
	 */
	public function __construct() {
		add_action( 'product_cat_add_form_fields', array( $this, 'add_category_exclude_field' ) );
		add_action( 'product_cat_edit_form_fields', array( $this, 'edit_category_exclude_field' ) );
		add_action( 'created_product_cat', array( $this, 'save_category_exclude_field' ) );
		add_action( 'edited_product_cat', array( $this, 'save_category_exclude_field' ) );
	}

	/**
	 * Add checkbox field to category create form.
	 *
	 * @return void
	 */
	public function add_category_exclude_field(): void {
		?>
		<div class="form-field">
			<label for="exclude_from_free_shipping">
				<input type="checkbox" name="exclude_from_free_shipping" id="exclude_from_free_shipping" value="yes" />
				<?php esc_html_e( 'Exclude from free shipping', 'free-shipping-excluder' ); ?>
			</label>
			<p class="description">
				<?php esc_html_e( 'Exclude all products in this category from free shipping threshold calculations. Products in this category will not count towards the minimum amount required for free shipping.', 'free-shipping-excluder' ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Add checkbox field to category edit form.
	 *
	 * @param \WP_Term $term The category term object.
	 * @return void
	 */
	public function edit_category_exclude_field( $term ): void {
		$exclude_from_free_shipping = get_term_meta( $term->term_id, 'exclude_from_free_shipping', true );
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="exclude_from_free_shipping">
					<?php esc_html_e( 'Exclude from free shipping', 'free-shipping-excluder' ); ?>
				</label>
			</th>
			<td>
				<input type="checkbox" name="exclude_from_free_shipping" id="exclude_from_free_shipping" value="yes" <?php checked( $exclude_from_free_shipping, 'yes' ); ?> />
				<p class="description">
					<?php esc_html_e( 'Exclude all products in this category from free shipping threshold calculations. Products in this category will not count towards the minimum amount required for free shipping.', 'free-shipping-excluder' ); ?>
				</p>
			</td>
		</tr>
		<?php
	}

	/**
	 * Save the exclude from free shipping field value for category.
	 *
	 * @param int $term_id Category term ID.
	 * @return void
	 */
	public function save_category_exclude_field( int $term_id ): void {
		// Check user permissions.
		if ( ! current_user_can( 'manage_product_terms' ) ) {
			return;
		}

		// Check nonce for security.
		if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'update-tag_' . $term_id ) ) {
			// For new categories, the nonce might be different.
			if ( ! isset( $_POST['_wpnonce_add-tag'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce_add-tag'] ) ), 'add-tag' ) ) {
				return;
			}
		}

		$exclude_from_free_shipping = isset( $_POST['exclude_from_free_shipping'] ) ? 'yes' : 'no';
		update_term_meta( $term_id, 'exclude_from_free_shipping', $exclude_from_free_shipping );
	}
}
