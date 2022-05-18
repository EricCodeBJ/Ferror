<?php

namespace Ferror\Controllers;

class FerrorController
{
    /**
     * DEBUG MOD Activate par default
     */
    public const DEBUG_MODE_ON = 1;
    /**
     * DEBUG MOD InActivate
     */
    public const DEBUG_MODE_OFF = 0;
    /**
     * Langue francaise
     */
    public const LANG_FR = "fr";
    /**
     * English language
     */
    public const LANG_EN = "en";
    /**
     * English language
     */
    public const LIGHT_MODE = "light";
    /**
     * English language
     */
    public const DARK_MODE = "dark";

    private static array $arrayErorr =  [
        "errorCode" => null,
        "errorMessage" => null,
        "errorFile" => null,
        "errorLine" => null,
        "errorType" => null
    ];

    private static array $arrayErorrCodeToType =  [
        E_WARNING => "Warning",
        E_USER_WARNING => "Warning",
        E_CORE_WARNING => "Warning",
        E_COMPILE_WARNING => "Warning",
        E_ERROR => "Fatal",
        E_CORE_ERROR => "Fatal",
        E_COMPILE_ERROR => "Fatal",
        E_PARSE => "Fatal",
        E_USER_ERROR => "Error",
        E_RECOVERABLE_ERROR => "Error",
        E_NOTICE => "Info",
        E_USER_NOTICE => "Info",
        E_STRICT => "Debug"
    ];

    private static $instance;
    private $debug_mode;

    private function __construct()
    {
    }

    public static function active(int $debug_mode = 1)
    {
        if ($debug_mode === self::DEBUG_MODE_ON) {
            self::getInstance()->$debug_mode = $debug_mode;
            set_error_handler(array(self::getInstance(), "errorHandler"));
            set_exception_handler(array(self::getInstance(), "exceptionHandler"));
        }
    }

    public static function errorHandler($errorCode, $errorMessage, $errorFile, $errorLine)
    {
        self::$arrayErorr["errorCode"] = $errorCode;
        self::$arrayErorr["errorMessage"] = $errorMessage;
        self::$arrayErorr["errorFile"] = $errorFile;
        self::$arrayErorr["errorLine"] = $errorLine;
        self::$arrayErorr["errorType"] =  in_array($errorCode, self::$arrayErorrCodeToType) ? self::$arrayErorrCodeToType[$errorCode]  : "Warning";

        self::render(self::$arrayErorr);
    }


    public static function exceptionHandler($e)
    {
        self::$arrayErorr["errorCode"] = $e["code"];
        self::$arrayErorr["errorMessage"] = $e["message"];
        self::$arrayErorr["errorFile"] = $e["file"];
        self::$arrayErorr["errorLine"] = $e["line"];
        self::$arrayErorr["errorType"] =  in_array($e[""], self::$arrayErorrCodeToType) ? self::$arrayErorrCodeToType[$e["code"]]  : "Warning";

        self::render(self::$arrayErorr);
    }

    private static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private static function render(array $data)
    {

        if (  ) 
        {

        }

        if ( true ) 
        {
            die();
        }
    }
}
