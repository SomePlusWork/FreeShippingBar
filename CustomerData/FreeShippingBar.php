<?php
/**
 * SomePlus Free Shipping Bar
 *
 * @category  SomePlus
 * @package   SomePlus_FreeShippingBar
 */

declare(strict_types=1);

namespace SomePlus\FreeShippingBar\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use SomePlus\FreeShippingBar\Model\ConfigProvider;
use SomePlus\FreeShippingBar\Model\ProgressCalculator;

/**
 * Customer data section for free shipping bar
 * This enables real-time updates via Magento's customer-data JS library
 */
class FreeShippingBar implements SectionSourceInterface
{
    /**
     * @var ConfigProvider
     */
    protected ConfigProvider $configProvider;

    /**
     * @var ProgressCalculator
     */
    protected ProgressCalculator $progressCalculator;

    /**
     * @param ConfigProvider $configProvider
     * @param ProgressCalculator $progressCalculator
     */
    public function __construct(
        ConfigProvider $configProvider,
        ProgressCalculator $progressCalculator
    ) {
        $this->configProvider = $configProvider;
        $this->progressCalculator = $progressCalculator;
    }

    /**
     * Get section data for KnockoutJS component
     *
     * @return array
     */
    public function getSectionData(): array
    {
        if (!$this->configProvider->isEnabled()) {
            return ['enabled' => false];
        }

        $progressData = $this->progressCalculator->calculate();
        $designSettings = $this->configProvider->getDesignSettings();
        $positions = $this->configProvider->getEnabledPositions();

        return [
            'enabled' => true,
            'positions' => $positions,
            'showInHeader' => $this->configProvider->isShowInHeader(),
            'showInMinicart' => $this->configProvider->isShowInMinicart(),
            'showInCart' => $this->configProvider->isShowInCart(),
            'showInCheckout' => $this->configProvider->isShowInCheckout(),
            'progress' => $progressData,
            'design' => $designSettings,
        ];
    }
}
