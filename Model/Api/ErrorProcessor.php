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
        'not_found' => '%s not found',
    ];

    /**
     * Process API error response
     *
     * @param array $apiResponse
     * @return string[]
     */
    public function processErrors(array $apiResponse): array
    {
        if ($this->hasErrors($apiResponse)) {
            return $this->extractErrorMessages($apiResponse['errors']);
        }

        if ($this->hasMessages($apiResponse)) {
            return $this->extractMessages($apiResponse);
        }

        return [$this->getUnknownErrorMessage($apiResponse)];
    }

    /**
     * Check if API response has errors
     *
     * @param array $apiResponse
     * @return bool
     */
    private function hasErrors(array $apiResponse): bool
    {
        return isset($apiResponse['errors']) && is_array($apiResponse['errors']) && !empty($apiResponse['errors']);
    }

    /**
     * Check if API response has messages
     *
     * @param array $apiResponse
     * @return bool
     */
    private function hasMessages(array $apiResponse): bool
    {
        return isset($apiResponse['messages']) && is_array($apiResponse['messages']);
    }

    /**
     * Extract error messages from API response
     *
     * @param array $errors
     * @return string[]
     */
    private function extractErrorMessages(array $errors): array
    {
        $messages = [];
        foreach ($errors as $field => $fieldErrors) {
            if (!is_array($fieldErrors)) {
                $fieldErrors = [$fieldErrors];
            }
            foreach ($fieldErrors as $error) {
                $messages[] = $this->formatErrorMessage($field, $error);
            }
        }
        return $messages;
    }

    /**
     * Extract messages from API response
     *
     * @param array $apiResponse
     * @return string[]
     */
    private function extractMessages(array $apiResponse): array
    {
        $messages = [$apiResponse['detail'] ?? ''];
        foreach ($apiResponse['messages'] as $message) {
            $messages[] = $message['message'] ?? '';
        }
        return $messages;
    }

    /**
     * Get unknown error message
     *
     * @param array $apiResponse
     * @return string
     */
    private function getUnknownErrorMessage(array $apiResponse): string
    {
        return $apiResponse['detail'] ?? sprintf(__('Unknown error occurred! %s')->render(), json_encode($apiResponse));
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
