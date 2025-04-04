<?php

namespace Typesense;

use Http\Client\Exception as HttpClientException;
use Typesense\Exceptions\TypesenseClientError;

/**
 * Class synonym
 *
 * @package \Typesense
 */
class Synonym
{
    /**
     * @var string
     */
    private $collectionName;

    /**
     * @var string
     */
    private $synonymId;

    /**
     * @var ApiCall
     */
    private $apiCall;

    /**
     * synonym constructor.
     *
     * @param string $collectionName
     * @param string $synonymId
     * @param ApiCall $apiCall
     */
    public function __construct(string $collectionName, string $synonymId, ApiCall $apiCall)
    {
        $this->collectionName = $collectionName;
        $this->synonymId      = $synonymId;
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
            synonyms::RESOURCE_PATH,
            encodeURIComponent($this->synonymId)
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
