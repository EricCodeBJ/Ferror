<?php

namespace Ferror\Core;

use Ferror\Core\Helpers\FerrorHelpers;
use Ferror\Core\Models\FerrorErrorModel;
use Ferror\Core\Models\FerrorExceptionModel;

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






    /**
     * 
     *  register
     *
     *  Used to enable or register custom PHP error or exception catchers
     *  This method calls the following functions 
     *  for its operation: spl_autoload_register, set_error_handler, set_exception_handler
     * 
     *  @param [int] $debug_mode 0|1
     *  @return void
     * 
     */
    public static function register(int $debug_mode = self::DEBUG_MODE_ON)
    {
        if ($debug_mode === self::DEBUG_MODE_ON) {
            set_error_handler(array(self::getInstance(), "errorHandler"));
            set_exception_handler(array(self::getInstance(), "exceptionHandler"));
        }
    }





    // Custom error listening method
    public static function errorHandler($errorCode, $errorMessage, $errorFile, $errorLine)
    {
        self::$arrayErorr["errorCode"] = $errorCode;
        self::$arrayErorr["errorMessage"] = $errorMessage;
        self::$arrayErorr["errorFile"] = $errorFile;
        self::$arrayErorr["errorLine"] = $errorLine;
        self::$arrayErorr["errorType"] =  in_array($errorCode, self::$arrayErorrCodeToType) ? self::$arrayErorrCodeToType[$errorCode]  : "Warning";

        self::render(self::$arrayErorr);
    }





    // Custom exception listening method
    public static function exceptionHandler($e)
    {
        if (!empty($e)) {
            if (strpos(strtolower(get_class($e)), "exception") !== false) {
                $i = new FerrorExceptionModel($e);
            } else {
                $i = new FerrorErrorModel($e);
            }

            self::$arrayErorr["errorCode"] = $i->getErrorCode();
            self::$arrayErorr["errorMessage"] = $i->getErrorMessage();
            self::$arrayErorr["errorFile"] = $i->getErrorFile();
            self::$arrayErorr["errorLine"] = $i->getErrorLine();
            self::$arrayErorr["errorType"] = in_array($i->getErrorCode(), self::$arrayErorrCodeToType) ? self::$arrayErorrCodeToType[$i->getErrorCode()]  : "Warning";
            self::render(self::$arrayErorr);
        }
    }





    // To get a single unique instance of the class
    private static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }





    /**
     * 
     *  render
     *
     *  To return to the user's screen, the view that should display 
     *  details about the error or exception encountered 
     *  while executing the code.
     * 
     *  @param array $data 
     *  @return void
     * 
     */
    private static function render(array $data)
    {
        // Clean previous output
        if (ob_get_length()) {
            ob_end_clean();
        }

        ob_start();

        /**
         * 
         * Loading error diagnosis data for the view
         * such as (user varibles & constantes, GLOBALES...)
         * 
         */
        new FerrorHelpers($data);

        require_once dirname(__FILE__) . "../../Resources/template.php";

        $getContents = ob_get_contents();

        ob_end_clean();

        echo $getContents;
    }
}
