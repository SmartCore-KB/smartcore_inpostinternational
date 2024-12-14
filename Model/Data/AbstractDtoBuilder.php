<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

use InvalidArgumentException;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

class AbstractDtoBuilder
{
    /**
     * AbstractDtoFactory constructor
     *
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        private readonly Context $context,
        private readonly Registry $registry
    ) {
    }

    /**
     * Create a new AbstractDto instance
     *
     * @param string $className
     * @return AbstractDto
     * @throws InvalidArgumentException
     */
    public function buildDtoInstance(string $className): AbstractDto
    {
        if (!is_subclass_of($className, AbstractDto::class)) {
            throw new InvalidArgumentException("Class $className must extend AbstractDto");
        }

        return new $className(
            $this->context,
            $this->registry,
            null,
            null
        );
    }
}
