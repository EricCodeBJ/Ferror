<?php

/**
 * 
 * FerrorExceptionModel
 * 
 * Extend the Exception class which is essential to retrieve 
 * the protected methods and properties of this class 
 * and display them in my template.
 * 
 */

namespace Ferror\Core\Models;

use Exception;
use Ferror\Core\Interfaces\FerrorInterface;

class FerrorExceptionModel extends Exception implements FerrorInterface

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

    public function getErrorMessage(): string
    {
        return $this->mMessage;
    }

    public function getErrorCode(): int
    {
        return (int) $this->mCode;
    }

    public function getErrorFile(): string
    {
        return $this->mFile;
    }

    public function getErrorLine(): int
    {
        return (int) $this->mLine;
    }
}
