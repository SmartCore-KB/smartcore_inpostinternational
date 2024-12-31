<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Api;

class ErrorProcessor
{
    /**
     * @var array<string,string>
     */
    private array $errorMessages = [
        'required' => 'Field %s is required',
        'invalid' => 'Field %s is invalid',
        'unknown' => 'Field %s is unknown',
        'too_big' => 'Field %s value is too big',
    ];

    /**
     * Process API error response
     *
     * @param array $apiResponse
     * @return string[]
     */
    public function processErrors(array $apiResponse): array
    {
        if (!isset($apiResponse['errors']) || !is_array($apiResponse['errors'])) {
            return [$apiResponse['detail']
                ?? sprintf(__('Unknown error occurred! %s')->render(), json_encode($apiResponse))];
        }

        $messages = [];
        foreach ($apiResponse['errors'] as $field => $errors) {
            foreach ($errors as $error) {
                $messages[] = $this->formatErrorMessage($field, $error);
            }
        }

        return $messages;
    }

    /**
     * Format single error message
     *
     * @param string $field
     * @param string $error
     * @return string
     */
    private function formatErrorMessage(string $field, string $error): string
    {
        $fieldName = implode(' - ', array_map('ucfirst', explode('.', $field)));

        $template = $this->errorMessages[$error] ?? __('Field error %s: %s')->render();

        return sprintf($template, $fieldName, $error);
    }
}
