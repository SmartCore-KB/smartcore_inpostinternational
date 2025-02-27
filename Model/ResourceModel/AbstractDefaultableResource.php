<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\ResourceModel;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

abstract class AbstractDefaultableResource extends AbstractDb
{
    /**
     * Save object
     *
     * If object has is_default flag set to 1, then unset default flag for other objects
     *
     * @param AbstractModel $object
     * @return AbstractDb
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function save(AbstractModel $object): AbstractDb
    {
        if ($object->getData('is_default') == 1 && $object->getOrigData('is_default') != 1) {
            $this->unsetDefault();
        }
        return parent::save($object);
    }

    /**
     * Unset default flag
     *
     * @return void
     * @throws LocalizedException
     */
    private function unsetDefault(): void
    {
        $connection = $this->getConnection();
        $connection->update(
            $this->getMainTable(),
            ['is_default' => 0],
            ['is_default = ?' => 1]
        );
    }
}
