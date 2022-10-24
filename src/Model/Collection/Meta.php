<?php

namespace IvankoTut\NotebookSdk\Model\Collection;

/**
 * Представление данных пагинации
 */
class Meta
{
    /**
     * Текущая страница
     */
    public int $page;

    /**
     * Кол-во записей на страницу
     */
    public int $countItemPage;

    /**
     * Общее число записей
     */
    public int $totalItems;

    public function getCountPages(): int
    {
        return ceil($this->totalItems / $this->countItemPage);
    }
}
