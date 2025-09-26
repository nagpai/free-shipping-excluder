# Free Shipping Excluder - AI Coding Guidelines

## Architecture Overview

This is a **WooCommerce extension** that modifies free shipping calculations by excluding specific products from the minimum threshold. The plugin uses a **filter-based architecture** hooking into WooCommerce's shipping system.

**Core Components:**
- `free-shipping-excluder.php` - Plugin bootstrap (loads classes, no business logic)
- `includes/class-free-shipping-excluder.php` - Main shipping logic via `woocommerce_shipping_free_shipping_is_available` filter
- `includes/admin/class-free-shipping-excluder-settings.php` - Admin UI integration via `woocommerce_shipping_instance_form_fields_free_shipping` filter

## Key Technical Patterns

### WooCommerce Filter Integration
- **Primary filter**: `woocommerce_shipping_free_shipping_is_available` receives `($is_available, $package, $shipping_method)` 
- **Settings filter**: `woocommerce_shipping_instance_form_fields_free_shipping` adds custom fields to Free Shipping method settings
- Always use the `$shipping_method->get_option()` method to retrieve dynamic values from WooCommerce settings

### Namespace Convention
- Root namespace: `FreeShippingExcluder`
- Admin classes: `FreeShippingExcluder\Admin`
- Avoid redundant `use` statements when already in the target namespace

### Data Handling Patterns
```php
// Settings stored as comma-separated string, converted to array
$excluded_ids = array_map( 'trim', explode( ',', $setting_value ) );

// Always cast product IDs to string for comparison
in_array( (string) $cart_item['product_id'], $excluded_ids, true )

// Get shipping method options with fallback
$threshold = (float) $shipping_method->get_option( 'min_amount', 0 );
```

## WordPress/WooCommerce Specifics

### Plugin Structure
- **Entry point**: Main plugin file contains only bootstrap code and class instantiation
- **Security**: Always include `defined( 'ABSPATH' ) || exit;` security check
- **Type declarations**: Use `declare( strict_types=1 );` consistently
- **Hook priority**: Use priority `10` and specify parameter count (e.g., `, 10, 3`)

### WooCommerce Integration Points
- **Cart access**: Use `WC()->cart->get_cart()` to iterate cart items
- **Product data**: Access via `$cart_item['product_id']` and `$cart_item['line_total']`
- **Settings UI**: Extend existing shipping method settings, don't create separate admin pages

## Development Workflow

### Local Environment
- Plugin developed in Local by Flywheel environment: `/Local Sites/wootestlocal/app/public/wp-content/plugins/`
- No build process - direct PHP development with immediate testing
- Use WordPress debug logging: `error_log()` instead of `var_dump()` for production-safe debugging

### Code Standards
- Follow WordPress Coding Standards for PHP
- Use tabs for indentation (WordPress convention)
- Document all methods with proper `@param` and `@return` annotations
- Include translator-ready strings with text domain: `'free-shipping-excluder'`

## Critical Implementation Notes

### Shipping Method Context
The `exclude_products_from_free_shipping()` method executes **within the context of WooCommerce's Free Shipping method evaluation**. This means:
- The `$shipping_method` parameter is always a `WC_Shipping_Free_Shipping` instance
- Use `$shipping_method->get_option()` to access method-specific settings dynamically
- Never hardcode thresholds - always retrieve from WooCommerce settings

### Product Exclusion Logic
Products are excluded from the **eligibility calculation**, not from shipping availability entirely. The plugin:
1. Calculates total cost of non-excluded products only
2. Compares against the Free Shipping minimum amount setting
3. Returns boolean for free shipping availability

### Admin Integration
Settings are added **directly to existing WooCommerce shipping method forms**, not as separate admin pages. This provides a seamless user experience within the familiar WooCommerce interface.

## Testing Considerations
- Test with various product combinations (excluded/non-excluded)
- Verify behavior with multiple shipping zones and methods
- Ensure settings persist correctly in WooCommerce admin
- Test with different Free Shipping minimum amount configurations

## Future Feature Enhancements

### 1. Product-Level Exclusion Settings
**Goal**: Add a checkbox in the Product Edit page → Shipping tab to exclude individual products from free shipping calculations.

**Implementation approach**:
- Add meta box to `woocommerce_product_options_shipping` action hook
- Store exclusion setting as product meta: `_exclude_from_free_shipping`
- Create new class: `includes/admin/class-product-shipping-settings.php`
- Modify main exclusion logic to check both shipping method settings AND product meta
- Use `get_post_meta( $product_id, '_exclude_from_free_shipping', true )`

**Key considerations**:
- Maintain backward compatibility with existing comma-separated product ID lists
- Product-level settings should override shipping method settings
- Include checkbox in Product Shipping tab using `woocommerce_product_options_shipping_product_data` hook

### 2. Category-Level Exclusion Settings
**Goal**: Exclude entire product categories from free shipping threshold calculations.

**Implementation approach**:
- Add settings to WooCommerce → Settings → Products → Categories or create dedicated admin page
- Store excluded categories as WordPress option: `free_shipping_excluded_categories`
- Modify exclusion logic to check product categories: `wp_get_post_terms( $product_id, 'product_cat' )`
- Create new class: `includes/admin/class-category-exclusion-settings.php`

**Key considerations**:
- Handle category hierarchy (parent/child categories)
- Performance optimization for category checks in cart loops
- Category exclusions should work alongside product-level and shipping method exclusions
- Use `has_term()` function for efficient category checking

**Architecture Impact**:
Both features will require expanding the main `exclude_products_from_free_shipping()` method to check multiple exclusion sources in this priority order:
1. Product-level meta settings (highest priority)
2. Category-level exclusions 
3. Shipping method comma-separated product IDs (current implementation)

This maintains backward compatibility while providing more granular control.
