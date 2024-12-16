<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smartcore\InPostInternational\Model\ConfigProvider;
use Smartcore\InPostInternational\Model\Shipment as ShipmentModel;
use Smartcore\InPostInternational\Model\ShipmentFactory;

class PointToPointShipmentDto extends ShipmentTypeDto implements ShipmentTypeInterface
{
    public const string POINT_TO_POINT = 'point-to-point';
    public const string LABEL = 'From point (Locker, Pick-up Drop-off Point, other)';

    /**
     * PointToPointShipmentDto constructor.
     *
     * @param ShipmentFactory $shipmentFactory
     * @param AbstractDtoBuilder $abstractDtoBuilder
     * @param ConfigProvider $configProvider
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     */
    public function __construct(
        readonly ShipmentFactory $shipmentFactory,
        private readonly AbstractDtoBuilder       $abstractDtoBuilder,
        private readonly ConfigProvider           $configProvider,
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
        return self::POINT_TO_POINT;
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
        $origin = $shipment->getOrigin();

        $shipmentDbModel->setOriginCountryCode($origin->getCountryCode())
            ->setOriginShippingMethods(json_encode($origin->getShippingMethods()));

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
        $senderSettings = $this->configProvider->getSenderSettings();
        /** @var OriginDto $origin */
        $origin = $this->abstractDtoBuilder->buildDtoInstance(OriginDto::class);
        $origin->setCountryCode($senderSettings['origin_country_code'])
            ->setShippingMethods(['APM', 'PUDO', 'HUB']);
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
