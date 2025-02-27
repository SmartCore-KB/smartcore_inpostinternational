<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model;

use Smartcore\InPostInternational\Api\Data\OrderShipmentCreateInterface;

class OrderShipmentCreate implements OrderShipmentCreateInterface
{

    /**
     * @var string
     */
    private string $orderIncrementId;
    /**
     * @var string
     */
    private string $errorMessage;
    /**
     * @var int
     */
    private int $reQueueCounter;

    /**
     * OrderShipmentCreate constructor.
     */
    public function __construct()
    {
        $this->orderIncrementId = '';
        $this->errorMessage = '';
        $this->reQueueCounter = 0;
    }

    /**
     * Get order id
     *
     * @return string
     */
    public function getOrderIncrementId(): string
    {
        return $this->orderIncrementId;
    }

    /**
     * Set order id
     *
     * @param string $orderIncrementId
     * @return $this
     */
    public function setOrderIncrementId(string $orderIncrementId): self
    {
        $this->orderIncrementId = $orderIncrementId;
        return $this;
    }

    /**
     * Get error message
     *
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * Set error message
     *
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage(string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * Get requeue counter
     *
     * @return int
     */
    public function getReQueueCounter(): int
    {
        return $this->reQueueCounter;
    }

    /**
     * Set requeue counter
     *
     * @param int $reQueueCounter
     * @return $this
     */
    public function setReQueueCounter(int $reQueueCounter): self
    {
        $this->reQueueCounter = $reQueueCounter;
        return $this;
    }

    /**
     * Increment requeue counter
     *
     * @return $this
     */
    public function incrementReQueueCounter(): self
    {
        $this->reQueueCounter++;
        return $this;
    }
}
