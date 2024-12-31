<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface OrderShipmentCreateInterface
{

    /**
     * Get order id
     *
     * @return string
     */
    public function getOrderIncrementId(): string;

    /**
     * Set order id
     *
     * @param string $orderIncrementId
     * @return $this
     */
    public function setOrderIncrementId(string $orderIncrementId): self;

    /**
     * Get error message
     *
     * @return string
     */
    public function getErrorMessage(): string;

    /**
     * Set error message
     *
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage(string $errorMessage): self;

    /**
     * Get requeue counter
     *
     * @return int
     */
    public function getReQueueCounter(): int;

    /**
     * Set order id
     *
     * @param int $reQueueCounter
     * @return $this
     */
    public function setReQueueCounter(int $reQueueCounter): self;

    /**
     * Increment requeue counter
     *
     * @return $this
     */
    public function incrementReQueueCounter(): self;
}
