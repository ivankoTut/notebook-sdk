<?php

namespace IvankoTut\NotebookSdk\Action;

use IvankoTut\NotebookSdk\ApiClient;
use IvankoTut\NotebookSdk\Model as SDKModel;

class File extends AbstractAction
{
    public const MODEL_TO_FILL = SDKModel\File::class;

    public function __construct(private readonly ApiClient $client)
    {
    }

    /**
     * @param string $apiKey
     * @param array $data
     * [
     *      'caption' => 'описание файла',
     *      'name' => 'имя файла',
     *      'mimeType' => 'тип файла',
     *      'fileId' => 'идентификатор файла',
     *      'fileUniqueId' => 'уникальный идентификатор файла',
     *      'fileSize' => 'размер файла',
     * ]
     *
     * @return SDKModel\File
     */
    public function create(string $apiKey, array $data): SDKModel\File
    {
        /** @var SDKModel\File::class $alert*/
        $alert = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'post',
            '/file',
            $data,
            $this->getAuthHeader($apiKey)
        );

        return $alert;
    }

    /**
     * @param string $apiKey
     * @param string $query
     *
     * @return SDKModel\Collection\CollectionData
     */
    public function search(string $apiKey, string $query): SDKModel\Collection\CollectionData
    {
        /** @var SDKModel\File::class $alert*/
        $alert = $this->client->requestWithFillModel(
            SDKModel\Collection\CollectionData::class,
            'get',
            '/file?query=' . urlencode($query),
            null,
            $this->getAuthHeader($apiKey)
        );

        return $alert;
    }
}
