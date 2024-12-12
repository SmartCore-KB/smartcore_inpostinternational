<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class Label
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
     * @return void
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
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
     * @return void
     */
    public function setBarcode(string $barcode): void
    {
        $this->barcode = $barcode;
    }
}
