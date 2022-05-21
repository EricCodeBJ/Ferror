<?php

namespace ExceptionExtender;

use Error;
use PDOException;

class FerrorExceptionExtender extends PDOException
{
    public function __construct($errors)
    {
        $this->file = $errors->file;
        $this->message = $errors->message;
        $this->code = $errors->code;
        $this->line = $errors->line;
    }

    public function getErrorMessage()
    {
        return $this->message;
    }

    public function getErrorCode()
    {
        return $this->code;
    }

    public function getErrorFile()
    {
        return $this->file;
    }

    public function getErrorLine()
    {
        return $this->line;
    }
}
