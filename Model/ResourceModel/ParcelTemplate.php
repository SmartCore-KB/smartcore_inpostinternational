<?php
namespace Smartcore\InPostInternational\Model\ResourceModel;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Smartcore\InPostInternational\Model\ParcelTemplate as ParcelTemplateModel;

class ParcelTemplate extends AbstractDb
{
    /**
     * Parcel Template resource model constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('inpostinternational_parcel_template', 'entity_id');
    }

    /**
     * Save object
     *
     * If object has is_default flag set to 1, then unset default flag for other objects
     *
     * @param AbstractModel $object
     * @return ParcelTemplate
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function save(AbstractModel $object): ParcelTemplate
    {
        if ($object instanceof ParcelTemplateModel && $object->isDefault() == 1) {
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
