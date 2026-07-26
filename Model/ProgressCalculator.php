<?php
/**
 * SomePlus Free Shipping Bar
 *
 * @category  SomePlus
 * @package   SomePlus_FreeShippingBar
 */

declare(strict_types=1);

namespace SomePlus\FreeShippingBar\Model;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Pricing\PriceCurrencyInterface;

/**
 * Progress calculator for free shipping bar
 */
class ProgressCalculator
{
    /**
     * @var CheckoutSession
     */
    protected CheckoutSession $checkoutSession;

    /**
     * @var ConfigProvider
     */
    protected ConfigProvider $configProvider;

    /**
     * @var PriceCurrencyInterface
     */
    protected PriceCurrencyInterface $priceCurrency;

    /**
     * @param CheckoutSession $checkoutSession
     * @param ConfigProvider $configProvider
     * @param PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        CheckoutSession $checkoutSession,
        ConfigProvider $configProvider,
        PriceCurrencyInterface $priceCurrency
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->configProvider = $configProvider;
        $this->priceCurrency = $priceCurrency;
    }

    /**
     * Calculate progress data for free shipping bar
     *
     * @return array
     */
    public function calculate(): array
    {
        $threshold = $this->configProvider->getThreshold();
        /** @var \Magento\Quote\Model\Quote|null $quote */
        $quote = $this->checkoutSession->getQuote();

        // Get cart subtotal
        $currentSubtotal = 0.0;
        if ($quote && $quote->getId()) {
            if ($this->configProvider->isIncludeTax()) {
                $currentSubtotal = (float) $quote->getShippingAddress()->getSubtotalInclTax();
                if ($currentSubtotal <= 0) {
                    $currentSubtotal = (float) $quote->getGrandTotal();
                }
            } else {
                $currentSubtotal = (float) $quote->getSubtotal();
            }
        }

        // Calculate progress
        $remaining = max(0, $threshold - $currentSubtotal);
        $percentage = $threshold > 0 ? min(100, ($currentSubtotal / $threshold) * 100) : 0;
        $achieved = $currentSubtotal >= $threshold && $threshold > 0;
        $isEmpty = $currentSubtotal <= 0;

        // Generate message
        $message = $this->generateMessage($remaining, $threshold, $currentSubtotal, $percentage, $achieved, $isEmpty);

        return [
            'current' => $currentSubtotal,
            'currentFormatted' => $this->formatPrice($currentSubtotal),
            'threshold' => $threshold,
            'thresholdFormatted' => $this->formatPrice($threshold),
            'remaining' => $remaining,
            'remainingFormatted' => $this->formatPrice($remaining),
            'percentage' => round($percentage, 0),
            'achieved' => $achieved,
            'isEmpty' => $isEmpty,
            'message' => $message,
        ];
    }

    /**
     * Generate appropriate message based on cart state
     *
     * @param float $remaining
     * @param float $threshold
     * @param float $current
     * @param float $percentage
     * @param bool $achieved
     * @param bool $isEmpty
     * @return string
     */
    private function generateMessage(
        float $remaining,
        float $threshold,
        float $current,
        float $percentage,
        bool $achieved,
        bool $isEmpty
    ): string {
        if ($isEmpty) {
            $template = $this->configProvider->getEmptyCartMessage();
        } elseif ($achieved) {
            $template = $this->configProvider->getAchievedMessage();
        } else {
            $template = $this->configProvider->getProgressMessage();
        }

        // Replace placeholders
        $replacements = [
            '{{remaining}}' => $this->formatPrice($remaining),
            '{{threshold}}' => $this->formatPrice($threshold),
            '{{current}}' => $this->formatPrice($current),
            '{{percentage}}' => round($percentage, 0) . '%',
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $template);
    }

    /**
     * Format price with currency symbol
     *
     * @param float $amount
     * @return string
     */
    private function formatPrice(float $amount): string
    {
        return $this->priceCurrency->format($amount, false);
    }
}
