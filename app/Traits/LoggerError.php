<?php

namespace App\Traits;

use Exception;

trait LoggerError
{
    function logErrors(Exception $exception): void
    {
        logger([
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ]);
    }
}
