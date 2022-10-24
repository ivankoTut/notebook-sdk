<?php

namespace IvankoTut\NotebookSdk\Exception;

use Exception;

class ApiException extends Exception
{
    public function __construct($message = "", Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}