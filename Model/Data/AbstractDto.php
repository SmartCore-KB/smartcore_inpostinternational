<?php
namespace Smartcore\InPostInternational\Model\Data;

use ReflectionClass;
use Smartcore\InPostInternational\Api\SerializableInterface;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractDto implements SerializableInterface
{
    /**
     * Convert object to array
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();

        $result = [];
        foreach ($properties as $property) {
            $value = $property->getValue($this);

            if ($this->shouldIncludeValue($value)) {
                if ($value instanceof SerializableInterface) {
                    $value = $value->toArray();
                }
                $result[$property->getName()] = $value;
            }
        }

        return $result;
    }

    /**
     * Check if the value should be included in the array
     *
     * @param mixed $value
     * @return bool
     */
    protected function shouldIncludeValue(mixed $value): bool
    {
        if ($value === null || $value === '') {
            return false;
        }

        if (is_array($value) && empty($value)) {
            return false;
        }

        return true;
    }
}
