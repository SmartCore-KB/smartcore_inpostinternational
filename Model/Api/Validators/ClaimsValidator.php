<?php

namespace Smartcore\InPostInternational\Model\Api\Validators;

use Smartcore\InPostInternational\Exception\InvalidAuthorizedPartyException;
use Smartcore\InPostInternational\Exception\InvalidIssuerException;
use Smartcore\InPostInternational\Exception\MissingRequiredClaimsException;
use Smartcore\InPostInternational\Model\ConfigProvider;
use stdClass;

class ClaimsValidator
{
    public const string ISS = 'https://sandbox-login.inpost-group.com/realms/external';

    /**
     * ClaimsValidator constructor.
     *
     * @param ConfigProvider $configProvider
     */
    public function __construct(
        private readonly ConfigProvider $configProvider
    ) {
    }

    /**
     * Validate common claims
     *
     * @param stdClass $decoded
     * @return void
     * @throws InvalidIssuerException
     * @throws InvalidAuthorizedPartyException
     * @throws MissingRequiredClaimsException
     */
    public function validateCommonClaims(stdClass $decoded): void
    {
        if ($decoded->iss !== self::ISS) {
            throw new InvalidIssuerException('Invalid issuer');
        }

        if ($decoded->azp !== $this->configProvider->getClientId()) {
            throw new InvalidAuthorizedPartyException('Invalid authorized party');
        }

        if (!isset($decoded->sub) || !isset($decoded->jti) || !isset($decoded->scope)) {
            throw new MissingRequiredClaimsException('Missing required claims');
        }
    }
}
