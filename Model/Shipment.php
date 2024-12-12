<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Magento\Framework\Model\AbstractModel;
use Smartcore\InPostInternational\Api\Data\ShipmentInterface;
use Smartcore\InPostInternational\Model\ResourceModel\Shipment as ShipmentResourceModel;

/**
 * @SuppressWarnings(PHPMD)
 */
class Shipment extends AbstractModel implements ShipmentInterface
{
    /**
     * @var int|null
     */
    protected ?int $orderId = null;
    /**
     * @var string
     */
    protected string $shipmentType;
    /**
     * @var string|null
     */
    protected ?string $labelFormat = null;
    /**
     * @var string|null
     */
    protected ?string $senderCompanyName = null;
    /**
     * @var string
     */
    protected string $senderFirstName;
    /**
     * @var string
     */
    protected string $senderLastName;
    /**
     * @var string
     */
    protected string $senderEmail;
    /**
     * @var string
     */
    protected string $senderPhonePrefix;
    /**
     * @var string
     */
    protected string $senderPhoneNumber;
    /**
     * @var string|null
     */
    protected ?string $senderLanguageCode = null;
    /**
     * @var string|null
     */
    protected ?string $recipientCompanyName = null;
    /**
     * @var string
     */
    protected string $recipientFirstName;
    /**
     * @var string
     */
    protected string $recipientLastName;
    /**
     * @var string
     */
    protected string $recipientEmail;
    /**
     * @var string
     */
    protected string $recipientPhonePrefix;
    /**
     * @var string
     */
    protected string $recipientPhoneNumber;
    /**
     * @var string|null
     */
    protected ?string $recipientLanguageCode = null;
    /**
     * @var string
     */
    protected string $originHouseNumber;
    /**
     * @var string|null
     */
    protected ?string $originFlatNumber = null;
    /**
     * @var string
     */
    protected string $originStreet;
    /**
     * @var string
     */
    protected string $originCity;
    /**
     * @var string
     */
    protected string $originPostalCode;
    /**
     * @var string
     */
    protected string $originCountryCode;
    /**
     * @var string
     */
    protected string $destinationCountryCode;
    /**
     * @var string
     */
    protected string $destinationPointName;
    /**
     * @var string
     */
    protected string $priority;
    /**
     * @var float|null
     */
    protected ?float $insuranceValue = null;
    /**
     * @var string
     */
    protected string $insuranceCurrency;
    /**
     * @var string|null
     */
    protected ?string $references;
    /**
     * @var string
     */
    protected string $parcelType;
    /**
     * @var float
     */
    protected float $parcelLength;
    /**
     * @var float
     */
    protected float $parcelWidth;
    /**
     * @var float
     */
    protected float $parcelHeight;
    /**
     * @var string
     */
    protected string $parcelDimensionsUnit;
    /**
     * @var float
     */
    protected float $parcelWeight;
    /**
     * @var string
     */
    protected string $parcelWeightUnit;
    /**
     * @var string
     */
    protected string $parcelLabelComment;
    /**
     * @var string
     */
    protected string $parcelLabelBarcode;
    /**
     * @var string|null
     */
    protected ?string $labelUrl = null;
    /**
     * @var string|null
     */
    protected ?string $uuid = null;
    /**
     * @var string|null
     */
    protected ?string $trackingNumber = null;
    /**
     * @var string|null
     */
    protected ?string $parcelUuid = null;
    /**
     * @var string|null
     */
    protected ?string $parcelNumbers = null;
    /**
     * @var string|null
     */
    protected ?string $routingDeliveryArea = null;
    /**
     * @var string|null
     */
    protected ?string $routingDeliveryDepotNumber = null;
    /**
     * @var string
     */
    protected string $createdAt;
    /**
     * @var string
     */
    protected string $updatedAt;
    /**
     * @var string|null
     */
    private ?string $parcelStatus;

