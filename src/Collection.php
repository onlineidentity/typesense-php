<?php

namespace Typesense;

use Http\Client\Exception as HttpClientException;
use Typesense\Exceptions\TypesenseClientError;

/**
 * Class Collection
 *
 * @package \Typesense
 * @date    4/5/20
 * @author  Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Collection
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ApiCall
     */
    private $apiCall;

    /**
     * @var Documents
     */
    public $documents;

    /**
     * @var Overrides
     */
    public $overrides;

    /**
     * @var Synonyms
     */
    public $synonyms;

    /**
     * @var bool|null
     */
    private $exists = null;

    /**
     * Collection constructor.
     *
     * @param string  $name
     * @param ApiCall $apiCall
     */
    public function __construct(string $name, ApiCall $apiCall)
    {
        $this->name      = $name;
        $this->apiCall   = $apiCall;
        $this->documents = new Documents($name, $this->apiCall);
        $this->overrides = new Overrides($name, $this->apiCall);
        $this->synonyms  = new Synonyms($name, $this->apiCall);
    }

    /**
     * @return string
     */
    public function endPointPath(): string
    {
        return sprintf('%s/%s', Collections::RESOURCE_PATH, encodeURIComponent($this->name));
    }

    /**
     * @return Documents
     */
    public function getDocuments(): Documents
    {
        return $this->documents;
    }

    /**
     * @return Overrides
     */
    public function getOverrides(): Overrides
    {
        return $this->overrides;
    }

    /**
     * @return Synonyms
     */
    public function getSynonyms(): Synonyms
    {
        return $this->synonyms;
    }

    /**
     * Set collection exists flag.
     *
     * @param bool $exists
     *
     * @return void
     */
    public function setExists(bool $exists): void
    {
        $this->exists = $exists;
    }

    /**
     * @return bool|null
     */
    public function exists(): ?bool
    {
        if ($this->exists === null) {
            try {
                $this->retrieve();
                $this->exists = true;
            } catch (TypesenseClientError | HttpClientException $e) {
                $this->exists = false;
            }
        }

        return $this->exists;
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
     * @param array $schema
     *
     * @return array
     * @throws TypesenseClientError|HttpClientException
     */
    public function update(array $schema): array
    {
        return $this->apiCall->patch($this->endPointPath(), $schema);
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
