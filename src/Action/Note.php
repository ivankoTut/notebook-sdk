<?php

namespace IvankoTut\NotebookSdk\Action;

use IvankoTut\NotebookSdk\ApiClient;
use IvankoTut\NotebookSdk\Model as SDKModel;

class Note extends AbstractAction
{
    public const MODEL_TO_FILL = SDKModel\Note::class;

    public function __construct(private readonly ApiClient $client)
    {
    }

    public function get(string $apiKey, int $noteId): SDKModel\Note
    {
        /** @var SDKModel\Note $note */
        $note = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'get',
            sprintf("/note/%s", $noteId),
            null,
            $this->getAuthHeader($apiKey)
        );

        return $note;
    }

    public function delete(string $apiKey, int $noteId): void
    {
        $this->client->request(
            'delete',
            sprintf("/note/%s", $noteId),
            null,
            $this->getAuthHeader($apiKey)
        );
    }

    public function byTag(string $apiKey, int $tagId, int $page = 1, int $limit = 10): SDKModel\Collection\CollectionData
    {
        /** @var SDKModel\Collection\CollectionData $tagList */
        $tagList = $this->client->requestWithFillModel(
            SDKModel\Collection\CollectionData::class,
            'get',
            sprintf("/note/%s/tag?page=%s&limit=%s", $tagId, $page, $limit),
            null,
            $this->getAuthHeader($apiKey)
        );

        return $tagList;
    }

    public function create(string $apiKey, array $data): SDKModel\Note
    {
        /** @var SDKModel\Note $note */
        $note = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'post',
            '/note',
            $data,
            $this->getAuthHeader($apiKey)
        );

        return $note;
    }

    public function edit(string $apiKey, int $noteId, array $data): SDKModel\Note
    {
        /** @var SDKModel\Note $note */
        $note = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'patch',
            sprintf("/note/%s", $noteId),
            $data,
            $this->getAuthHeader($apiKey)
        );

        return $note;
    }

    public function list(string $apiKey, array $data): SDKModel\Collection\CollectionData
    {
        if (!isset($data['page'])) {
            $data['page'] = 1;
        }

        if (!isset($data['limit'])) {
            $data['limit'] = 10;
        }

        /** @var SDKModel\Collection\CollectionData::class $noteList */
        $noteList = $this->client->requestWithFillModel(
            SDKModel\Collection\CollectionData::class,
            'get',
            '/note',
            $data,
            $this->getAuthHeader($apiKey)
        );

        return $noteList;
    }
}
