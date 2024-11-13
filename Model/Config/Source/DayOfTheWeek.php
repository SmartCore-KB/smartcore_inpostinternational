<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DayOfTheWeek implements OptionSourceInterface
{
    private const MONDAY = 1;
    private const TUESDAY = 2;
    private const WEDNESDAY = 3;
    private const THURSDAY = 4;
    private const FRIDAY = 5;
    private const SATURDAY = 6;
    private const SUNDAY = 7;

    /**
     * Get the day of the week as a string.
     *
     * @return array[]
     */
    public function toOptionArray() : array
    {
        return [
            ['value' => self::MONDAY, 'label' => __('Monday')],
            ['value' => self::TUESDAY, 'label' => __('Tuesday')],
            ['value' => self::WEDNESDAY, 'label' => __('Wednesday')],
            ['value' => self::THURSDAY, 'label' => __('Thursday')],
            ['value' => self::FRIDAY, 'label' => __('Friday')],
            ['value' => self::SATURDAY, 'label' => __('Saturday')],
            ['value' => self::SUNDAY, 'label' => __('Sunday')],
        ];
    }
}
