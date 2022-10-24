<?php

namespace IvankoTut\NotebookSdk\Model;

/**
 * Представление тега
 */
class Note
{
    /**
     * ИД записи в системе
     */
    public int $id;

    /**
     * Запись
     */
    public string $note;

    /**
     * Телеграм пользователь, которому принадлежит запись
     */
    public TelegramUser $telegramUser;

    /**
     * Тег, которому принадлежит запись
     */
    public Tag $tag;
}
