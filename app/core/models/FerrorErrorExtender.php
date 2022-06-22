<?php

namespace models;

use Error;
use interfaces\FerrorInterfaceHandler;

class FerrorErrorExtender extends Error implements FerrorInterfaceHandler
{

    protected $mFile;
    protected $mMessage;
    protected $mCode;
    protected $mLine;

    public function __construct($errors)
    {
        $this->mFile = $errors->getFile();
        $this->mMessage = $errors->getMessage();
        $this->mCode = $errors->getCode();
        $this->mLine = $errors->getLine();
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
