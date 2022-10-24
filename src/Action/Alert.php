<?php

namespace IvankoTut\NotebookSdk\Action;

use IvankoTut\NotebookSdk\ApiClient;
use IvankoTut\NotebookSdk\Model as SDKModel;

class Alert extends AbstractAction
{
    public const MODEL_TO_FILL = SDKModel\Alert::class;

    public function __construct(private readonly ApiClient $client)
    {
    }

    /**
     * @param string $apiKey
     * @param array $data ['text' => 'Alert text', 'startAt' => '25.11.2022 12:45']
     *
     * @return SDKModel\Alert
     */
    public function create(string $apiKey, array $data): SDKModel\Alert
    {
        /** @var SDKModel\Alert::class $alert*/
        $alert = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'post',
            '/alert',
            $data,
            $this->getAuthHeader($apiKey)
        );

        return $alert;
    }

    /**
     * Перенос даты напоминания
     * @param array $data ['text' => 'Alert text', 'startAt' => '25.11.2022 12:45']
     */
    public function edit(string $apiKey, int $alertId, array $data): SDKModel\Alert
    {
        /** @var SDKModel\Alert::class $alert*/
        $alert = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'patch',
            sprintf("/alert/%s", $alertId),
            $data,
            $this->getAuthHeader($apiKey)
        );

        return $alert;
    }

    /**
     * Удаление напоминания
     */
    public function delete(string $apiKey, int $alertId): void
    {
        $this->client->request(
            'delete',
            sprintf("/alert/%s", $alertId),
            null,
            $this->getAuthHeader($apiKey)
        );
    }
}