    /**
     * Shipment constructor.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ShipmentResourceModel::class);
    }

    /**
     * Get the order ID associated with the shipment
     *
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * Set the order ID associated with the shipment
     *
     * @param int|null $orderId
     * @return $this
     */
    public function setOrderId(?int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * Get the type of shipment
     *
     * @return string
     */
    public function getShipmentType(): string
    {
        return $this->shipmentType;
    }

    /**
     * Set the type of shipment
     *
     * @param string $shipmentType
     * @return $this
     */
    public function setShipmentType(string $shipmentType): self
    {
        $this->shipmentType = $shipmentType;
        return $this;
    }

    /**
     * Get the label format
     *
     * @return string|null
     */
    public function getLabelFormat(): ?string
    {
        return $this->labelFormat;
    }

    /**
     * Set the label format
     *
     * @param string|null $labelFormat
     * @return $this
     */
    public function setLabelFormat(?string $labelFormat): self
    {
        $this->labelFormat = $labelFormat;
        return $this;
    }

    /**
     * Get the company name of the sender
     *
     * @return string|null
     */
    public function getSenderCompanyName(): ?string
    {
        return $this->senderCompanyName;
    }

    /**
     * Set the company name of the sender
     *
     * @param string|null $senderCompanyName
     * @return $this
     */
    public function setSenderCompanyName(?string $senderCompanyName): self
    {
        $this->senderCompanyName = $senderCompanyName;
        return $this;
    }

    /**
     * Get the first name of the sender
     *
     * @return string
     */
    public function getSenderFirstName(): string
    {
        return $this->senderFirstName;
    }

    /**
     * Set the first name of the sender
     *
     * @param string $senderFirstName
     * @return $this
     */
    public function setSenderFirstName(string $senderFirstName): self
    {
        $this->senderFirstName = $senderFirstName;
        return $this;
    }

    /**
     * Get the last name of the sender
     *
     * @return string
     */
    public function getSenderLastName(): string
    {
        return $this->senderLastName;
    }

    /**
     * Set the last name of the sender
     *
     * @param string $senderLastName
     * @return $this
     */
    public function setSenderLastName(string $senderLastName): self
    {
        $this->senderLastName = $senderLastName;
        return $this;
    }

    /**
     * Get the email address of the sender
     *
     * @return string
     */
    public function getSenderEmail(): string
    {
        return $this->senderEmail;
    }

    /**
     * Set the email address of the sender
     *
     * @param string $senderEmail
     * @return $this
     */
    public function setSenderEmail(string $senderEmail): self
    {
        $this->senderEmail = $senderEmail;
        return $this;
    }

    /**
     * Get the phone prefix of the sender
     *
     * @return string
     */
    public function getSenderPhonePrefix(): string
    {
        return $this->senderPhonePrefix;
    }

    /**
     * Set the phone prefix of the sender
     *
     * @param string $senderPhonePrefix
     * @return $this
     */
    public function setSenderPhonePrefix(string $senderPhonePrefix): self
    {
        $this->senderPhonePrefix = $senderPhonePrefix;
        return $this;
    }

    /**
     * Get the phone number of the sender
     *
     * @return string
     */
    public function getSenderPhoneNumber(): string
    {
        return $this->senderPhoneNumber;
    }

    /**
     * Set the phone number of the sender
     *
     * @param string $senderPhoneNumber
     * @return $this
     */
    public function setSenderPhoneNumber(string $senderPhoneNumber): self
    {
        $this->senderPhoneNumber = $senderPhoneNumber;
        return $this;
    }

    /**
     * Get the language code of the sender
     *
     * @return string|null
     */
    public function getSenderLanguageCode(): ?string
    {
        return $this->senderLanguageCode;
    }

    /**
     * Set the language code of the sender
     *
     * @param string|null $senderLanguageCode
     * @return $this
     */
    public function setSenderLanguageCode(?string $senderLanguageCode): self
    {
        $this->senderLanguageCode = $senderLanguageCode;
        return $this;
    }

    /**
     * Get the company name of the recipient
     *
     * @return string|null
     */
    public function getRecipientCompanyName(): ?string
    {
        return $this->recipientCompanyName;
    }

    /**
     * Set the company name of the recipient
     *
     * @param string|null $recipientCompanyName
     * @return $this
     */
    public function setRecipientCompanyName(?string $recipientCompanyName): self
    {
        $this->recipientCompanyName = $recipientCompanyName;
        return $this;
    }

    /**
     * Get the first name of the recipient
     *
     * @return string
     */
    public function getRecipientFirstName(): string
    {
        return $this->recipientFirstName;
    }

    /**
     * Set the first name of the recipient
     *
     * @param string $recipientFirstName
     * @return $this
     */
    public function setRecipientFirstName(string $recipientFirstName): self
    {
        $this->recipientFirstName = $recipientFirstName;
        return $this;
    }

    /**
     * Get the last name of the recipient
     *
     * @return string
     */
    public function getRecipientLastName(): string
    {
        return $this->recipientLastName;
    }

    /**
     * Set the last name of the recipient
     *
     * @param string $recipientLastName
     * @return $this
     */
    public function setRecipientLastName(string $recipientLastName): self
    {
        $this->recipientLastName = $recipientLastName;
        return $this;
    }

    /**
     * Get the email address of the recipient
     *
     * @return string
     */
    public function getRecipientEmail(): string
    {
        return $this->recipientEmail;
    }

    /**
     * Set the email address of the recipient
     *
     * @param string $recipientEmail
     * @return $this
     */
    public function setRecipientEmail(string $recipientEmail): self
    {
        $this->recipientEmail = $recipientEmail;
        return $this;
    }

    /**
     * Get the phone prefix of the recipient
     *
     * @return string
     */
    public function getRecipientPhonePrefix(): string
    {
        return $this->recipientPhonePrefix;
    }

    /**
     * Set the phone prefix of the recipient
     *
     * @param string $recipientPhonePrefix
     * @return $this
     */
    public function setRecipientPhonePrefix(string $recipientPhonePrefix): self
    {
        $this->recipientPhonePrefix = $recipientPhonePrefix;
        return $this;
    }

    /**
     * Get the phone number of the recipient
     *
     * @return string
     */
    public function getRecipientPhoneNumber(): string
    {
        return $this->recipientPhoneNumber;
    }

    /**
     * Set the phone number of the recipient
     *
     * @param string $recipientPhoneNumber
     * @return $this
     */
    public function setRecipientPhoneNumber(string $recipientPhoneNumber): self
    {
        $this->recipientPhoneNumber = $recipientPhoneNumber;
        return $this;
    }

    /**
     * Get the language code of the recipient
     *
     * @return string|null
     */
    public function getRecipientLanguageCode(): ?string
    {
        return $this->recipientLanguageCode;
    }

    /**
     * Set the language code of the recipient
     *
     * @param string|null $recipientLangCode
     * @return $this
     */
    public function setRecipientLanguageCode(?string $recipientLangCode): self
    {
        $this->recipientLanguageCode = $recipientLangCode;
        return $this;
    }

    /**
     * Get the house number of the origin address
     *
     * @return string
     */
    public function getOriginHouseNumber(): string
    {
        return $this->originHouseNumber;
    }

    /**
     * Set the house number of the origin address
     *
     * @param string $originHouseNumber
     * @return $this
     */
    public function setOriginHouseNumber(string $originHouseNumber): self
    {
        $this->originHouseNumber = $originHouseNumber;
        return $this;
    }

    /**
     * Get the flat number of the origin address
     *
     * @return string|null
     */
    public function getOriginFlatNumber(): ?string
    {
        return $this->originFlatNumber;
    }

    /**
     * Set the flat number of the origin address
     *
     * @param string|null $originFlatNumber
     * @return $this
     */
    public function setOriginFlatNumber(?string $originFlatNumber): self
    {
        $this->originFlatNumber = $originFlatNumber;
        return $this;
    }

    /**
     * Get the street name of the origin address
     *
     * @return string
     */
    public function getOriginStreet(): string
    {
        return $this->originStreet;
    }

    /**
     * Set the street name of the origin address
     *
     * @param string $originStreet
     * @return $this
     */
    public function setOriginStreet(string $originStreet): self
    {
        $this->originStreet = $originStreet;
        return $this;
    }

    /**
     * Get the city of the origin address
     *
     * @return string
     */
    public function getOriginCity(): string
    {
        return $this->originCity;
    }

    /**
     * Set the city of the origin address
     *
     * @param string $originCity
     * @return $this
     */
    public function setOriginCity(string $originCity): self
    {
        $this->originCity = $originCity;
        return $this;
    }

    /**
     * Get the postal code of the origin address
     *
     * @return string
     */
    public function getOriginPostalCode(): string
    {
        return $this->originPostalCode;
    }

    /**
     * Set the postal code of the origin address
     *
     * @param string $originPostalCode
     * @return $this
     */
    public function setOriginPostalCode(string $originPostalCode): self
    {
        $this->originPostalCode = $originPostalCode;
        return $this;
    }

    /**
     * Get the ISO country code of the origin
     *
     * @return string
     */
    public function getOriginCountryCode(): string
    {
        return $this->originCountryCode;
    }

    /**
     * Set the ISO country code of the origin
     *
     * @param string $originCountryCode
     * @return $this
     */
    public function setOriginCountryCode(string $originCountryCode): self
    {
        $this->originCountryCode = $originCountryCode;
        return $this;
    }

    /**
     * Get the ISO country code of the destination
     *
     * @return string
     */
    public function getDestinationCountryCode(): string
    {
        return $this->destinationCountryCode;
    }

    /**
     * Set the ISO country code of the destination
     *
     * @param string $destCountryCode
     * @return $this
     */
    public function setDestinationCountryCode(string $destCountryCode): self
    {
        $this->destinationCountryCode = $destCountryCode;
        return $this;
    }

    /**
     * Get the name of the destination point
     *
     * @return string
     */
    public function getDestinationPointName(): string
    {
        return $this->destinationPointName;
    }

    /**
     * Set the name of the destination point
     *
     * @param string $destinationPointName
     * @return $this
     */
    public function setDestinationPointName(string $destinationPointName): self
    {
        $this->destinationPointName = $destinationPointName;
        return $this;
    }

    /**
     * Get the priority level of the shipment
     *
     * @return string
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    /**
     * Set the priority level of the shipment
     *
     * @param string $priority
     * @return $this
     */
    public function setPriority(string $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * Get the insurance value of the shipment
     *
     * @return float|null
     */
    public function getInsuranceValue(): ?float
    {
        return $this->insuranceValue;
    }

    /**
     * Set the insurance value of the shipment
     *
     * @param float|null $insuranceValue
     * @return $this
     */
    public function setInsuranceValue(?float $insuranceValue): self
    {
        $this->insuranceValue = $insuranceValue;
        return $this;
    }

    /**
     * Get the currency of the insurance value
     *
     * @return string
     */
    public function getInsuranceCurrency(): string
    {
        return $this->insuranceCurrency;
    }

    /**
     * Set the currency of the insurance value
     *
     * @param string $insuranceCurrency
     * @return $this
     */
    public function setInsuranceCurrency(string $insuranceCurrency): self
    {
        $this->insuranceCurrency = $insuranceCurrency;
        return $this;
    }

    /**
     * Get the references associated with the shipment
     *
     * @return string|null
     */
    public function getReferences(): ?string
    {
        return $this->references;
    }

    /**
     * Set the references associated with the shipment
     *
     * @param string|null $references
     * @return $this
     */
    public function setReferences(?string $references): self
    {
        $this->references = $references;
        return $this;
    }

    /**
     * Get the type of parcel
     *
     * @return string
     */
    public function getParcelType(): string
    {
        return $this->parcelType;
    }

    /**
     * Set the type of parcel
     *
     * @param string $parcelType
     * @return $this
     */
    public function setParcelType(string $parcelType): self
    {
        $this->parcelType = $parcelType;
        return $this;
    }

    /**
     * Get the length of the parcel
     *
     * @return float
     */
    public function getParcelLength(): float
    {
        return $this->parcelLength;
    }

    /**
     * Set the length of the parcel
     *
     * @param float $parcelLength
     * @return $this
     */
    public function setParcelLength(float $parcelLength): self
    {
        $this->parcelLength = $parcelLength;
        return $this;
    }

    /**
     * Get the width of the parcel
     *
     * @return float
     */
    public function getParcelWidth(): float
    {
        return $this->parcelWidth;
    }

    /**
     * Set the width of the parcel
     *
     * @param float $parcelWidth
     * @return $this
     */
    public function setParcelWidth(float $parcelWidth): self
    {
        $this->parcelWidth = $parcelWidth;
        return $this;
    }

    /**
     * Get the height of the parcel
     *
     * @return float
     */
    public function getParcelHeight(): float
    {
        return $this->parcelHeight;
    }

    /**
     * Set the height of the parcel
     *
     * @param float $parcelHeight
     * @return $this
     */
    public function setParcelHeight(float $parcelHeight): self
    {
        $this->parcelHeight = $parcelHeight;
        return $this;
    }

    /**
     * Get the unit of the parcel dimensions
     *
     * @return string
     */
    public function getParcelDimensionsUnit(): string
    {
        return $this->parcelDimensionsUnit;
    }

    /**
     * Set the unit of the parcel dimensions
     *
     * @param string $parcelDimensionsUnit
     * @return $this
     */
    public function setParcelDimensionsUnit(string $parcelDimensionsUnit): self
    {
        $this->parcelDimensionsUnit = $parcelDimensionsUnit;
        return $this;
    }

    /**
     * Get the weight of the parcel
     *
     * @return float
     */
    public function getParcelWeight(): float
    {
        return $this->parcelWeight;
    }

    /**
     * Set the weight of the parcel
     *
     * @param float $parcelWeight
     * @return $this
     */
    public function setParcelWeight(float $parcelWeight): self
    {
        $this->parcelWeight = $parcelWeight;
        return $this;
    }

    /**
     * Get the unit of the parcel weight
     *
     * @return string
     */
    public function getParcelWeightUnit(): string
    {
        return $this->parcelWeightUnit;
    }

    /**
     * Set the unit of the parcel weight
     *
     * @param string $parcelWeightUnit
     * @return $this
     */
    public function setParcelWeightUnit(string $parcelWeightUnit): self
    {
        $this->parcelWeightUnit = $parcelWeightUnit;
        return $this;
    }

    /**
     * Get the comment on the parcel label
     *
     * @return string
     */
    public function getParcelLabelComment(): string
    {
        return $this->parcelLabelComment;
    }

    /**
     * Set the comment on the parcel label
     *
     * @param string $parcelLabelComment
     * @return $this
     */
    public function setParcelLabelComment(string $parcelLabelComment): self
    {
        $this->parcelLabelComment = $parcelLabelComment;
        return $this;
    }

    /**
     * Get the barcode associated with the parcel label
     *
     * @return string
     */
    public function getParcelLabelBarcode(): string
    {
        return $this->parcelLabelBarcode;
    }

    /**
     * Set the barcode associated with the parcel label
     *
     * @param string $parcelLabelBarcode
     * @return $this
     */
    public function setParcelLabelBarcode(string $parcelLabelBarcode): self
    {
        $this->parcelLabelBarcode = $parcelLabelBarcode;
        return $this;
    }

    /**
     * Get the URL of the label
     *
     * @return string|null
     */
    public function getLabelUrl(): ?string
    {
        return $this->labelUrl;
    }

    /**
     * Set the URL of the label
     *
     * @param string|null $labelUrl
     * @return $this
     */
    public function setLabelUrl(?string $labelUrl): self
    {
        $this->labelUrl = $labelUrl;
        return $this;
    }

    /**
     * Get the UUID of the shipment
     *
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Set the UUID of the shipment
     *
     * @param string|null $uuid
     * @return $this
     */
    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * Get the tracking number of the shipment
     *
     * @return string|null
     */
    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    /**
     * Set the tracking number of the shipment
     *
     * @param string|null $trackingNumber
     * @return $this
     */
    public function setTrackingNumber(?string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * Get the UUID of the parcel
     *
     * @return string|null
     */
    public function getParcelUuid(): ?string
    {
        return $this->parcelUuid;
    }

    /**
     * Set the UUID of the parcel
     *
     * @param string|null $parcelUuid
     * @return $this
     */
    public function setParcelUuid(?string $parcelUuid): self
    {
        $this->parcelUuid = $parcelUuid;
        return $this;
    }

    /**
     * Get the parcel numbers
     *
     * @return string|null
     */
    public function getParcelNumbers(): ?string
    {
        return $this->parcelNumbers;
    }

    /**
     * Set the parcel numbers
     *
     * @param string|null $parcelNumbers
     * @return $this
     */
    public function setParcelNumbers(?string $parcelNumbers): self
    {
        $this->parcelNumbers = $parcelNumbers;
        return $this;
    }

    /**
     * Get the routing delivery area
     *
     * @return string|null
     */
    public function getRoutingDeliveryArea(): ?string
    {
        return $this->routingDeliveryArea;
    }

    /**
     * Set the routing delivery area
     *
     * @param string|null $routingDeliveryArea
     * @return $this
     */
    public function setRoutingDeliveryArea(?string $routingDeliveryArea): self
    {
        $this->routingDeliveryArea = $routingDeliveryArea;
        return $this;
    }

    /**
     * Get the routing delivery depot number
     *
     * @return string|null
     */
    public function getRoutingDeliveryDepotNumber(): ?string
    {
        return $this->routingDeliveryDepotNumber;
    }

    /**
     * Set the routing delivery depot number
     *
     * @param string|null $deliveryDepotNumber
     * @return $this
     */
    public function setRoutingDeliveryDepotNumber(?string $deliveryDepotNumber): self
    {
        $this->routingDeliveryDepotNumber = $deliveryDepotNumber;
        return $this;
    }

    /**
     * Get the creation date of the shipment
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * Set the creation date of the shipment
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get the last update date of the shipment
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * Set the last update date of the shipment
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get the parcel status
     *
     * @return string|null
     */
    public function getParcelStatus(): ?string
    {
        return $this->parcelStatus;
    }

    /**
     * Set the parcel status
     *
     * @param string|null $parcelStatus
     * @return self
     */
    public function setParcelStatus(?string $parcelStatus): self
    {
        $this->parcelStatus = $parcelStatus;
        return $this;
    }
}
