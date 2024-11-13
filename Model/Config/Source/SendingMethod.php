<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class SendingMethod implements OptionSourceInterface
{
    private const SENDING_METHOD_LABEL = [
        'parcel_locker' => 'sent in an automatic parcel station',
        'pok' => 'sent in the Customer Service Point',
        'courier_pok' => 'sent in the Customer Service Point handling shipping of courier shipments',
        'branch' => 'sent in a Branch',
        'dispatch_order' => 'Collection order - courier order',
        'pop' => 'sent in the Shipment Service Point',
    ];

    /**
     * @inheritdoc
     */
    public function toOptionArray() : array
    {
        $sendingMethods = [];

        foreach (self::SENDING_METHOD_LABEL as $key => $value) {
            $sendingMethods[] = ['value' => $key, 'label' => __($value)];
        }
        return $sendingMethods;
    }

    /**
     * Get the label for a sending method.
     *
     * @param string $sendingMethod
     * @return string
     */
    public function getSendingMethodLabel(string $sendingMethod)
    {
        return self::SENDING_METHOD_LABEL[$sendingMethod] ?? $sendingMethod;
    }
}
