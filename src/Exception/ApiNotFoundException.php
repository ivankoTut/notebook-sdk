<?php

namespace IvankoTut\NotebookSdk\Exception;

/**
 * Запрошенные данные не найдены
 */
class ApiNotFoundException extends ApiException
{
    public const ERROR_CODE = 404;
}
