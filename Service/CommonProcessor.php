<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Service;

use InvalidArgumentException;
use Smartcore\InPostInternational\Model\Data\AbstractDtoBuilder;
use Smartcore\InPostInternational\Model\Data\PhoneDto;
use Smartcore\InPostInternational\Model\Data\ReferencesDto;

class CommonProcessor
{

    /**
     * CommonProcessor constructor.
     *
     * @param AbstractDtoBuilder $abstractDtoBuilder
     */
    public function __construct(
        private readonly AbstractDtoBuilder $abstractDtoBuilder,
    ) {
    }

    /**
     * Create references
     *
     * @param array $fieldsetData
     * @return ReferencesDto|null
     */
    protected function createReferences(array $fieldsetData): ?ReferencesDto
    {
        if (!isset($fieldsetData['custom_reference'])) {
            return null;
        }
        /** @var ReferencesDto $references */
        $references = $this->abstractDtoBuilder->buildDtoInstance(ReferencesDto::class);
        $references->setCustom($fieldsetData['custom_reference']);

        return $references;
    }

    /**
     * Create phone object
     *
     * @psalm-param array{prefix: string, number: string} $phoneData
     * @param array<string> $phoneData
     * @return PhoneDto
     * @throws InvalidArgumentException If required keys are missing.
     */
    protected function createPhone(array $phoneData): PhoneDto
    {
        /** @var PhoneDto $phone */
        $phone = $this->abstractDtoBuilder->buildDtoInstance(PhoneDto::class);
        return $phone->setPrefix($phoneData['prefix'])
            ->setNumber($phoneData['number']);
    }
}
