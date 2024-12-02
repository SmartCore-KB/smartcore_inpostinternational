<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DefaultWaySending implements OptionSourceInterface
{
    private const INPOST_LOCKER_STANDARD = 'inpostlocker_standard';
    private const INPOST_LOCKER_STANDARD_COD = 'inpostlocker_standardcod';
    private const INPOST_LOCKER_STANDARD_EOW = 'inpostlocker_standardeow';
    private const INPOST_LOCKER_STANDARD_EOW_COD = 'inpostlocker_standardeowcod';
    private const INPOST_LOCKER_ECONOMIC = 'inpostlocker_economic';
    private const INPOST_LOCKER_ECONOMIC_COD = 'inpostlocker_economiccod';
    private const INPOST_COURIER_C2C = 'inpostcourier_c2c';
    private const INPOST_COURIER_C2C_COD = 'inpostcourier_c2ccod';
    private const INPOST_COURIER_STANDARD = 'inpostcourier_standard';
    private const INPOST_COURIER_STANDARD_COD = 'inpostcourier_standardcod';
    private const INPOST_COURIER_EXPRESS1000 = 'inpostcourier_express1000';
    private const INPOST_COURIER_EXPRESS1200 = 'inpostcourier_express1200';
    private const INPOST_COURIER_EXPRESS1700 = 'inpostcourier_express1700';
    private const INPOST_COURIER_PALETTE = 'inpostcourier_palette';
    private const INPOST_COURIER_ALCOHOL = 'inpostcourier_alcohol';

    /**
     * @var string
     */
    protected $code = '';

    /**
     * DefaultWaySending constructor.
     *
     * @param string|null $code
     */
    public function __construct($code = null)
    {
        $this->code = $code;
    }

    /**
     * Get the sending method options.
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return array|array[]
     */
    public function toOptionArray() : array
    {
        switch ($this->code) {
            case (self::INPOST_LOCKER_STANDARD):
            case (self::INPOST_LOCKER_STANDARD_COD):
                return [
                    ['value' => 'parcel_locker', 'label' => __('Nadanie w Paczkomacie')],
                    ['value' => 'dispatch_order', 'label' => __('Odbiór przez Kuriera')],
                    ['value' => 'pop', 'label' => __('Nadanie w POP')],
                ];
            case (self::INPOST_LOCKER_STANDARD_EOW):
            case (self::INPOST_LOCKER_STANDARD_EOW_COD):
            case (self::INPOST_LOCKER_ECONOMIC):
            case (self::INPOST_LOCKER_ECONOMIC_COD):
                return [
                    ['value' => 'parcel_locker', 'label' => __('Nadanie w Paczkomacie')],
                    ['value' => 'dispatch_order', 'label' => __('Odbiór przez Kuriera')],
                ];
            case (self::INPOST_COURIER_C2C):
            case (self::INPOST_COURIER_C2C_COD):
                return [
                    ['value' => 'dispatch_order', 'label' => __('Odbiór przez kuriera')],
                    ['value' => 'pop', 'label' => __('Nadanie w POP')],
                    ['value' => 'parcel_locker', 'label' => __('Nadanie w paczkomacie')]
                ];
            case (self::INPOST_COURIER_STANDARD):
            case (self::INPOST_COURIER_STANDARD_COD):
            case (self::INPOST_COURIER_EXPRESS1000):
            case (self::INPOST_COURIER_EXPRESS1200):
            case (self::INPOST_COURIER_EXPRESS1700):
            case (self::INPOST_COURIER_ALCOHOL):
                return [
                    ['value' => 'dispatch_order', 'label' => __('Odbiór przez Kuriera')],
                    ['value' => 'pop', 'label' => __('Nadanie w POP')],
                ];
            case (self::INPOST_COURIER_PALETTE):
                return [
                    ['value' => 'dispatch_order', 'label' => __('Odbiór przez Kuriera')]
                ];
            default:
                return [];
        }
    }

    /**
     * Set the code for the sending method.
     *
     * @param string $code
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
}
