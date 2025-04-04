<?php

namespace Typesense;

use Typesense\Exceptions\ConfigError;
use Typesense\Lib\Configuration;

include('utils/utils.php');
/**
 * Class Client
 *
 * @package \Typesense
 * @date    4/5/20
 * @author  Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Client
{
    /**
     * @var Configuration
     */
    private $config;

    /**
     * @var Collections
     */
    public $collections;

    /**
     * @var Stopwords
     */
    public $stopwords;

    /**
     * @var Aliases
     */
    public $aliases;

    /**
     * @var Keys
     */
    public $keys;

    /**
     * @var Debug
     */
    public $debug;

    /**
     * @var Metrics
     */
    public $metrics;

    /**
     * @var Health
     */
    public $health;

    /**
     * @var Operations
     */
    public $operations;

    /**
     * @var MultiSearch
     */
    public $multiSearch;

    /**
     * @var Presets
     */
    public $presets;

    /**
     * @var Analytics
     */
    public $analytics;

    /**
     * @var Stemming
     */
    public $stemming;

    /**
     * @var Conversations
     */
    public $conversations;

    /**
     * @var ApiCall
     */
    private $apiCall;

    /**
     * Client constructor.
     *
     * @param array $config
     *
     * @throws ConfigError
     */
    public function __construct(array $config)
    {
        $this->config  = new Configuration($config);
        $this->apiCall = new ApiCall($this->config);

        $this->collections   = new Collections($this->apiCall);
        $this->stopwords     = new Stopwords($this->apiCall);
        $this->aliases       = new Aliases($this->apiCall);
        $this->keys          = new Keys($this->apiCall);
        $this->debug         = new Debug($this->apiCall);
        $this->metrics       = new Metrics($this->apiCall);
        $this->health        = new Health($this->apiCall);
        $this->operations    = new Operations($this->apiCall);
        $this->multiSearch   = new MultiSearch($this->apiCall);
        $this->presets       = new Presets($this->apiCall);
        $this->analytics     = new Analytics($this->apiCall);
        $this->stemming     = new Stemming($this->apiCall);
        $this->conversations = new Conversations($this->apiCall);
    }

    /**
     * @return Collections
     */
    public function getCollections(): Collections
    {
        return $this->collections;
    }

    /**
     * @return Stopwords
     */
    public function getStopwords(): Stopwords
    {
        return $this->stopwords;
    }

    /**
     * @return Aliases
     */
    public function getAliases(): Aliases
    {
        return $this->aliases;
    }

    /**
     * @return Keys
     */
    public function getKeys(): Keys
    {
        return $this->keys;
    }

    /**
     * @return Debug
     */
    public function getDebug(): Debug
    {
        return $this->debug;
    }

    /**
     * @return Metrics
     */
    public function getMetrics(): Metrics
    {
        return $this->metrics;
    }

    /**
     * @return Health
     */
    public function getHealth(): Health
    {
        return $this->health;
    }

    /**
     * @return Operations
     */
    public function getOperations(): Operations
    {
        return $this->operations;
    }

    /**
     * @return MultiSearch
     */
    public function getMultiSearch(): MultiSearch
    {
        return $this->multiSearch;
    }

    /**
     * @return Presets
     */
    public function getPresets(): Presets
    {
        return $this->presets;
    }

    /**
     * @return Analytics
     */
    public function getAnalytics(): Analytics
    {
        return $this->analytics;
    }

    /**
     * @return Stemming
     */
    public function getStemming(): Stemming
    {
        return $this->stemming;
    }

    /**
     * @return Conversations
     */
    public function getConversations(): Conversations
    {
        return $this->conversations;
    }
}
