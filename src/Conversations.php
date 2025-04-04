<?php

namespace Typesense;

/**
 * Class Conversations
 *
 * @package \Typesense
 */
class Conversations implements \ArrayAccess
{
    public const RESOURCE_PATH = '/conversations';

    /**
     * @var ConversationModels
     */
    public $typesenseModels;

    /**
     * @var ApiCall
     */
    private $apiCall;

    /**
     * @var array
     */
    private $individualConversations = [];

    /**
     * Conversations constructor.
     *
     * @param ApiCall $apiCall
     */
    public function __construct(ApiCall $apiCall)
    {
        $this->apiCall = $apiCall;
        $this->typesenseModels = new ConversationModels($this->apiCall);
    }

    /**
     * @return Models
     */
    public function getModels(): ConversationModels
    {
        return $this->typesenseModels;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        if (isset($this->{$id})) {
            return $this->{$id};
        }

        if (!isset($this->individualConversations[$id])) {
            $this->individualConversations[$id] = new Conversation($id, $this->apiCall);
        }

        return $this->individualConversations[$id];
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return isset($this->individualConversations[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): Conversation
    {
        if (!isset($this->individualConversations[$offset])) {
            $this->individualConversations[$offset] = new Conversation($offset, $this->apiCall);
        }

        return $this->individualConversations[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        $this->individualConversations[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset): void
    {
        unset($this->individualConversations[$offset]);
    }
}
