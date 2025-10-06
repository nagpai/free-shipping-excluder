=== Free Shipping Excluder for WooCommerce ===
Contributors: nagpai
Tags: woocommerce, shipping, free shipping, product exclusion, category exclusion
Requires at least: 6.0
Tested up to: 6.8
Stable tag: 1.1
Requires PHP: 8.0
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Exclude specific products or entire product categories from being counted towards the free shipping threshold in WooCommerce.

== Description ==

Free Shipping Excluder for WooCommerce gives you granular control over which products count towards your free shipping minimum amount. This is perfect for stores that sell items like gift cards, services, promotional products, or any items that shouldn't contribute to free shipping eligibility.

= Features =

* **Product-level exclusion** - Exclude individual products from free shipping calculations via a simple checkbox in the product shipping settings
* **Category-level exclusion** - Exclude entire product categories, automatically applying the exclusion to all products within those categories
* **Flexible control** - Use either method or both together to match your specific business needs
* **Seamless integration** - Works with WooCommerce's native free shipping method
* **No configuration complexity** - Simple checkboxes, no complicated settings

= How It Works =

When a customer adds items to their cart, the plugin calculates the free shipping eligibility by:
1. Checking each product for exclusion settings (both product-level and category-level)
2. Summing only the eligible products' costs
3. Comparing the total against your free shipping threshold

Excluded products can still be purchased and shipped - they just don't count towards the minimum amount needed for free shipping.

= Use Cases =

* Exclude gift cards from free shipping calculations
* Exclude digital products or services
* Exclude promotional items or samples
* Exclude low-margin products
* Exclude entire categories like "Accessories" or "Downloads"

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/free-shipping-excluder` directory, or install the plugin through the WordPress plugins screen directly
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Go to Products > Categories to exclude entire categories, or edit individual products to exclude them
4. To exclude a product: Edit the product > Shipping tab > Check "Exclude from free shipping"
5. To exclude a category: Products > Categories > Edit a category > Check "Exclude from free shipping"

== Frequently Asked Questions ==

= How do I exclude a specific product from free shipping? =

Edit the product in WooCommerce, go to the Shipping tab, and check the "Exclude from free shipping" checkbox. Save the product.

= How do I exclude an entire category? =

Go to Products > Categories, edit the category you want to exclude, and check the "Exclude from free shipping" checkbox. All products in that category will be excluded.

= Can excluded products still be purchased? =

Yes! Excluded products can be purchased normally. They simply don't count towards the minimum amount required for free shipping.

= What happens if a product is in both an excluded and non-excluded category? =

If a product belongs to any category marked as excluded, it will be excluded from free shipping calculations.

= Does this work with WooCommerce subscriptions or other extensions? =

The plugin works with WooCommerce's native free shipping method. Compatibility with other extensions depends on how they implement shipping calculations.

= Will customers see which products are excluded? =

No, the exclusion happens behind the scenes in the cart calculation. Customers will simply see whether they qualify for free shipping based on their eligible items.

== Changelog ==

= 1.1 =
* Added category-level exclusion feature
* Enhanced product-level exclusion with meta field support
* Improved calculation logic to support both exclusion methods
* Updated security practices with proper nonce verification

= 1.0 =
* Initial release
* Product-level exclusion from free shipping threshold


