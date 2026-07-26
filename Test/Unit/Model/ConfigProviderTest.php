<?php
/**
 * SomePlus Free Shipping Bar ConfigProvider Test
 *
 * @category  SomePlus
 * @package   SomePlus_FreeShippingBar
 */

declare(strict_types=1);

namespace SomePlus\FreeShippingBar\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SomePlus\FreeShippingBar\Model\ConfigProvider;

class ConfigProviderTest extends TestCase
{
    /**
     * @var ConfigProvider
     */
    private ConfigProvider $configProvider;

    /**
     * @var MockObject&ScopeConfigInterface
     */
    private MockObject $scopeConfigMock;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        $this->configProvider = new ConfigProvider($this->scopeConfigMock);
    }

    /**
     * Test isEnabled returns true
     */
    public function testIsEnabledReturnsTrue(): void
    {
        $this->scopeConfigMock->expects($this->once())
            ->method('isSetFlag')
            ->with('someplus_freeshippingbar/general/enabled', 'store', null)
            ->willReturn(true);

        $this->assertTrue($this->configProvider->isEnabled());
    }

    /**
     * Test getThreshold returns float amount
     */
    public function testGetThreshold(): void
    {
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with('someplus_freeshippingbar/general/threshold', 'store', null)
            ->willReturn('150.00');

        $this->assertEquals(150.0, $this->configProvider->getThreshold());
    }

    /**
     * Test getDesignSettings returns array of colors
     */
    public function testGetDesignSettings(): void
    {
        $this->scopeConfigMock->method('getValue')
            ->willReturn('#10b981');

        $settings = $this->configProvider->getDesignSettings();

        $this->assertIsArray($settings);
        $this->assertArrayHasKey('barColor', $settings);
        $this->assertArrayHasKey('bgColor', $settings);
        $this->assertArrayHasKey('textColor', $settings);
        $this->assertArrayHasKey('achievedColor', $settings);
    }
}
