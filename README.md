# SomePlus Free Shipping Bar for Magento 2

Motivate customers to add more products to their cart with a dynamic free shipping progress bar.

![Free Shipping Bar Preview](https://via.placeholder.com/800x200?text=Free+Shipping+Progress+Bar)

## Features

- ✅ **4 Display Positions** - Header, Mini Cart, Cart Page, Checkout
- 🎨 **Fully Customizable** - Colors, messages, and thresholds from admin
- ⚡ **Real-time Updates** - Bar updates instantly when cart changes
- 🎉 **Celebration Animation** - Special animation when threshold is reached
- 🌍 **Multi-store Support** - Different settings per store view
- 📱 **Responsive Design** - Works on all devices

## Requirements

- Magento 2.4.x
- PHP 8.1+

## Installation

### Via Composer (Recommended)

```bash
composer require someplus/module-free-shipping-bar
bin/magento module:enable SomePlus_FreeShippingBar
bin/magento setup:upgrade
bin/magento cache:flush
```

### Manual Installation

1. Create directory `app/code/SomePlus/FreeShippingBar`
2. Copy module files to this directory
3. Run:
```bash
bin/magento module:enable SomePlus_FreeShippingBar
bin/magento setup:upgrade
bin/magento cache:flush
```

## Configuration

Navigate to **Stores → Configuration → SomePlus → Free Shipping Bar**

### General Settings
| Setting | Description |
|---------|-------------|
| Enable | Turn the module on/off |
| Free Shipping Threshold | Minimum cart amount for free shipping |
| Include Tax | Include tax in calculation |

### Display Positions
Choose where to show the progress bar:
- Header (sticky bar below header)
- Mini Cart
- Cart Page
- Checkout Page

### Design Settings
Customize colors:
- Progress Bar Color
- Background Color
- Text Color
- Achievement Color (when threshold reached)

### Messages
Customize messages with placeholders:
- `{{remaining}}` - Amount left to reach threshold
- `{{threshold}}` - Target amount
- `{{current}}` - Current cart total
- `{{percentage}}` - Progress percentage

## Changelog

### 1.0.0
- Initial release
- Header, minicart, cart, checkout positions
- Admin configuration panel
- Real-time cart updates
- Customizable colors and messages

## Support

For issues or feature requests, please contact support@someplus.com

## License

Open Software License (OSL 3.0)
# FreeShippingBar
