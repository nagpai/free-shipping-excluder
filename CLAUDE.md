# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a WordPress plugin called "Free Shipping Excluder for WooCommerce" that allows excluding specific products from being counted towards the free shipping threshold in WooCommerce stores.

## Architecture

The plugin follows WordPress plugin conventions with a simple, focused architecture:

- **Main Plugin File**: `free-shipping-excluder.php` - Contains plugin headers and initializes the main classes
- **Core Logic**: `includes/class-free-shipping-excluder.php` - Implements the main shipping filter logic
- **Admin Settings**: 
  - `includes/admin/class-product-shipping-settings.php` - Adds product-level shipping exclusion settings
  - `includes/admin/class-category-exclusion-settings.php` - Adds category-level exclusion settings
  - `includes/admin/class-admin-assets.php` - Manages admin UI enhancements for virtual products

### Key Components

1. **Free_Shipping_Excluder Class** (`includes/class-free-shipping-excluder.php`)
   - Hooks into `woocommerce_shipping_free_shipping_is_available` filter
   - Calculates shipping eligibility excluding specified products
   - Compares cart total against free shipping threshold

2. **Product_Shipping_Settings Class** (`includes/admin/class-product-shipping-settings.php`)
   - Adds "Exclude from free shipping" checkbox to product edit pages
   - Makes Shipping tab visible for Virtual products (removes `hide_if_virtual` class)
   - Saves product-level exclusion settings to post meta

3. **Category_Exclusion_Settings Class** (`includes/admin/class-category-exclusion-settings.php`)
   - Adds category-level exclusion settings
   - Allows excluding entire product categories from free shipping calculations

4. **Admin_Assets Class** (`includes/admin/class-admin-assets.php`)
   - Enqueues JavaScript for product edit pages
   - Dynamically removes default shipping fields (Weight, Dimensions, Shipping Class) for Virtual products
   - Preserves only the "Exclude from free shipping" checkbox for Virtual products
   - Implements smooth toggle behavior without page reload when Virtual checkbox changes

### WordPress/WooCommerce Integration

The plugin integrates with WooCommerce through:
- Filter hooks for shipping calculations and product data tabs
- Product meta for per-product exclusion settings
- Category meta for category-wide exclusions
- JavaScript for enhanced admin UI behavior
- Cart and product data access through WC() global

### Virtual Product Handling

A key feature is the enhanced Shipping tab for Virtual products:
- By default, WooCommerce hides the Shipping tab for Virtual products
- This plugin removes the `hide_if_virtual` class to make it visible
- JavaScript removes irrelevant shipping fields (Weight, Dimensions, Shipping Class)
- Only the "Exclude from free shipping" checkbox remains visible for Virtual products
- Elements are cloned and stored, allowing instant restoration when Virtual is unchecked

## Development

This is a simple WordPress plugin with no build process, testing framework, or complex dependencies. Development involves direct PHP file editing.

### File Structure
```
free-shipping-excluder.php          # Plugin entry point
includes/
├── class-free-shipping-excluder.php           # Core shipping logic
└── admin/
    ├── class-product-shipping-settings.php    # Product-level exclusion settings
    ├── class-category-exclusion-settings.php  # Category-level exclusion settings
    └── class-admin-assets.php                 # Admin UI enhancements
```

### WordPress Plugin Standards
- Uses PHP namespaces (`FreeShippingExcluder`)
- Follows WordPress coding standards with `declare(strict_types=1)`
- Includes proper plugin headers for WordPress plugin directory
- Uses WordPress security practices (`defined('ABSPATH') || exit`)

## Usage Context

The plugin is designed for WooCommerce store owners who want to exclude certain products (like gift cards, services, or promotional items) from counting toward free shipping thresholds while still allowing those products to be purchased.
