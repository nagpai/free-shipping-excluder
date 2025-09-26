# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a WordPress plugin called "Free Shipping Excluder for WooCommerce" that allows excluding specific products from being counted towards the free shipping threshold in WooCommerce stores.

## Architecture

The plugin follows WordPress plugin conventions with a simple, focused architecture:

- **Main Plugin File**: `free-shipping-excluder.php` - Contains plugin headers and initializes the main classes
- **Core Logic**: `includes/class-free-shipping-excluder.php` - Implements the main shipping filter logic
- **Admin Settings**: `includes/admin/class-free-shipping-excluder-settings.php` - Adds settings UI to WooCommerce shipping methods

### Key Components

1. **Free_Shipping_Excluder Class** (`includes/class-free-shipping-excluder.php:17`)
   - Hooks into `woocommerce_shipping_free_shipping_is_available` filter
   - Calculates shipping eligibility excluding specified products
   - Compares cart total against free shipping threshold

2. **Free_Shipping_Excluder_Settings Class** (`includes/admin/class-free-shipping-excluder-settings.php:19`)
   - Extends WooCommerce free shipping method settings
   - Adds "excluded_products" field for comma-separated product IDs

### WordPress/WooCommerce Integration

The plugin integrates with WooCommerce through:
- Filter hooks for shipping calculations
- Settings API for admin configuration
- Cart and product data access through WC() global

## Development

This is a simple WordPress plugin with no build process, testing framework, or complex dependencies. Development involves direct PHP file editing.

### File Structure
```
free-shipping-excluder.php          # Plugin entry point
includes/
├── class-free-shipping-excluder.php           # Core shipping logic
└── admin/
    └── class-free-shipping-excluder-settings.php  # Admin settings
```

### WordPress Plugin Standards
- Uses PHP namespaces (`FreeShippingExcluder`)
- Follows WordPress coding standards with `declare(strict_types=1)`
- Includes proper plugin headers for WordPress plugin directory
- Uses WordPress security practices (`defined('ABSPATH') || exit`)

## Usage Context

The plugin is designed for WooCommerce store owners who want to exclude certain products (like gift cards, services, or promotional items) from counting toward free shipping thresholds while still allowing those products to be purchased.