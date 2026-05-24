/**
 * Admin Product Edit script for Free Shipping Excluder.
 */
jQuery(document).ready(function($) {
	var removedElements = [];
	
	// Function to toggle shipping fields visibility for virtual products
	function toggleShippingFieldsForVirtual() {
		var isVirtual = $('#_virtual').is(':checked');
		
		if (isVirtual) {
			// Save and remove default shipping fields for virtual products
			removedElements = [];
			
			$('#shipping_product_data .options_group').each(function() {
				var $group = $(this);
				// Keep only the group that contains our custom field
				if ($group.find('#_exclude_from_free_shipping').length === 0) {
					removedElements.push({
						element: $group.clone(true),
						index: $group.index()
					});
					$group.remove();
				}
			});
			
			// Also remove the Shipping Class dropdown
			var $shippingClass = $('#shipping_product_data p.form-field.shipping_class_field');
			if ($shippingClass.length) {
				removedElements.push({
					element: $shippingClass.clone(true),
					index: $shippingClass.index()
				});
				$shippingClass.remove();
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
