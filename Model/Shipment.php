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
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Set the order ID associated with the shipment
     *
     * @param int|null $orderId
     * @return $this
     */
    public function setOrderId(?int $orderId): self
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get the type of shipment
     *
     * @return string
     */
    public function getShipmentType(): string
    {
        return $this->getData(self::SHIPMENT_TYPE);
    }

    /**
     * Set the type of shipment
     *
     * @param string $shipmentType
     * @return $this
     */
    public function setShipmentType(string $shipmentType): self
    {
        return $this->setData(self::SHIPMENT_TYPE, $shipmentType);
    }

    /**
     * Get the label format
     *
     * @return string|null
     */
    public function getLabelFormat(): ?string
    {
        return $this->getData(self::LABEL_FORMAT);
    }

    /**
     * Set the label format
     *
     * @param string|null $labelFormat
     * @return $this
     */
    public function setLabelFormat(?string $labelFormat): self
    {
        return $this->setData(self::LABEL_FORMAT, $labelFormat);
    }

    /**
     * Get the company name of the sender
     *
     * @return string|null
     */
    public function getSenderCompanyName(): ?string
    {
        return $this->getData(self::SENDER_COMPANY_NAME);
    }

    /**
     * Set the company name of the sender
     *
     * @param string|null $senderCompanyName
     * @return $this
     */
    public function setSenderCompanyName(?string $senderCompanyName): self
    {
        return $this->setData(self::SENDER_COMPANY_NAME, $senderCompanyName);
    }

    /**
     * Get the first name of the sender
     *
     * @return string
     */
    public function getSenderFirstName(): string
    {
        return $this->getData(self::SENDER_FIRST_NAME);
    }

    /**
     * Set the first name of the sender
     *
     * @param string $senderFirstName
     * @return $this
     */
    public function setSenderFirstName(string $senderFirstName): self
    {
        return $this->setData(self::SENDER_FIRST_NAME, $senderFirstName);
    }

    /**
     * Get the last name of the sender
     *
     * @return string
     */
    public function getSenderLastName(): string
    {
        return $this->getData(self::SENDER_LAST_NAME);
    }

    /**
     * Set the last name of the sender
     *
     * @param string $senderLastName
     * @return $this
     */
    public function setSenderLastName(string $senderLastName): self
    {
        return $this->setData(self::SENDER_LAST_NAME, $senderLastName);
    }

    /**
     * Get the email address of the sender
     *
     * @return string
     */
    public function getSenderEmail(): string
    {
        return $this->getData(self::SENDER_EMAIL);
    }

    /**
     * Set the email address of the sender
     *
     * @param string $senderEmail
     * @return $this
     */
    public function setSenderEmail(string $senderEmail): self
    {
        return $this->setData(self::SENDER_EMAIL, $senderEmail);
    }

    /**
     * Get the phone prefix of the sender
     *
     * @return string
     */
    public function getSenderPhonePrefix(): string
    {
        return $this->getData(self::SENDER_PHONE_PREFIX);
    }

    /**
     * Set the phone prefix of the sender
     *
     * @param string $senderPhonePrefix
     * @return $this
     */
    public function setSenderPhonePrefix(string $senderPhonePrefix): self
    {
        return $this->setData(self::SENDER_PHONE_PREFIX, $senderPhonePrefix);
    }

    /**
     * Get the phone number of the sender
     *
     * @return string
     */
    public function getSenderPhoneNumber(): string
    {
        return $this->getData(self::SENDER_PHONE_NUMBER);
    }

    /**
     * Set the phone number of the sender
     *
     * @param string $senderPhoneNumber
     * @return $this
     */
    public function setSenderPhoneNumber(string $senderPhoneNumber): self
    {
        return $this->setData(self::SENDER_PHONE_NUMBER, $senderPhoneNumber);
    }

    /**
     * Get the language code of the sender
     *
     * @return string|null
     */
    public function getSenderLanguageCode(): ?string
    {
        return $this->getData(self::SENDER_LANGUAGE_CODE);
    }

    /**
     * Set the language code of the sender
     *
     * @param string|null $senderLanguageCode
     * @return $this
     */
    public function setSenderLanguageCode(?string $senderLanguageCode): self
    {
        return $this->setData(self::SENDER_LANGUAGE_CODE, $senderLanguageCode);
    }

    /**
     * Get the company name of the recipient
     *
     * @return string|null
     */
    public function getRecipientCompanyName(): ?string
    {
        return $this->getData(self::RECIPIENT_COMPANY_NAME);
    }

    /**
     * Set the company name of the recipient
     *
     * @param string|null $recipientCompanyName
     * @return $this
     */
    public function setRecipientCompanyName(?string $recipientCompanyName): self
    {
        return $this->setData(self::RECIPIENT_COMPANY_NAME, $recipientCompanyName);
    }

    /**
     * Get the first name of the recipient
     *
     * @return string
     */
    public function getRecipientFirstName(): string
    {
        return $this->getData(self::RECIPIENT_FIRST_NAME);
    }

    /**
     * Set the first name of the recipient
     *
     * @param string $recipientFirstName
     * @return $this
     */
    public function setRecipientFirstName(string $recipientFirstName): self
    {
        return $this->setData(self::RECIPIENT_FIRST_NAME, $recipientFirstName);
    }

    /**
     * Get the last name of the recipient
     *
     * @return string
     */
    public function getRecipientLastName(): string
    {
        return $this->getData(self::RECIPIENT_LAST_NAME);
    }

    /**
     * Set the last name of the recipient
     *
     * @param string $recipientLastName
     * @return $this
     */
    public function setRecipientLastName(string $recipientLastName): self
    {
        return $this->setData(self::RECIPIENT_LAST_NAME, $recipientLastName);
    }

    /**
     * Get the email address of the recipient
     *
     * @return string
     */
    public function getRecipientEmail(): string
    {
        return $this->getData(self::RECIPIENT_EMAIL);
    }

    /**
     * Set the email address of the recipient
     *
     * @param string $recipientEmail
     * @return $this
     */
    public function setRecipientEmail(string $recipientEmail): self
    {
        return $this->setData(self::RECIPIENT_EMAIL, $recipientEmail);
    }

    /**
     * Get the phone prefix of the recipient
     *
     * @return string
     */
    public function getRecipientPhonePrefix(): string
    {
        return $this->getData(self::RECIPIENT_PHONE_PREFIX);
    }

    /**
     * Set the phone prefix of the recipient
     *
     * @param string $recipientPhonePrefix
     * @return $this
     */
    public function setRecipientPhonePrefix(string $recipientPhonePrefix): self
    {
        return $this->setData(self::RECIPIENT_PHONE_PREFIX, $recipientPhonePrefix);
    }

    /**
     * Get the phone number of the recipient
     *
     * @return string
     */
    public function getRecipientPhoneNumber(): string
    {
        return $this->getData(self::RECIPIENT_PHONE_NUMBER);
    }

    /**
     * Set the phone number of the recipient
     *
     * @param string $recipientPhoneNumber
     * @return $this
     */
    public function setRecipientPhoneNumber(string $recipientPhoneNumber): self
    {
        return $this->setData(self::RECIPIENT_PHONE_NUMBER, $recipientPhoneNumber);
    }

    /**
     * Get the language code of the recipient
     *
     * @return string|null
     */
    public function getRecipientLanguageCode(): ?string
    {
        return $this->getData(self::RECIPIENT_LANGUAGE_CODE);
    }

    /**
     * Set the language code of the recipient
     *
     * @param string|null $recipientLangCode
     * @return $this
     */
    public function setRecipientLanguageCode(?string $recipientLangCode): self
    {
        return $this->setData(self::RECIPIENT_LANGUAGE_CODE, $recipientLangCode);
    }

    /**
     * Get the house number of the origin address
     *
     * @return string
     */
    public function getOriginHouseNumber(): string
    {
        return $this->getData(self::ORIGIN_HOUSE_NUMBER);
    }

    /**
     * Set the house number of the origin address
     *
     * @param string $originHouseNumber
     * @return $this
     */
    public function setOriginHouseNumber(string $originHouseNumber): self
    {
        return $this->setData(self::ORIGIN_HOUSE_NUMBER, $originHouseNumber);
    }

    /**
     * Get the flat number of the origin address
     *
     * @return string|null
     */
    public function getOriginFlatNumber(): ?string
    {
        return $this->getData(self::ORIGIN_FLAT_NUMBER);
    }

    /**
     * Set the flat number of the origin address
     *
     * @param string|null $originFlatNumber
     * @return $this
     */
    public function setOriginFlatNumber(?string $originFlatNumber): self
    {
        return $this->setData(self::ORIGIN_FLAT_NUMBER, $originFlatNumber);
    }

    /**
     * Get the street name of the origin address
     *
     * @return string
     */
    public function getOriginStreet(): string
    {
        return $this->getData(self::ORIGIN_STREET);
    }

    /**
     * Set the street name of the origin address
     *
     * @param string $originStreet
     * @return $this
     */
    public function setOriginStreet(string $originStreet): self
    {
        return $this->setData(self::ORIGIN_STREET, $originStreet);
    }

    /**
     * Get the city of the origin address
     *
     * @return string
     */
    public function getOriginCity(): string
    {
        return $this->getData(self::ORIGIN_CITY);
    }

    /**
     * Set the city of the origin address
     *
     * @param string $originCity
     * @return $this
     */
    public function setOriginCity(string $originCity): self
    {
        return $this->setData(self::ORIGIN_CITY, $originCity);
    }

    /**
     * Get the postal code of the origin address
     *
     * @return string
     */
    public function getOriginPostalCode(): string
    {
        return $this->getData(self::ORIGIN_POSTAL_CODE);
    }

    /**
     * Set the postal code of the origin address
     *
     * @param string $originPostalCode
     * @return $this
     */
    public function setOriginPostalCode(string $originPostalCode): self
    {
        return $this->setData(self::ORIGIN_POSTAL_CODE, $originPostalCode);
    }

    /**
     * Get the ISO country code of the origin
     *
     * @return string
     */
    public function getOriginCountryCode(): string
    {
        return $this->getData(self::ORIGIN_COUNTRY_CODE);
    }

    /**
     * Set the ISO country code of the origin
     *
     * @param string $originCountryCode
     * @return $this
     */
    public function setOriginCountryCode(string $originCountryCode): self
    {
        return $this->setData(self::ORIGIN_COUNTRY_CODE, $originCountryCode);
    }

    /**
     * Get the ISO country code of the destination
     *
     * @return string
     */
    public function getDestinationCountryCode(): string
    {
        return $this->getData(self::DESTINATION_COUNTRY_CODE);
    }

    /**
     * Set the ISO country code of the destination
     *
     * @param string $destCountryCode
     * @return $this
     */
    public function setDestinationCountryCode(string $destCountryCode): self
    {
        return $this->setData(self::DESTINATION_COUNTRY_CODE, $destCountryCode);
    }

    /**
     * Get the name of the destination point
     *
     * @return string
     */
    public function getDestinationPointName(): string
    {
        return $this->getData(self::DESTINATION_POINT_NAME);
    }

    /**
     * Set the name of the destination point
     *
     * @param string $destinationPointName
     * @return $this
     */
    public function setDestinationPointName(string $destinationPointName): self
    {
        return $this->setData(self::DESTINATION_POINT_NAME, $destinationPointName);
    }

    /**
     * Get the priority level of the shipment
     *
     * @return string
     */
    public function getPriority(): string
    {
        return $this->getData(self::PRIORITY);
    }

    /**
     * Set the priority level of the shipment
     *
     * @param string $priority
     * @return $this
     */
    public function setPriority(string $priority): self
    {
        return $this->setData(self::PRIORITY, $priority);
    }

    /**
     * Get the insurance value of the shipment
     *
     * @return float|null
     */
    public function getInsuranceValue(): ?float
    {
        return $this->getData(self::INSURANCE_VALUE);
    }

    /**
     * Set the insurance value of the shipment
     *
     * @param float|null $insuranceValue
     * @return $this
     */
    public function setInsuranceValue(?float $insuranceValue): self
    {
        return $this->setData(self::INSURANCE_VALUE, $insuranceValue);
    }

    /**
     * Get the currency of the insurance value
     *
     * @return string
     */
    public function getInsuranceCurrency(): string
    {
        return $this->getData(self::INSURANCE_CURRENCY);
    }

    /**
     * Set the currency of the insurance value
     *
     * @param string $insuranceCurrency
     * @return $this
     */
    public function setInsuranceCurrency(string $insuranceCurrency): self
    {
        return $this->setData(self::INSURANCE_CURRENCY, $insuranceCurrency);
    }

    /**
     * Get the references associated with the shipment
     *
     * @return string|null
     */
    public function getReferences(): ?string
    {
        return $this->getData(self::REFERENCES);
    }

    /**
     * Set the references associated with the shipment
     *
     * @param string|null $references
     * @return $this
     */
    public function setReferences(?string $references): self
    {
        return $this->setData(self::REFERENCES, $references);
    }

    /**
     * Get the type of parcel
     *
     * @return string
     */
    public function getParcelType(): string
    {
        return $this->getData(self::PARCEL_TYPE);
    }

    /**
     * Set the type of parcel
     *
     * @param string $parcelType
     * @return $this
     */
    public function setParcelType(string $parcelType): self
    {
        return $this->setData(self::PARCEL_TYPE, $parcelType);
    }

    /**
     * Get the length of the parcel
     *
     * @return float
     */
    public function getParcelLength(): float
    {
        return $this->getData(self::PARCEL_LENGTH);
    }

    /**
     * Set the length of the parcel
     *
     * @param float $parcelLength
     * @return $this
     */
    public function setParcelLength(float $parcelLength): self
    {
        return $this->setData(self::PARCEL_LENGTH, $parcelLength);
    }

    /**
     * Get the width of the parcel
     *
     * @return float
     */
    public function getParcelWidth(): float
    {
        return $this->getData(self::PARCEL_WIDTH);
    }

    /**
     * Set the width of the parcel
     *
     * @param float $parcelWidth
     * @return $this
     */
    public function setParcelWidth(float $parcelWidth): self
    {
        return $this->setData(self::PARCEL_WIDTH, $parcelWidth);
    }

    /**
     * Get the height of the parcel
     *
     * @return float
     */
    public function getParcelHeight(): float
    {
        return $this->getData(self::PARCEL_HEIGHT);
    }

    /**
     * Set the height of the parcel
     *
     * @param float $parcelHeight
     * @return $this
     */
    public function setParcelHeight(float $parcelHeight): self
    {
        return $this->setData(self::PARCEL_HEIGHT, $parcelHeight);
    }

    /**
     * Get the unit of the parcel dimensions
     *
     * @return string
     */
    public function getParcelDimensionsUnit(): string
    {
        return $this->getData(self::PARCEL_DIMENSIONS_UNIT);
    }

    /**
     * Set the unit of the parcel dimensions
     *
     * @param string $parcelDimensionsUnit
     * @return $this
     */
    public function setParcelDimensionsUnit(string $parcelDimensionsUnit): self
    {
        return $this->setData(self::PARCEL_DIMENSIONS_UNIT, $parcelDimensionsUnit);
    }

    /**
     * Get the weight of the parcel
     *
     * @return float
     */
    public function getParcelWeight(): float
    {
        return $this->getData(self::PARCEL_WEIGHT);
    }

    /**
     * Set the weight of the parcel
     *
     * @param float $parcelWeight
     * @return $this
     */
    public function setParcelWeight(float $parcelWeight): self
    {
        return $this->setData(self::PARCEL_WEIGHT, $parcelWeight);
    }

    /**
     * Get the unit of the parcel weight
     *
     * @return string
     */
    public function getParcelWeightUnit(): string
    {
        return $this->getData(self::PARCEL_WEIGHT_UNIT);
    }

    /**
     * Set the unit of the parcel weight
     *
     * @param string $parcelWeightUnit
     * @return $this
     */
    public function setParcelWeightUnit(string $parcelWeightUnit): self
    {
        return $this->setData(self::PARCEL_WEIGHT_UNIT, $parcelWeightUnit);
    }

    /**
     * Get the comment on the parcel label
     *
     * @return string
     */
    public function getParcelLabelComment(): string
    {
        return $this->getData(self::PARCEL_LABEL_COMMENT);
    }

    /**
     * Set the comment on the parcel label
     *
     * @param string $parcelLabelComment
     * @return $this
     */
    public function setParcelLabelComment(string $parcelLabelComment): self
    {
        return $this->setData(self::PARCEL_LABEL_COMMENT, $parcelLabelComment);
    }

    /**
     * Get the barcode associated with the parcel label
     *
     * @return string
     */
    public function getParcelLabelBarcode(): string
    {
        return $this->getData(self::PARCEL_LABEL_BARCODE);
    }

    /**
     * Set the barcode associated with the parcel label
     *
     * @param string $parcelLabelBarcode
     * @return $this
     */
    public function setParcelLabelBarcode(string $parcelLabelBarcode): self
    {
        return $this->setData(self::PARCEL_LABEL_BARCODE, $parcelLabelBarcode);
    }

    /**
     * Get the URL of the label
     *
     * @return string|null
     */
    public function getLabelUrl(): ?string
    {
        return $this->getData(self::LABEL_URL);
    }

    /**
     * Set the URL of the label
     *
     * @param string|null $labelUrl
     * @return $this
     */
    public function setLabelUrl(?string $labelUrl): self
    {
        return $this->setData(self::LABEL_URL, $labelUrl);
    }

    /**
     * Get the UUID of the shipment
     *
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->getData(self::UUID);
    }

    /**
     * Set the UUID of the shipment
     *
     * @param string|null $uuid
     * @return $this
     */
    public function setUuid(?string $uuid): self
    {
        return $this->setData(self::UUID, $uuid);
    }

    /**
     * Get the tracking number of the shipment
     *
     * @return string|null
     */
    public function getTrackingNumber(): ?string
    {
        return $this->getData(self::TRACKING_NUMBER);
    }

    /**
     * Set the tracking number of the shipment
     *
     * @param string|null $trackingNumber
     * @return $this
     */
    public function setTrackingNumber(?string $trackingNumber): self
    {
        return $this->setData(self::TRACKING_NUMBER, $trackingNumber);
    }

    /**
     * Get the UUID of the parcel
     *
     * @return string|null
     */
    public function getParcelUuid(): ?string
    {
        return $this->getData(self::PARCEL_UUID);
    }

    /**
     * Set the UUID of the parcel
     *
     * @param string|null $parcelUuid
     * @return $this
     */
    public function setParcelUuid(?string $parcelUuid): self
    {
        return $this->setData(self::PARCEL_UUID, $parcelUuid);
    }

    /**
     * Get the parcel numbers
     *
     * @return string|null
     */
    public function getParcelNumbers(): ?string
    {
        return $this->getData(self::PARCEL_NUMBERS);
    }

    /**
     * Set the parcel numbers
     *
     * @param string|null $parcelNumbers
     * @return $this
     */
    public function setParcelNumbers(?string $parcelNumbers): self
    {
        return $this->setData(self::PARCEL_NUMBERS, $parcelNumbers);
    }

    /**
     * Get the routing delivery area
     *
     * @return string|null
     */
    public function getRoutingDeliveryArea(): ?string
    {
        return $this->getData(self::ROUTING_DELIVERY_AREA);
    }

    /**
     * Set the routing delivery area
     *
     * @param string|null $routingDeliveryArea
     * @return $this
     */
    public function setRoutingDeliveryArea(?string $routingDeliveryArea): self
    {
        return $this->setData(self::ROUTING_DELIVERY_AREA, $routingDeliveryArea);
    }

    /**
     * Get the routing delivery depot number
     *
     * @return string|null
     */
    public function getRoutingDeliveryDepotNumber(): ?string
    {
        return $this->getData(self::ROUTING_DELIVERY_DEPOT_NUMBER);
    }

    /**
     * Set the routing delivery depot number
     *
     * @param string|null $deliveryDepotNumber
     * @return $this
     */
    public function setRoutingDeliveryDepotNumber(?string $deliveryDepotNumber): self
    {
        return $this->setData(self::ROUTING_DELIVERY_DEPOT_NUMBER, $deliveryDepotNumber);
    }

    /**
     * Get the creation date of the shipment
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set the creation date of the shipment
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt): self
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get the last update date of the shipment
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set the last update date of the shipment
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): self
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get the parcel status
     *
     * @return string|null
     */
    public function getParcelStatus(): ?string
    {
        return $this->getData(self::PARCEL_STATUS);
    }

    /**
     * Set the parcel status
     *
     * @param string|null $parcelStatus
     * @return self
     */
    public function setParcelStatus(?string $parcelStatus): self
    {
        return $this->setData(self::PARCEL_STATUS, $parcelStatus);
    }
}
