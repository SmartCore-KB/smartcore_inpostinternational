<?php
declare(strict_types=1);

namespace Smartcore\InPostInternational\Block\Adminhtml\System\Config;

use Magento\Config\Model\Config\CommentInterface;
use Magento\Framework\Module\ModuleListInterface;
use Magento\Framework\Module\ResourceInterface;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;

class ModuleVersion extends AbstractBlock implements CommentInterface
{

    /**
     * ModuleVersion constructor.
     *
     * @param Context $context
     * @param ResourceInterface $resource
     * @param ModuleListInterface $_moduleList
     * @param array $data
     */
    public function __construct(
        Context                            $context,
        private readonly ResourceInterface $resource,
        protected ModuleListInterface      $_moduleList,
        array                              $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Returns information about module version
     *
     * @param string $elementValue
     * @return string
     * @SuppressWarnings("unused")
     */
    public function getCommentText($elementValue): string
    {
        $moduleCode = 'Smartcore_InPostInternational';
        $moduleInfo = $this->_moduleList->getOne($moduleCode);
        $moduleXmlVersion = $moduleInfo['setup_version'];
        $moduleDbVersion = $this->resource->getDbVersion($moduleCode);
        $result = __('Module version') . ': ' . $moduleDbVersion;
        if ($moduleXmlVersion != $moduleDbVersion) {
            $result .= ' (' . __('setup:upgrade required, module.xml version') . ': ' . $moduleXmlVersion . ')';
        }
        return $result;
    }
}
