<?php
/**
 * SomePlus Free Shipping Bar
 *
 * @category  SomePlus
 * @package   SomePlus_FreeShippingBar
 */

declare(strict_types=1);

namespace SomePlus\FreeShippingBar\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Configuration provider for Free Shipping Bar settings
 */
class ConfigProvider
{
    private const XML_PATH_PREFIX = 'someplus_freeshippingbar/';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Check if module is enabled
     */
    public function isEnabled(?string $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_PREFIX . 'general/enabled',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get free shipping threshold amount
     */
    public function getThreshold(?string $storeId = null): float
    {
        return (float) $this->scopeConfig->getValue(
            self::XML_PATH_PREFIX . 'general/threshold',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Check if tax should be included in calculation
     */
    public function isIncludeTax(?string $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_PREFIX . 'general/include_tax',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Check if bar should show in header
     */
    public function isShowInHeader(?string $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_PREFIX . 'display/show_header',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Check if bar should show in mini cart
     */
    public function isShowInMinicart(?string $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_PREFIX . 'display/show_minicart',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Check if bar should show on cart page
     */
    public function isShowInCart(?string $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_PREFIX . 'display/show_cart',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Check if bar should show on checkout
     */
    public function isShowInCheckout(?string $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_PREFIX . 'display/show_checkout',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get progress bar fill color
     */
    public function getBarColor(?string $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_PREFIX . 'design/bar_color',
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: '#10b981';
    }

    /**
     * Get progress bar background color
     */
    public function getBgColor(?string $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_PREFIX . 'design/bg_color',
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: '#e5e7eb';
    }

    /**
     * Get message text color
     */
    public function getTextColor(?string $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_PREFIX . 'design/text_color',
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: '#374151';
    }

    /**
     * Get achievement bar color
     */
    public function getAchievedColor(?string $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_PREFIX . 'design/achieved_color',
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: '#059669';
    }

    /**
     * Get progress message template
     */
    public function getProgressMessage(?string $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_PREFIX . 'messages/progress_message',
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: '🚚 Add <strong>{{remaining}}</strong> more for free shipping!';
    }

    /**
     * Get achievement message template
     */
    public function getAchievedMessage(?string $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_PREFIX . 'messages/achieved_message',
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: '🎉 Congratulations! You\'ve unlocked free shipping!';
    }

    /**
     * Get empty cart message template
     */
    public function getEmptyCartMessage(?string $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_PREFIX . 'messages/empty_cart_message',
            ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?: '🛒 Add items to your cart, free shipping on orders over <strong>{{threshold}}</strong>!';
    }

    /**
     * Get all display positions as array
     */
    public function getEnabledPositions(?string $storeId = null): array
    {
        $positions = [];

        if ($this->isShowInHeader($storeId)) {
            $positions[] = 'header';
        }
        if ($this->isShowInMinicart($storeId)) {
            $positions[] = 'minicart';
        }
        if ($this->isShowInCart($storeId)) {
            $positions[] = 'cart';
        }
        if ($this->isShowInCheckout($storeId)) {
            $positions[] = 'checkout';
        }

        return $positions;
    }

    /**
     * Get all design settings as array
     */
    public function getDesignSettings(?string $storeId = null): array
    {
        return [
            'barColor' => $this->getBarColor($storeId),
            'bgColor' => $this->getBgColor($storeId),
            'textColor' => $this->getTextColor($storeId),
            'achievedColor' => $this->getAchievedColor($storeId),
        ];
    }
}
