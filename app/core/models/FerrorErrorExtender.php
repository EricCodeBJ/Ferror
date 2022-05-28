<?php

namespace models;

use Error;
use interfaces\FerrorInterfaceHandler;

class FerrorErrorExtender extends Error implements FerrorInterfaceHandler
{

    protected $mFile;
    protected $mMessages;
    protected $mCodes;
    protected $mLines;

    public function __construct($errors)
    {
        echo "sd";
        var_dump($errors);
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
