<?php

namespace IvankoTut\NotebookSdk\Action;

use IvankoTut\NotebookSdk\ApiClient;
use IvankoTut\NotebookSdk\Model as SDKModel;

class Tag extends AbstractAction
{
    public const MODEL_TO_FILL = SDKModel\Tag::class;

    public function __construct(private readonly ApiClient $client)
    {
    }

    public function tag(string $apiKey, int $tagId): SDKModel\Tag
    {
        /** @var SDKModel\Tag $tag */
        $tag = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'get',
            sprintf("/tag/%s", $tagId),
            null,
            $this->getAuthHeader($apiKey)
        );

        return $tag;
    }

    public function tags(string $apiKey, int $page = 1, int $limit = 10): SDKModel\Collection\CollectionData
    {
        /** @var SDKModel\Collection\CollectionData $tagList */
        $tagList = $this->client->requestWithFillModel(
            SDKModel\Collection\CollectionData::class,
            'get',
            sprintf("/tag?page=%s&limit=%s", $page, $limit),
            null,
            $this->getAuthHeader($apiKey)
        );

        return $tagList;
    }

    /**
     * @param string $apiKey
     * @param array $data ['name' => 'Tag name']
     *
     * @return SDKModel\Tag
     */
    public function create(string $apiKey, array $data): SDKModel\Tag
    {
        /** @var SDKModel\Tag::class $tag*/
        $tag = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'post',
            '/tag',
            $data,
            $this->getAuthHeader($apiKey)
        );

        return $tag;
    }

    public function delete(string $apiKey, int $tagId): void
    {
        $this->client->request(
            'delete',
            sprintf("/tag/%s", $tagId),
            null,
            $this->getAuthHeader($apiKey)
        );
    }
}
