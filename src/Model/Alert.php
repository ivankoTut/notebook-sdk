<?php

namespace IvankoTut\NotebookSdk\Model;

/**
 * Представление напоминания
 */
class Alert
{
    /**
     * ИД записи в системе
     */
    public int $id;

    /**
     * Запись
     */
    public string $text;

    /**
     * Дата отправки напоминания
     */
    public \DateTimeInterface $startAt;

    /**
     * Кол-во отправленных напоминаний
     */
    public ?int $countAlerting = null;

    /**
     * Телеграм пользователь, которому принадлежит запись
     */
    public TelegramUser $telegramUser;
}
