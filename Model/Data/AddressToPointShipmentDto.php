<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smartcore\InPostInternational\Model\Shipment as ShipmentModel;
use Smartcore\InPostInternational\Model\ShipmentFactory;

class AddressToPointShipmentDto extends AbstractDto implements ShipmentTypeInterface
{

    /**
     * AddressToPointShipmentDto constructor.
     *
     * @param ShipmentFactory $shipmentFactory
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        private readonly ShipmentFactory $shipmentFactory,
        Context                  $context,
        Registry                 $registry,
        ?AbstractResource        $resource = null,
        ?AbstractDb              $resourceCollection = null,
        array                            $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Get API endpoint for shipment type
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return 'address-to-point';
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
        $originAddress = $shipment->getOrigin()->getAddress();
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

            ->setOriginHouseNumber($originAddress->getHouseNumber())
            ->setOriginFlatNumber($originAddress->getFlatNumber())
            ->setOriginStreet($originAddress->getStreet())
            ->setOriginCity($originAddress->getCity())
            ->setOriginPostalCode($originAddress->getPostalCode())
            ->setOriginCountryCode($originAddress->getCountryCode())

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

    /**
     * Get the label format for the shipment
     *
     * @return string
     */
    public function getLabelFormat(): string
    {
        return $this->getData(self::LABEL_FORMAT);
    }

    /**
     * Set the label format for the shipment
     *
     * @param string $labelFormat
     * @return $this
     */
    public function setLabelFormat(string $labelFormat): self
    {
        $this->setData(self::LABEL_FORMAT, $labelFormat);
        return $this;
    }

    /**
     * Get the shipment details for address-to-point delivery
     *
     * @return ShipmentDto
     */
    public function getShipment(): ShipmentDto
    {
        return $this->getData(self::SHIPMENT);
    }

    /**
     * Set the shipment details for address-to-point delivery
     *
     * @param ShipmentDto $shipment
     * @return $this
     */
    public function setShipment(ShipmentDto $shipment): self
    {
        $this->setData(self::SHIPMENT, $shipment);
        return $this;
    }
}
