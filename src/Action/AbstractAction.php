<?php

namespace IvankoTut\NotebookSdk\Action;

abstract class AbstractAction
{
    public const HEADER_API_KEY_NAME = 'API-KEY';

    public function getAuthHeader(string $apiKey, bool $onlyApiHeader = false): array
    {
        if ($onlyApiHeader) {
            return [
                self::HEADER_API_KEY_NAME => $apiKey
            ];
        }

        return [
            'headers' => [
                self::HEADER_API_KEY_NAME => $apiKey
            ]
        ];
    }
}
