<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Smartcore\InPostInternational\Api\Data\ShipmentInterface;

class Shipment extends AbstractDb
{
    private const string TABLE_NAME = 'inpostinternational_shipments';

    /**
     * Core DateTime
     *
     * @var DateTime
     */
    protected $coreDate;

    /**
     * Shipment constructor.
     *
     * @param Context $context
     * @param DateTime $coreDate
     * @param string|null $connectionName
     */
    public function __construct(
        Context $context,
        DateTime $coreDate,
        string $connectionName = null
    ) {
        $this->coreDate = $coreDate;
        parent::__construct($context, $connectionName);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, ShipmentInterface::ENTITY_ID);
    }
}
