<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Api;

use Exception;
use InvalidArgumentException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Smartcore\InPostInternational\Exception\ApiException;
use Smartcore\InPostInternational\Exception\TokenSaveException;
use Smartcore\InPostInternational\Model\Config\Source\Mode;
use Smartcore\InPostInternational\Model\ConfigProvider;
use Smartcore\InPostInternational\Model\Data\ShipmentTypeInterface;

class InternationalApiService
{
    public const string API_PROD_BASE_URL = 'https://api.inpost-group.com/';
    public const string API_SANDBOX_BASE_URL = 'https://sandbox-api.inpost-group.com/';
    private const string API_VERSION = '2024-06-01';

    /**
     * @var string
     */
    public string $apiBaseUrl;

    /**
     * InternationalApiService constructor.
     *
     * @param ConfigProvider $configProvider
     * @param Curl $curl
     * @param Json $json
     * @param AccessTokenService $accessTokenService
     */
    public function __construct(
        private readonly ConfigProvider     $configProvider,
        private readonly Curl               $curl,
        private readonly Json               $json,
        private readonly AccessTokenService $accessTokenService
    ) {
        $this->setApiBaseUrl();
    }

    /**
     * Set API base URL based on the current mode
     *
     * @return void
     */
    private function setApiBaseUrl(): void
    {
        $this->apiBaseUrl = $this->configProvider->getMode() === Mode::SANDBOX
            ? self::API_SANDBOX_BASE_URL
            : self::API_PROD_BASE_URL;
    }

    /**
     * Create shipment using InPost API
     *
     * @param ShipmentTypeInterface $shipment
     * @return array
     * @throws Exception
     */
    public function createShipment(ShipmentTypeInterface $shipment): array
    {
        $shipmentData = $shipment->toArray();
        return $this->sendRequest(
            'POST',
            sprintf('shipments/%s', $shipment->getEndpoint()),
            $shipmentData
        );
    }

    /**
     * Send HTTP request to the InPost API
     *
     * @param string $method
     * @param string $endpoint
     * @param array<mixed>|null $data
     * @return array<mixed>
     * @throws ApiException
     * @throws LocalizedException
     * @throws TokenSaveException
     */
    private function sendRequest(string $method, string $endpoint, ?array $data = null): array
    {
        $url = $this->buildUrl($endpoint);

        $this->curl->addHeader('Authorization', 'Bearer ' . $this->accessTokenService->getAccessToken());
        $this->curl->addHeader('Content-Type', 'application/json');
        $this->curl->addHeader('Accept', 'application/json');
        $this->curl->addHeader('X-InPost-Api-Version', self::API_VERSION);

        switch ($method) {
            case 'GET':
                $this->curl->get($url);
                break;
            case 'POST':
                $this->curl->post($url, $this->json->serialize($data));
                break;
            default:
                throw new InvalidArgumentException(
                    sprintf('Unsupported HTTP method: %s', $method)
                );
        }

        $statusCode = $this->curl->getStatus();
        $response = $this->json->unserialize($this->curl->getBody());

        $this->handleResponseStatus($statusCode, $response);

        return $response;
    }

    /**
     * Handle API response status
     *
     * @param int $statusCode
     * @param array $response
     * @return void
     * @throws LocalizedException|ApiException
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    private function handleResponseStatus(int $statusCode, array $response): void
    {
        switch ($statusCode) {
            case 200:
            case 201:
            case 202:
            case 204:
                return;
            case 304:
                throw new LocalizedException(__('No changes in the HTTP request'));
            case 400:
                throw new ApiException(
                    __('Bad Request: %1', $response['message'] ?? 'Invalid JSON data')->getText(),
                    $response,
                    $statusCode
                );
            case 401:
                throw new ApiException(
                    __('Unauthorized: Authentication required')->getText(),
                    $response,
                    $statusCode
                );
            case 403:
                throw new ApiException(
                    __('Forbidden: Insufficient permissions')->getText(),
                    $response,
                    $statusCode
                );
            case 404:
                throw new ApiException(
                    __('Resource not found')->getText(),
                    $response,
                    $statusCode
                );
            case 406:
            case 415:
                throw new ApiException(
                    __('Unsupported media type or data format')->getText(),
                    $response,
                    $statusCode
                );
            case 422:
                throw new ApiException(
                    __('Validation error: %1', $response['message'] ?? 'Invalid field values')->getText(),
                    $response,
                    $statusCode
                );
            case 429:
                throw new ApiException(
                    __('Too many requests: Rate limit exceeded')->getText(),
                    $response,
                    $statusCode
                );
            case 503:
                throw new ApiException(
                    __('Service temporarily unavailable')->getText(),
                    $response,
                    $statusCode
                );
            default:
                throw new ApiException(
                    __('Unexpected API response: %1', $statusCode)->getText(),
                    $response,
                    $statusCode
                );
        }
    }

    /**
     * Build API URL
     *
     * @param string $endpoint
     * @return string
     */
    private function buildUrl(string $endpoint): string
    {
        return rtrim($this->getApiBaseUrl(), '/') . '/' . ltrim($endpoint, '/');
    }

    /**
     * Get API base URL
     *
     * @return string
     */
    public function getApiBaseUrl(): string
    {
        return $this->apiBaseUrl;
    }
}
