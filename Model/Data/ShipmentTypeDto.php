<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smartcore\InPostInternational\Model\InPostShipment as ShipmentModel;
use Smartcore\InPostInternational\Model\InPostShipmentFactory;

class ShipmentTypeDto extends AbstractDto
{
    /**
     * ShipmentTypeDto constructor.
     *
     * @param InPostShipmentFactory $shipmentFactory
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     */
    public function __construct(
        private readonly InPostShipmentFactory $shipmentFactory,
        Context                          $context,
        Registry                         $registry,
        AbstractResource                 $resource = null,
        AbstractDb                       $resourceCollection = null
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection);
    }

    /**
     * Convert the DTO to a database model
     *
     * @return ShipmentModel
     */
    public function toDbModel(): ShipmentModel
    {
        $shipment = $this->getShipment();
        $sender = $shipment->getSender();
        $recipient = $shipment->getRecipient();
        $destination = $shipment->getDestination();
        $insurance = $shipment->getValueAddedServices()->getInsurance();
        $customReferences = json_encode($shipment->getReferences()?->getCustom());
        $parcel = $shipment->getParcel();
        $dimensions = $parcel->getDimensions();

        /** @var ShipmentModel $shipmentDbModel */
        $shipmentDbModel = $this->shipmentFactory->create();
        $shipmentDbModel
            ->setLabelFormat($this->getLabelFormat())
            ->setShipmentType($this->getEndpoint())
            ->setSenderCompanyName($sender->getCompanyName())
            ->setSenderFirstName($sender->getFirstName())
            ->setSenderLastName($sender->getLastName())
            ->setSenderEmail($sender->getEmail())
            ->setSenderPhonePrefix($sender->getPhone()->getPrefix())
            ->setSenderPhoneNumber($sender->getPhone()->getNumber())
            ->setSenderLanguageCode($sender->getLanguageCode())

            ->setRecipientFirstName($recipient->getFirstName())
            ->setRecipientLastName($recipient->getLastName())
            ->setRecipientCompanyName($recipient->getCompanyName())
            ->setRecipientEmail($recipient->getEmail())
            ->setRecipientPhonePrefix($recipient->getPhone()->getPrefix())
            ->setRecipientPhoneNumber($recipient->getPhone()->getNumber())
            ->setRecipientLanguageCode($recipient->getLanguageCode())

            ->setDestinationCountryCode($destination->getCountryCode())
            ->setDestinationPointName($destination->getPointName())

            ->setPriority($shipment->getPriority())

            ->setInsuranceValue($insurance->getValue())
            ->setInsuranceCurrency($insurance->getCurrency())

            ->setReferences($customReferences)
            ->setParcelType($parcel->getType())
            ->setParcelLength($dimensions->getLength())
            ->setParcelWidth($dimensions->getWidth())
            ->setParcelHeight($dimensions->getHeight())
            ->setParcelDimensionsUnit($dimensions->getUnit())
            ->setParcelWeight($parcel->getWeight()->getAmount())
            ->setParcelWeightUnit($parcel->getWeight()->getUnit())
            ->setParcelLabelComment($parcel->getLabel()->getComment())
            ->setParcelLabelBarcode($parcel->getLabel()->getBarcode());

        return $shipmentDbModel;
    }
}
