<?php

namespace IvankoTut\NotebookSdk\Model;

/**
 * Представление данных телеграм-пользователя
 */
class TelegramUser
{
    /**
     * ИД пользователя в системе
     */
    public int $id;

    /**
     * ИД пользователя в телеграм
     */
    public ?string $telegramId = null;

    /**
     * Имя пользователя в телеграм
     */
    public string $firstName;

    /**
     * Апи ключ для доступа к сервису записок
     */
    public string $apiKey;

    /**
     * Фамилия пользователя в телеграм
     */
    public ?string $lastName = null;

    /**
     * Логин пользователя в телеграм
     */
    public ?string $username = null;
}
