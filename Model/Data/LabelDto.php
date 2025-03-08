<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class LabelDto extends AbstractDto
{
    /**
     * Comment or additional information related to the label
     *
     * @var string
     */
    public string $comment;

    /**
     * Barcode associated with the label
     *
     * @var string
     */
    public string $barcode;

    /**
     * Get the comment or additional information related to the label
     *
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * Set the comment or additional information related to the label
     *
     * @param string $comment
     * @return $this
     */
    public function setComment(string $comment): static
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get the barcode associated with the label
     *
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * Set the barcode associated with the label
     *
     * @param string $barcode
     * @return $this
     */
    public function setBarcode(string $barcode): static
    {
        $this->barcode = $barcode;
        return $this;
    }
}
