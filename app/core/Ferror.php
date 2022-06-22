<?php

namespace Ferror;

use models\FerrorErrorExtender;
use models\FerrorExceptionExtender;
use helper\FerrorUtility;

class Ferror
{
    /**
     * DEBUG MOD
     * 1 = Activate
     * 0 = Desactivate 
     */
    public const DEBUG_MODE_ON = 1;
    public const DEBUG_MODE_OFF = 0;

    public const APP_NAME = "ferror";

    private static $shutdownCalledStatut = false;

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

    private function __construct()
    {
    }

    public static function register(int $debug_mode = self::DEBUG_MODE_ON)
    {
        if ($debug_mode === self::DEBUG_MODE_ON) {
            spl_autoload_register([self::getInstance(), "autoloader"]);
            set_error_handler(array(self::getInstance(), "errorHandler"));
            set_exception_handler(array(self::getInstance(), "exceptionHandler"));
            //register_shutdown_function(array(self::getInstance(), "shutdownHandler"));
        }
    }

    public static function autoloader(String $className)
    {
        if (strpos(strtolower($className), self::APP_NAME) !== false) {
            require_once  __DIR__ . DIRECTORY_SEPARATOR . $className . ".php";
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

    public static function shutdownHandler()
    {
        // && !self::$shutdownCalledStatut
        echo "zzzz";
        $lasterror = error_get_last();

        if (!empty($lasterror)) {
            switch ($lasterror['type']) {
                case E_ERROR:
                case E_CORE_ERROR:
                case E_COMPILE_ERROR:
                case E_USER_ERROR:
                case E_RECOVERABLE_ERROR:
                case E_CORE_WARNING:
                case E_COMPILE_WARNING:
                case E_PARSE:
                    self::$arrayErorr["errorCode"] = $lasterror['type'];
                    self::$arrayErorr["errorFile"] = $lasterror['file'];
                    self::$arrayErorr["errorLine"] = $lasterror['line'];
                    self::$arrayErorr["errorType"] =  in_array($lasterror['type'], self::$arrayErorrCodeToType) ? self::$arrayErorrCodeToType[$lasterror['type']]  : "Warning";
                    self::$arrayErorr["errorMessage"] = $lasterror['message'];
                    self::render(self::$arrayErorr);
            }
        }
    }

    public static function exceptionHandler($e)
    {
        if (!empty($e)) {

            if (strpos(strtolower(get_class($e)), "exception") !== false) {
                $i = new FerrorExceptionExtender($e);
            } else {
                $i = new FerrorErrorExtender($e);
            }

            self::$arrayErorr["errorCode"] = $i->getErrorCode();
            self::$arrayErorr["errorMessage"] = $i->getErrorMessage();
            self::$arrayErorr["errorFile"] = $i->getErrorFile();
            self::$arrayErorr["errorLine"] = $i->getErrorLine();
            self::$arrayErorr["errorType"] = in_array($i->getErrorCode(), self::$arrayErorrCodeToType) ? self::$arrayErorrCodeToType[$i->getErrorCode()]  : "Warning";
            self::render(self::$arrayErorr);
        }
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
        $ii = $data;

        // Clean previous output
        if (ob_get_length()) {
            ob_end_clean();
        }


        ob_start();

        // Loading error diagnosis data for the view
        new FerrorUtility($data);

        require_once dirname(__FILE__) . "../../main/template.php";

        $getContents = ob_get_contents();

        ob_end_clean();

        echo $getContents;
    }

    public static function var_dumps($info)
    {
        echo "<pre>";
        print_r($info);
        echo "</pre>";
    }
}
