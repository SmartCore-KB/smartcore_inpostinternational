<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class InpostCourier extends TestCase
{
    /**
     * @var \Smartcore\InPostInternational\Model\Carrier\InpostCourier
     */
    private $inpostCourier;

    public function testIsTrackingAvailable()
    {
        $this->assertTrue($this->inpostCourier->isTrackingAvailable());
    }

    public function testGetAllowedMethods()
    {
        $this->assertEquals(
            ['inpostcourier' => $this->inpostCourier->getConfigData('name')],
            $this->inpostCourier->getAllowedMethods()
        );
    }

    protected function setUp(): void
    {
        $this->inpostCourier = new \Smartcore\InPostInternational\Model\Carrier\InpostCourier(
            $this->createMock(ScopeConfigInterface::class),
            $this->createMock(ErrorFactory::class),
            $this->createMock(LoggerInterface::class)
        );
    }
}
