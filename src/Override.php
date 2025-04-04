<?php

namespace Typesense;

use Http\Client\Exception as HttpClientException;
use Typesense\Exceptions\TypesenseClientError;

/**
 * Class Override
 *
 * @package \Typesense
 * @date    4/5/20
 * @author  Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Override
{
    /**
     * @var string
     */
    private $collectionName;

    /**
     * @var string
     */
    private $overrideId;

    /**
     * @var ApiCall
     */
    private $apiCall;

    /**
     * Override constructor.
     *
     * @param string $collectionName
     * @param string $overrideId
     * @param ApiCall $apiCall
     */
    public function __construct(string $collectionName, string $overrideId, ApiCall $apiCall)
    {
        $this->collectionName = $collectionName;
        $this->overrideId     = $overrideId;
        $this->apiCall        = $apiCall;
    }

    /**
     * @return string
     */
    private function endPointPath(): string
    {
        return sprintf(
            '%s/%s/%s/%s',
            Collections::RESOURCE_PATH,
            encodeURIComponent($this->collectionName),
            Overrides::RESOURCE_PATH,
            encodeURIComponent($this->overrideId)
        );
    }

    /**
     * @return array
     * @throws TypesenseClientError|HttpClientException
     */
    public function retrieve(): array
    {
        return $this->apiCall->get($this->endPointPath(), []);
    }

    /**
     * @return array
     * @throws TypesenseClientError|HttpClientException
     */
    public function delete(): array
    {
        return $this->apiCall->delete($this->endPointPath());
    }
}
