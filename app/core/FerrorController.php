<?php

namespace Mido\libs;

class CustomError
{
    public const DEBUG_MODE_ON = 1;
    public const DEBUG_MODE_OFF = 0;

    private static $instance;
    private $debug_mode;

    public function __construct()
    {
    }

    public static function active(int $debug_mode = 0)
    {
        self::getInstance()->$debug_mode = $debug_mode;
        set_error_handler(array(self::getInstance(), "errorHandler"));
        set_exception_handler(array(self::getInstance(), "exceptionHandler"));
    }

    public static function errorHandler($errorCode, $errorMessage, $errorFile, $errorLine)
    {
        print_r($errorCode . "<br>");
        print_r($errorMessage . "<br>");
        print_r($errorFile . "<br>");
        print_r($errorLine . "<br>");

        die();
    }

    public static function exceptionHandler($e)
    {
        die();
    }

    private static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
