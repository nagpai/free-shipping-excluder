# Free Shipping Excluder for WooCommerce
A WooCommerce extension that allows you to exclude specific products and categories from being counted towards the free shipping threshold. It ensures that certain products do not contribute to the total cost required for free shipping, allowing you to control shipping costs more effectively.

## Installation

1. Download the zip file of the plugin from this repository.
2. Upload and install the plugin through the 'Plugins' menu in WordPress:
   - Go to 'Plugins' > 'Add New'.
   - Click on 'Upload Plugin'.
   - Choose the downloaded zip file and click 'Install Now'.
3. Alternatively, you can clone the repository into your WordPress plugins directory.
4. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

### Exclude Individual Products

1. After activation, go to 'Products' in WordPress admin.
2. Click on any product that you wish to exclude from free shipping calculation.
3. Scroll down to the 'Product Data' section.
4. Click on the 'Shipping' tab.
5. You will see a checkbox to exclude this product from free shipping.
6. Check the box to exclude this product from free shipping.
7. Save the changes.

### Exclude Product Categories

1. Go to 'Products' > 'Categories' in WordPress admin.
2. Click on any category you wish to exclude from free shipping calculation (or create a new one).
3. You will see a checkbox labeled 'Exclude from free shipping'.
4. Check the box to exclude all products in this category from free shipping threshold calculations.
5. Save the changes.
6. All products belonging to this category will now be excluded from the free shipping calculation.

### Test live and instantly with WordPress Playground

[ Test on WP Playground ](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/nagpai/free-shipping-excluder/refs/heads/main/_playground/github-blueprint.json)

Steps to test:

1. Initiate a Playground instance by clicking the link above
2. The test site has a Free Shipping method set for delivery within California, US. The threshold amount is USD 100
3. Add one of two numbers of the `Non-free Shipping` product to the cart 
4. Go to checkout and observe that there is a flat rate shipping applied for any California test address. 
5. Add a few other products to the cart, the flat rate shipping fee will continue to show until the value of other products except Non-free Shipping goes above 100
6. Create a category - say `No Free Shipping`. Make sure you check the `Exclude from free shipping` checkbox.
7. Apply the category to any product, and repeat the above tests to see if its cost is excluded from free shipping threshold calculation.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any improvements or bug fixes.

## License
This plugin is licensed under the GPLv2


