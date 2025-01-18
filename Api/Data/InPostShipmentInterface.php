<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface InPostShipmentInterface
{
    public const ENTITY_ID = 'entity_id';
    public const ORDER_ID = 'order_id';
    public const SHIPMENT_TYPE = 'shipment_type';
    public const LABEL_FORMAT = 'label_format';
    public const SENDER_COMPANY_NAME = 'sender_company_name';
    public const SENDER_FIRST_NAME = 'sender_first_name';
    public const SENDER_LAST_NAME = 'sender_last_name';
    public const SENDER_EMAIL = 'sender_email';
    public const SENDER_PHONE_PREFIX = 'sender_phone_prefix';
    public const SENDER_PHONE_NUMBER = 'sender_phone_number';
    public const SENDER_LANGUAGE_CODE = 'sender_language_code';
    public const RECIPIENT_COMPANY_NAME = 'recipient_company_name';
    public const RECIPIENT_FIRST_NAME = 'recipient_first_name';
    public const RECIPIENT_LAST_NAME = 'recipient_last_name';
    public const RECIPIENT_EMAIL = 'recipient_email';
    public const RECIPIENT_PHONE_PREFIX = 'recipient_phone_prefix';
    public const RECIPIENT_PHONE_NUMBER = 'recipient_phone_number';
    public const RECIPIENT_LANGUAGE_CODE = 'recipient_language_code';
    public const ORIGIN_HOUSE_NUMBER = 'origin_house_number';
    public const ORIGIN_FLAT_NUMBER = 'origin_flat_number';
    public const ORIGIN_STREET = 'origin_street';
    public const ORIGIN_CITY = 'origin_city';
    public const ORIGIN_POSTAL_CODE = 'origin_postal_code';
    public const ORIGIN_COUNTRY_CODE = 'origin_country_code';
    public const ORIGIN_SHIPPING_METHODS = 'origin_shipping_methods';
    public const DESTINATION_COUNTRY_CODE = 'destination_country_code';
    public const DESTINATION_POINT_NAME = 'destination_point_name';
    public const PRIORITY = 'priority';
    public const INSURANCE_VALUE = 'insurance_value';
    public const INSURANCE_CURRENCY = 'insurance_currency';
    public const REFERENCES = 'references';
    public const PARCEL_TYPE = 'parcel_type';
    public const PARCEL_LENGTH = 'parcel_length';
    public const PARCEL_WIDTH = 'parcel_width';
    public const PARCEL_HEIGHT = 'parcel_height';
    public const PARCEL_DIMENSIONS_UNIT = 'parcel_dimensions_unit';
    public const PARCEL_WEIGHT = 'parcel_weight';
    public const PARCEL_WEIGHT_UNIT = 'parcel_weight_unit';
    public const PARCEL_LABEL_COMMENT = 'parcel_label_comment';
    public const PARCEL_LABEL_BARCODE = 'parcel_label_barcode';
    public const LABEL_URL = 'label_url';
    public const UUID = 'uuid';
    public const TRACKING_NUMBER = 'tracking_number';
    public const PARCEL_UUID = 'parcel_uuid';
    public const PARCEL_NUMBERS = 'parcel_numbers';
    public const PARCEL_STATUS = 'parcel_status';
    public const ROUTING_DELIVERY_AREA = 'routing_delivery_area';
    public const ROUTING_DELIVERY_DEPOT_NUMBER = 'routing_delivery_depot_number';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get the order ID
     *
     * @return int|null
     */
    public function getOrderId(): ?int;

    /**
     * Set the order ID
     *
     * @param int|null $orderId
     * @return self
     */
    public function setOrderId(?int $orderId): self;

    /**
     * Get the shipment ID
     *
     * @return string
     */
    public function getShipmentType(): string;

    /**
     * Set the shipment ID
     *
     * @param string $shipmentType
     * @return self
     */
    public function setShipmentType(string $shipmentType): self;

    /**
     * Get the label format
     *
     * @return string|null
     */
    public function getLabelFormat(): ?string;

    /**
     * Set the label format
     *
     * @param string|null $labelFormat
     * @return self
     */
    public function setLabelFormat(?string $labelFormat): self;

    /**
     * Get the sender's company name
     *
     * @return string|null
     */
    public function getSenderCompanyName(): ?string;

    /**
     * Set the sender's company name
     *
     * @param string|null $senderCompanyName
     * @return self
     */
    public function setSenderCompanyName(?string $senderCompanyName): self;

    /**
     * Get the sender's first name
     *
     * @return string
     */
    public function getSenderFirstName(): string;

    /**
     * Set the sender's first name
     *
     * @param string $senderFirstName
     * @return self
     */
    public function setSenderFirstName(string $senderFirstName): self;

    /**
     * Get the sender's last name
     *
     * @return string
     */
    public function getSenderLastName(): string;

    /**
     * Set the sender's last name
     *
     * @param string $senderLastName
     * @return self
     */
    public function setSenderLastName(string $senderLastName): self;

    /**
     * Get the sender's email address
     *
     * @return string
     */
    public function getSenderEmail(): string;

    /**
     * Set the sender's email address
     *
     * @param string $senderEmail
     * @return self
     */
    public function setSenderEmail(string $senderEmail): self;

    /**
     * Get the sender's phone number prefix
     *
     * @return string
     */
    public function getSenderPhonePrefix(): string;

    /**
     * Set the sender's phone number prefix
     *
     * @param string $senderPhonePrefix
     * @return self
     */
    public function setSenderPhonePrefix(string $senderPhonePrefix): self;

    /**
     * Get the sender's phone number
     *
     * @return string
     */
    public function getSenderPhoneNumber(): string;

    /**
     * Set the sender's phone number
     *
     * @param string $senderPhoneNumber
     * @return self
     */
    public function setSenderPhoneNumber(string $senderPhoneNumber): self;

    /**
     * Get the sender's language code
     *
     * @return string|null
     */
    public function getSenderLanguageCode(): ?string;

    /**
     * Set the sender's language code
     *
     * @param string|null $senderLanguageCode
     * @return self
     */
    public function setSenderLanguageCode(?string $senderLanguageCode): self;

    /**
     * Get the recipient's company name
     *
     * @return string|null
     */
    public function getRecipientCompanyName(): ?string;

    /**
     * Set the recipient's company name
     *
     * @param string|null $recipientCompanyName
     * @return self
     */
    public function setRecipientCompanyName(?string $recipientCompanyName): self;

    /**
     * Get the recipient's first name
     *
     * @return string
     */
    public function getRecipientFirstName(): string;

    /**
     * Set the recipient's first name
     *
     * @param string $recipientFirstName
     * @return self
     */
    public function setRecipientFirstName(string $recipientFirstName): self;

    /**
     * Get the recipient's last name
     *
     * @return string
     */
    public function getRecipientLastName(): string;

    /**
     * Set the recipient's last name
     *
     * @param string $recipientLastName
     * @return self
     */
    public function setRecipientLastName(string $recipientLastName): self;

    /**
     * Get the recipient's email address
     *
     * @return string
     */
    public function getRecipientEmail(): string;

    /**
     * Set the recipient's email address
     *
     * @param string $recipientEmail
     * @return self
     */
    public function setRecipientEmail(string $recipientEmail): self;

    /**
     * Get the recipient's phone number prefix
     *
     * @return string
     */
    public function getRecipientPhonePrefix(): string;

    /**
     * Set the recipient's phone number prefix
     *
     * @param string $recipientPhonePrefix
     * @return self
     */
    public function setRecipientPhonePrefix(string $recipientPhonePrefix): self;

    /**
     * Get the recipient's phone number
     *
     * @return string
     */
    public function getRecipientPhoneNumber(): string;

    /**
     * Set the recipient's phone number
     *
     * @param string $recipientPhoneNumber
     * @return self
     */
    public function setRecipientPhoneNumber(string $recipientPhoneNumber): self;

    /**
     * Get the recipient's language code
     *
     * @return string|null
     */
    public function getRecipientLanguageCode(): ?string;

    /**
     * Set the recipient's language code
     *
     * @param string|null $recipientLangCode
     * @return self
     */
    public function setRecipientLanguageCode(?string $recipientLangCode): self;

    /**
     * Get the origin house number
     *
     * @return string
     */
    public function getOriginHouseNumber(): string;

    /**
     * Set the origin house number
     *
     * @param string $originHouseNumber
     * @return self
     */
    public function setOriginHouseNumber(string $originHouseNumber): self;

    /**
     * Get the origin flat number
     *
     * @return string|null
     */
    public function getOriginFlatNumber(): ?string;

    /**
     * Set the origin flat number
     *
     * @param string|null $originFlatNumber
     * @return self
     */
    public function setOriginFlatNumber(?string $originFlatNumber): self;

    /**
     * Get the origin street
     *
     * @return string
     */
    public function getOriginStreet(): string;

    /**
     * Set the origin street
     *
     * @param string $originStreet
     * @return self
     */
    public function setOriginStreet(string $originStreet): self;

    /**
     * Get the origin city
     *
     * @return string
     */
    public function getOriginCity(): string;

    /**
     * Set the origin city
     *
     * @param string $originCity
     * @return self
     */
    public function setOriginCity(string $originCity): self;

    /**
     * Get the origin postal code
     *
     * @return string
     */
    public function getOriginPostalCode(): string;

    /**
     * Set the origin postal code
     *
     * @param string $originPostalCode
     * @return self
     */
    public function setOriginPostalCode(string $originPostalCode): self;

    /**
     * Get the origin country code
     *
     * @return string
     */
    public function getOriginCountryCode(): string;

    /**
     * Set the origin country code
     *
     * @param string $originCountryCode
     * @return self
     */
    public function setOriginCountryCode(string $originCountryCode): self;

    /**
     * Get the origin point name
     *
     * @return string
     */
    public function getDestinationCountryCode(): string;

    /**
     * Set the destination country code
     *
     * @param string $destCountryCode
     * @return self
     */
    public function setDestinationCountryCode(string $destCountryCode): self;

    /**
     * Get the destination point name
     *
     * @return string
     */
    public function getDestinationPointName(): string;

    /**
     * Set the destination point name
     *
     * @param string $destinationPointName
     * @return self
     */
    public function setDestinationPointName(string $destinationPointName): self;

    /**
     * Get the priority level of the shipment
     *
     * @return string
     */
    public function getPriority(): string;

    /**
     * Set the priority level of the shipment
     *
     * @param string $priority
     * @return self
     */
    public function setPriority(string $priority): self;

    /**
     * Get the insurance value of the shipment
     *
     * @return float|null
     */
    public function getInsuranceValue(): ?float;

    /**
     * Set the insurance value of the shipment
     *
     * @param float|null $insuranceValue
     * @return self
     */
    public function setInsuranceValue(?float $insuranceValue): self;

    /**
     * Get the currency of the insurance value
     *
     * @return string
     */
    public function getInsuranceCurrency(): string;

    /**
     * Set the currency of the insurance value
     *
     * @param string $insuranceCurrency
     * @return self
     */
    public function setInsuranceCurrency(string $insuranceCurrency): self;

    /**
     * Get the custom references for the shipment
     *
     * @return string|null
     */
    public function getReferences(): ?string;

    /**
     * Set the custom references for the shipment
     *
     * @param string|null $references
     * @return self
     */
    public function setReferences(?string $references): self;

    /**
     * Get the parcel type
     *
     * @return string
     */
    public function getParcelType(): string;

    /**
     * Set the parcel type
     *
     * @param string $parcelType
     * @return self
     */
    public function setParcelType(string $parcelType): self;

    /**
     * Get the parcel length
     *
     * @return float
     */
    public function getParcelLength(): float;

    /**
     * Set the parcel length
     *
     * @param float $parcelLength
     * @return self
     */
    public function setParcelLength(float $parcelLength): self;

    /**
     * Get the parcel width
     *
     * @return float
     */
    public function getParcelWidth(): float;

    /**
     * Set the parcel width
     *
     * @param float $parcelWidth
     * @return self
     */
    public function setParcelWidth(float $parcelWidth): self;

    /**
     * Get the parcel height
     *
     * @return float
     */
    public function getParcelHeight(): float;

    /**
     * Set the parcel height
     *
     * @param float $parcelHeight
     * @return self
     */
    public function setParcelHeight(float $parcelHeight): self;

    /**
     * Get the parcel dimensions unit
     *
     * @return string
     */
    public function getParcelDimensionsUnit(): string;

    /**
     * Set the parcel dimensions unit
     *
     * @param string $parcelDimensionsUnit
     * @return self
     */
    public function setParcelDimensionsUnit(string $parcelDimensionsUnit): self;

    /**
     * Get the parcel weight
     *
     * @return float
     */
    public function getParcelWeight(): float;

    /**
     * Set the parcel weight
     *
     * @param float $parcelWeight
     * @return self
     */
    public function setParcelWeight(float $parcelWeight): self;

    /**
     * Get the parcel weight unit
     *
     * @return string
     */
    public function getParcelWeightUnit(): string;

    /**
     * Set the parcel weight unit
     *
     * @param string $parcelWeightUnit
     * @return self
     */
    public function setParcelWeightUnit(string $parcelWeightUnit): self;

    /**
     * Get the parcel label comment
     *
     * @return string
     */
    public function getParcelLabelComment(): string;

    /**
     * Set the parcel label comment
     *
     * @param string $parcelLabelComment
     * @return self
     */
    public function setParcelLabelComment(string $parcelLabelComment): self;

    /**
     * Get the parcel label barcode
     *
     * @return string
     */
    public function getParcelLabelBarcode(): string;

    /**
     * Set the parcel label barcode
     *
     * @param string $parcelLabelBarcode
     * @return self
     */
    public function setParcelLabelBarcode(string $parcelLabelBarcode): self;

    /**
     * Get the label URL
     *
     * @return string|null
     */
    public function getLabelUrl(): ?string;

    /**
     * Set the label URL
     *
     * @param string|null $labelUrl
     * @return self
     */
    public function setLabelUrl(?string $labelUrl): self;

    /**
     * Get the tracking URL
     *
     * @return string|null
     */
    public function getUuid(): ?string;

    /**
     * Set the tracking URL
     *
     * @param string|null $uuid
     * @return self
     */
    public function setUuid(?string $uuid): self;

    /**
     * Get the tracking number
     *
     * @return string|null
     */
    public function getTrackingNumber(): ?string;

    /**
     * Set the tracking number
     *
     * @param string|null $trackingNumber
     * @return self
     */
    public function setTrackingNumber(?string $trackingNumber): self;

    /**
     * Get the parcel UUID
     *
     * @return string|null
     */
    public function getParcelUuid(): ?string;

    /**
     * Set the parcel UUID
     *
     * @param string|null $parcelUuid
     * @return self
     */
    public function setParcelUuid(?string $parcelUuid): self;

    /**
     * Get the parcel numbers
     *
     * @return string|null
     */
    public function getParcelNumbers(): ?string;

    /**
     * Set the parcel numbers
     *
     * @param string|null $parcelNumbers
     * @return self
     */
    public function setParcelNumbers(?string $parcelNumbers): self;

    /**
     * Get the parcel status
     *
     * @return string|null
     */
    public function getParcelStatus(): ?string;

    /**
     * Set the parcel status
     *
     * @param string|null $parcelStatus
     * @return self
     */
    public function setParcelStatus(?string $parcelStatus): self;

    /**
     * Get the parcel status date
     *
     * @return string|null
     */
    public function getRoutingDeliveryArea(): ?string;

    /**
     * Set the parcel status date
     *
     * @param string|null $routingDeliveryArea
     * @return self
     */
    public function setRoutingDeliveryArea(?string $routingDeliveryArea): self;

    /**
     * Get the parcel status date
     *
     * @return string|null
     */
    public function getRoutingDeliveryDepotNumber(): ?string;

    /**
     * Set the parcel status date
     *
     * @param string|null $deliveryDepotNumber
     * @return self
     */
    public function setRoutingDeliveryDepotNumber(?string $deliveryDepotNumber): self;

    /**
     * Get the parcel status date
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Set the parcel status date
     *
     * @param string $createdAt
     * @return self
     */
    public function setCreatedAt(string $createdAt): self;

    /**
     * Get the parcel status date
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set the parcel status date
     *
     * @param string $updatedAt
     * @return self
     */
    public function setUpdatedAt(string $updatedAt): self;
}
