<?php

namespace models;

use Exception;
use interfaces\FerrorInterfaceHandler;

class FerrorExceptionExtender extends Exception implements FerrorInterfaceHandler

{
    protected $mFile;
    protected $mMessage;
    protected $mCode;
    protected $mLine;

    public function __construct($errors)
    {
        $this->mFile = $errors->file;
        $this->mMessage = $errors->message;
        $this->mCode = 0;
        $this->mLine = $errors->line;
    }

    public function getErrorMessage()
    {
        return $this->mMessage;
    }

    public function getErrorCode()
    {
        return $this->mCode;
    }

    public function getErrorFile()
    {
        return $this->mFile;
    }

    public function getErrorLine()
    {
        return $this->mLine;
    }
}
