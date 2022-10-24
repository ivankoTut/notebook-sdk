<?php

namespace IvankoTut\NotebookSdk\Action;

use IvankoTut\NotebookSdk\ApiClient;
use IvankoTut\NotebookSdk\Model as SDKModel;

class TelegramUser extends AbstractAction
{
    public const MODEL_TO_FILL = SDKModel\TelegramUser::class;
    public const HEADER_API_KEY_NAME = 'NOTEBOOK-AUTH-USER-X';

    public function __construct(private readonly ApiClient $client)
    {
    }

    public function getByTelegramId(string $apyKey, int $telegramUserId): SDKModel\TelegramUser
    {
        /** @var SDKModel\TelegramUser $telegramUser */
        $telegramUser = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'get',
            sprintf("/telegram-user/%s/telegram-id", $telegramUserId),
            null,
            [
                'headers' => [
                    self::HEADER_API_KEY_NAME => $apyKey
                ]
            ],
        );

        return $telegramUser;
    }

    /**
     * [
     *  'telegramId' => '11111',
     *  'firstName' => 'Nest'
     *  'lastName' => 'Nest'
     *  'username' => 'Nest'
     * ]
     */
    public function createTelegramUser(string $apyKey, array $data): SDKModel\TelegramUser
    {
        /** @var SDKModel\TelegramUser $telegramUser */
        $telegramUser = $this->client->requestWithFillModel(
            self::MODEL_TO_FILL,
            'post',
            '/telegram-user',
            $data,
            [
                'headers' => [
                    self::HEADER_API_KEY_NAME => $apyKey
                ]
            ],
        );

        return $telegramUser;
    }
}
