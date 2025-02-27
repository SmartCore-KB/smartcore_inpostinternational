<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Exception;

use Throwable;

class ApiException extends \Exception
{
    /**
     * @var array
     */
    private array $response;

    /**
     * ApiException constructor.
     *
     * @param string $message
     * @param array $response
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = "",
        array $response = [],
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    /**
     * Get the response from the API
     *
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }
}
