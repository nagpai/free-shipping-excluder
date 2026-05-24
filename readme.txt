=== Free Shipping Excluder for WooCommerce ===
Contributors: nagpai
Tags: woocommerce, shipping, free shipping, product exclusion, category exclusion
Requires at least: 6.0
Tested up to: 7.0
Stable tag: 1.3
Requires PHP: 8.0
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Exclude specific products or categories from the free shipping threshold, or disable free shipping if specific products are in the cart.

== Description ==

Free Shipping Excluder for WooCommerce gives you granular control over how products affect your free shipping eligibility. You can exclude individual products or entire categories from counting towards your free shipping minimum amount, or completely disable free shipping for the entire order if a specific product is added to the cart. This is perfect for stores that sell items like gift cards, services, promotional products, or heavy/bulky items that shouldn't qualify for free shipping.

= Features =

* **Product-level exclusion** - Exclude individual products from free shipping calculations via a simple checkbox in the product shipping settings
* **Category-level exclusion** - Exclude entire product categories, automatically applying the exclusion to all products within those categories
* **Disable free shipping entirely** - Completely disable free shipping for the entire order if a specific product is in the cart, regardless of order total
* **Flexible control** - Use either method or both together to match your specific business needs
* **Seamless integration** - Works with WooCommerce's native free shipping method
* **No configuration complexity** - Simple checkboxes, no complicated settings

= How It Works =

When a customer adds items to their cart, the plugin calculates the free shipping eligibility by:
1. Checking if any product in the cart has "Disable free shipping if in cart" enabled. If so, free shipping is immediately disabled for the entire order.
2. Checking each product for exclusion settings (both product-level and category-level)
3. Summing only the eligible products' costs
4. Comparing the total against your free shipping threshold

Excluded products can still be purchased and shipped - they just don't count towards the minimum amount needed for free shipping.

= Use Cases =

* Exclude gift cards from free shipping calculations
* Exclude digital products or services
* Prevent free shipping entirely for bulky, heavy, or high-shipping-cost items
* Exclude promotional items or samples
* Exclude low-margin products
* Exclude entire categories like "Accessories" or "Downloads"

== Contribution ==

You are welcome to contribute to this free and open source extension:

- **Source Code:**
  [https://github.com/nagpai/free-shipping-excluder](https://github.com/nagpai/free-shipping-excluder)

- **Report Issues / Wishlists:**
  [https://github.com/nagpai/free-shipping-excluder/issues](https://github.com/nagpai/free-shipping-excluder/issues)

== Screenshots
1. Product level exclusion setting
2. Category level exclusion setting
3. Product level free shipping disable setting

== Support ==

- Use the [Dedicated WP.org Support Forum](https://wordpress.org/support/plugin/free-shipping-excluder/)
- [Contact the plugin author](https://nagpai.blog/contact-me/)
- Like this plugin? Please share your love with a [review and rating](https://wordpress.org/support/plugin/free-shipping-excluder/reviews/#new-post)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/free-shipping-excluder` directory, or install the plugin through the WordPress plugins screen directly
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Go to Products > Categories to exclude entire categories, or edit individual products to exclude them or disable free shipping entirely
4. To exclude a product: Edit the product > Shipping tab > Check "Exclude from free shipping"
5. To exclude a category: Products > Categories > Edit a category > Check "Exclude from free shipping"
6. To disable free shipping entirely for a product: Edit the product > Shipping tab > Check "Disable free shipping if in cart"

== Frequently Asked Questions ==

= How do I exclude a specific product from free shipping? =

Edit the product in WooCommerce, go to the Shipping tab, and check the "Exclude from free shipping" checkbox. Save the product.

= How do I exclude an entire category? =

Go to Products > Categories, edit the category you want to exclude, and check the "Exclude from free shipping" checkbox. All products in that category will be excluded.

= How do I completely disable free shipping for the entire order if a specific product is in the cart? =

Edit the product in WooCommerce, go to the Shipping tab, and check the "Disable free shipping if in cart" checkbox. Once checked, if a customer adds this product to their cart, the entire order will be disqualified from free shipping, regardless of the cart total or any other products present.

= Can excluded products still be purchased? =

Yes! Excluded products can be purchased normally. They simply don't count towards the minimum amount required for free shipping.

= What happens if a product is in both an excluded and non-excluded category? =

If a product belongs to any category marked as excluded, it will be excluded from free shipping calculations.

= Does this work with WooCommerce subscriptions or other extensions? =

The plugin works with WooCommerce's native free shipping method. Compatibility with other extensions depends on how they implement shipping calculations.

= Will customers see which products are excluded? =

No, the exclusion happens behind the scenes in the cart calculation. Customers will simply see whether they qualify for free shipping based on their eligible items.

== Changelog ==

= 1.3 =
* Added option to completely disable free shipping for the entire order when specific products are in the cart.

= 1.2 =
* Added virtual product exclusion feature

= 1.1 =
* Added category-level exclusion feature
* Enhanced product-level exclusion with meta field support
* Improved calculation logic to support both exclusion methods
* Updated security practices with proper nonce verification

= 1.0 =
* Initial release
* Product-level exclusion from free shipping threshold


