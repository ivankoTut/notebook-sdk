<?php

namespace IvankoTut\NotebookSdk\Model;

/**
 * Представление тега
 */
class Tag
{
    /**
     * ИД тег в системе
     */
    public int $id;

    /**
     * Имя тега
     */
    public string $name;

    /**
     * Телеграм пользователь, которому принадлежит тег
     */
    public TelegramUser $telegramUser;
}
