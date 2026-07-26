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
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Check if module is enabled
     *
     * @param string|null $storeId
     * @return bool
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
     *
     * @param string|null $storeId
     * @return float
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
     *
     * @param string|null $storeId
     * @return bool
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
     *
     * @param string|null $storeId
     * @return bool
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
     *
     * @param string|null $storeId
     * @return bool
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
     *
     * @param string|null $storeId
     * @return bool
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
     *
     * @param string|null $storeId
     * @return bool
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
     *
     * @param string|null $storeId
     * @return string
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
     *
     * @param string|null $storeId
     * @return string
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
     *
     * @param string|null $storeId
     * @return string
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
     *
     * @param string|null $storeId
     * @return string
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
     *
     * @param string|null $storeId
     * @return string
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
     *
     * @param string|null $storeId
     * @return string
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
     *
     * @param string|null $storeId
     * @return string
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
     *
     * @param string|null $storeId
     * @return array
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
     *
     * @param string|null $storeId
     * @return array
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
