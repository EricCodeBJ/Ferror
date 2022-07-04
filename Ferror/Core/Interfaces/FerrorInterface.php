<?php

/**
 * 
 * FerrorInterface
 * 
 * Interface that indicates the essential methods to be implemented 
 * by custom classes that inherit respectively from the Error 
 * and Exception class
 * 
 */

namespace Ferror\Core\Interfaces;

interface FerrorInterface
{
    public function getErrorMessage(): string;

    public function getErrorCode(): int;

    public function getErrorFile(): string;

    public function getErrorLine(): int;
}
