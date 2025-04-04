<?php

namespace Typesense;

use Http\Client\Exception as HttpClientException;
use Typesense\Exceptions\TypesenseClientError;

/**
 * Class Key
 *
 * @package \Typesense
 * @date 6/1/20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Key
{
    /**
     * @var ApiCall
     */
    private $apiCall;

    /**
     * @var string
     */
    private $keyId;

    /**
     * Key constructor.
     *
     * @param string $keyId
     * @param ApiCall $apiCall
     */
    public function __construct(string $keyId, ApiCall $apiCall)
    {
        $this->keyId   = $keyId;
        $this->apiCall = $apiCall;
    }

    /**
     * @return string
     */
    private function endpointPath(): string
    {
        return sprintf('%s/%s', Keys::RESOURCE_PATH, encodeURIComponent($this->keyId));
    }

    /**
     * @return array
     * @throws TypesenseClientError|HttpClientException
     */
    public function retrieve(): array
    {
        return $this->apiCall->get($this->endpointPath(), []);
    }

    /**
     * @return array
     * @throws TypesenseClientError|HttpClientException
     */
    public function delete(): array
    {
        return $this->apiCall->delete($this->endpointPath());
    }
}
