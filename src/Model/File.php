<?php

namespace IvankoTut\NotebookSdk\Model;

/**
 * Представление файлов
 */
class File
{
    /**
     * ИД записи в системе
     */
    public int $id;

    /**
     * Название файла
     */
    public string $name;

    /**
     * Описание файла
     */
    public ?string $caption = null;

    /**
     * Тип файла
     */
    public ?string $mimeType = null;

    /**
     * Идентификатор файла в телеграм
     */
    public ?string $fileId = null;

    /**
     * Уникальный идентификатор файла в телеграм
     */
    public ?string $fileUniqueId = null;

    /**
     * Уникальный идентификатор файла в телеграм
     */
    public ?int $fileSize = null;

    /**
     * Телеграм пользователь, которому принадлежит запись
     */
    public TelegramUser $telegramUser;
}
