<?php

namespace Typesense;

class Stemming
{
    const RESOURCE_PATH = '/stemming';

    private $apiCall;

    private $typesenseDictionaries;


    public function __construct(ApiCall $apiCall)
    {
        $this->apiCall = $apiCall;
    }

    public function dictionaries()
    {
        if (!isset($this->typesenseDictionaries)) {
            $this->typesenseDictionaries = new StemmingDictionaries($this->apiCall);
        }
        return $this->typesenseDictionaries;
    }
}
