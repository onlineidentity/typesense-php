<?php

namespace Typesense;

use Http\Client\Exception as HttpClientException;
use Typesense\Exceptions\TypesenseClientError;

/**
 * Class Document
 *
 * @package \Typesense
 * @date    4/5/20
 * @author  Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Document
{
    /**
     * @var string
     */
    private $collectionName;

    /**
     * @var string
     */
    private $documentId;

    /**
     * @var ApiCall
     */
    private $apiCall;

    /**
     * Document constructor.
     *
     * @param string $collectionName
     * @param string $documentId
     * @param ApiCall $apiCall
     */
    public function __construct(string $collectionName, string $documentId, ApiCall $apiCall)
    {
        $this->collectionName = $collectionName;
        $this->documentId     = $documentId;
        $this->apiCall        = $apiCall;
    }

    /**
     * @return string
     */
    private function endpointPath(): string
    {
        return sprintf(
            '%s/%s/%s/%s',
            Collections::RESOURCE_PATH,
            encodeURIComponent($this->collectionName),
            Documents::RESOURCE_PATH,
            encodeURIComponent($this->documentId)
        );
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
     * @param array $partialDocument
     * @param array $options
     *
     * @return array
     * @throws TypesenseClientError|HttpClientException
     */
    public function update(array $partialDocument, array $options = []): array
    {
        return $this->apiCall->patch($this->endpointPath(), $partialDocument, true, $options);
    }

    /**
     * @param array $options
     * @return array
     * @throws TypesenseClientError|HttpClientException
     */
    public function delete(array $options = []): array
    {
        return $this->apiCall->delete($this->endpointPath(), true, $options);
    }
}
