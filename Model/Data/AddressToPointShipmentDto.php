<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smartcore\InPostInternational\Model\InPostShipment as ShipmentModel;
use Smartcore\InPostInternational\Model\InPostShipmentFactory;
use Smartcore\InPostInternational\Model\PickupAddressRepository;

class AddressToPointShipmentDto extends ShipmentTypeDto implements ShipmentTypeInterface
{
    public const ADDRESS_TO_POINT = 'address-to-point';
    public const LABEL = 'From address (courier pickup)';

    /**
     * AddressToPointShipmentDto constructor.
     *
     * @param InPostShipmentFactory $shipmentFactory
     * @param AbstractDtoBuilder $abstractDtoBuilder
     * @param PickupAddressRepository $pickupAddrRepository
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     */
    public function __construct(
        readonly InPostShipmentFactory $shipmentFactory,
        private readonly AbstractDtoBuilder       $abstractDtoBuilder,
        private readonly PickupAddressRepository  $pickupAddrRepository,
        Context                  $context,
        Registry                 $registry,
        ?AbstractResource        $resource = null,
        ?AbstractDb              $resourceCollection = null
    ) {
        parent::__construct($shipmentFactory, $context, $registry, $resource, $resourceCollection);
    }

    /**
     * Get API endpoint for shipment type
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return self::ADDRESS_TO_POINT;
    }

    /**
     * Get the label for the shipment type
     *
     * @return string
     */
    public function getLabel(): string
    {
        return self::LABEL;
    }

    /**
     * Convert the DTO to a database model
     *
     * @return ShipmentModel
     */
    public function toDbModel(): ShipmentModel
    {
        $shipmentDbModel = parent::toDbModel();
        $shipment = $this->getShipment();
        $originAddress = $shipment->getOrigin()->getAddress();

        $shipmentDbModel->setOriginHouseNumber($originAddress->getHouseNumber())
            ->setOriginFlatNumber($originAddress->getFlatNumber())
            ->setOriginStreet($originAddress->getStreet())
            ->setOriginCity($originAddress->getCity())
            ->setOriginPostalCode($originAddress->getPostalCode())
            ->setOriginCountryCode($originAddress->getCountryCode());

        return $shipmentDbModel;
    }

    /**
     * Create origin object
     *
     * @param array<string,mixed> $shipmentFieldsetData
     * @return OriginDto
     */
    public function createOrigin(array $shipmentFieldsetData): OriginDto
    {
        $pickupAddress = $this->pickupAddrRepository->load((int) $shipmentFieldsetData['origin']);

        /** @var AddressDto $address */
        $address = $this->abstractDtoBuilder->buildDtoInstance(AddressDto::class);
        $address->setHouseNumber($pickupAddress->getAddressHouseNumber())
            ->setFlatNumber($pickupAddress->getAddressFlatNumber())
            ->setStreet($pickupAddress->getAddressStreet())
            ->setCity($pickupAddress->getAddressCity())
            ->setPostalCode($pickupAddress->getAddressPostalCode())
            ->setCountryCode($pickupAddress->getAddressCountryCode());

        /** @var OriginDto $origin */
        $origin = $this->abstractDtoBuilder->buildDtoInstance(OriginDto::class);
        $origin->setAddress($address);
        return $origin;
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
