# User Guide: Free Shipping Bar for Magento 2

## Overview
The **Free Shipping Bar** extension by SomePlus is designed to increase your store's average order value (AOV) by providing customers with a visual progress bar that tracks their journey towards qualifying for free shipping.

## Key Features
- **Dynamic Calculation**: Real-time updates as customers add or remove items from their cart.
- **Multiple Display Locations**:
  - Storefront Header (Sticky or Static)
  - Mini Cart
  - Shopping Cart Page
  - Checkout Page
- **Customizable Messages**: Define unique messages for "Initial State", "In Progress", and "Achieved".
- **Design Flexibility**: Fully customizable colors, fonts, and progress bar styles via the Admin Panel.
- **Responsive Design**: Works seamlessly on mobile, tablet, and desktop.

## Installation
1. Purchase and download the extension from Adobe Commerce Marketplace.
2. Unzip the package into your Magento root directory under `app/code/SomePlus/FreeShippingBar`.
3. Run the following commands:
   ```bash
   bin/magento setup:upgrade
   bin/magento setup:di:compile
   bin/magento setup:static-content:deploy
   bin/magento cache:flush
   ```

## Configuration
Go to **Admin Panel > Stores > Configuration > SomePlus > Free Shipping Bar**.

### General Settings
- **Enable**: Set to 'Yes' to activate the bar.
- **Free Shipping Threshold**: Enter the minimum amount required for free shipping (e.g., 50.00).

### Content Settings
- **Announce Message**: Displayed when the cart is empty (e.g., "Spend $50 and get FREE shipping!").
- **Progress Message**: Displayed while the goal is not met (e.g., "Only {{remaining_amount}} away from FREE shipping!").
- **Success Message**: Displayed when the goal is reached (e.g., "Congratulations! You've got FREE shipping!").

### Design Settings
- **Bar Background Color**: Choose the base color for the bar.
- **Progress Color**: Choose the color for the progress indicator.
- **Text Color**: Choose the font color.
- **Font Size**: Set the font size in pixels.

## Troubleshooting
If the bar does not appear:
1. Ensure the extension is enabled in configurations.
2. Check if the 'Free Shipping' method is enabled in **Stores > Configuration > Sales > Shipping Methods**.
3. Clear Magento and Browser cache.

## Support
For any questions or customization requests, please contact us at [support@someplus.com](mailto:support@someplus.com).
