<?php

namespace helper;

class  FerrorUtility
{
    private static $datas;

    public function __construct(array &$data)
    {
        self::$datas = &$data;
        $this->getBasename();
        $this->getGlobalsArray();
        $this->getFileContent();
        $this->getFileName();
    }

    private function getBasename()
    {
        $DOCUMENT_ROOT = $this->sanitizePath($_SERVER["DOCUMENT_ROOT"]);
        $HTTP_HOST = $this->sanitizePath($_SERVER["HTTP_HOST"]);
        $DIR = $this->sanitizePath(__DIR__);
        $basename = str_replace($DOCUMENT_ROOT, $HTTP_HOST, $DIR);
        $basename = "http:" . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . dirname($basename, 2) . DIRECTORY_SEPARATOR . "main" . DIRECTORY_SEPARATOR;  // Going back to app folder
        self::$datas["extra"]["basename"] = $basename;
    }

    public function getGlobalsArray()
    {
        $globalMenus = "";
        $gblobalUserMenu = "";
        $globalDatas = "";
        $gblobalUserDatas = "";
        $gblobalUserDatasArray = "";
        $gblobalUserDatasConstantes = "";
        $gloobalArray = ["_COOKIE", "_ENV", "_FILES", "_GET", "_POST", "_REQUEST", "_SERVER", "_SESSION"];

        foreach ($GLOBALS as $key => $values) {
            if (in_array(strtoupper($key), $gloobalArray)) {
                $dot = !empty($values) ? "..." : "";
                $globalMenus .= "<li data-target-global='$key'> $$key [$dot]</li>";
                $globalDatas .= '<div data-globals="' . $key . '" class="codeBlock invisible"> <pre data-enlighter-language="json"  data-enlighter-indent="2" data-enlighter-theme="bootstrap4">' . json_encode($values, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</pre></div>';
            } else {
                $gblobalUserMenu .= "$$key, ";
                $gblobalUserDatasArray .=   "// " . ucfirst(gettype($values)) . (is_object($values) ? " : " . get_class($values) : "") .
                    "\n $" . $key . " = " . $this->formatVariableType($values) .
                    "\n\n";
            }
        }

        // get Constantes gblobalUserMenuConstantes, gblobalUserDatasConstantes
        $gblobalUserMenuConstantes = "";
        if (!empty(get_defined_constants(true)["user"])) {
            foreach (get_defined_constants(true)["user"] as $constanteKey => $constanteValue) {
                $gblobalUserDatasConstantes .= "// " . ucfirst(gettype($constanteValue)) . (is_object($constanteValue) ? " : " . get_class($constanteValue) : "") . "\n $" . $constanteKey . " = " . $this->formatVariableType($constanteValue) . "\n\n";
                $gblobalUserMenuConstantes .= "$constanteKey, ";
            }
        }

        $gblobalUserMenuConstantes = substr($gblobalUserMenuConstantes, 0, strlen($gblobalUserMenuConstantes) - 2); // Remove last coma
        if (strlen($gblobalUserMenuConstantes) > 25) {
            $gblobalUserMenuConstantes = "..." . substr($gblobalUserMenuConstantes, strlen($gblobalUserMenuConstantes) - 22, null);
        }

        $gblobalUserMenu = substr($gblobalUserMenu, 0, strlen($gblobalUserMenu) - 2); // Remove last coma
        if (strlen($gblobalUserMenu) > 25) {
            $gblobalUserMenu = "..." . substr($gblobalUserMenu, strlen($gblobalUserMenu) - 22, null);
        }

        $gblobalUserDatas = '<div data-globals="all-variables" class="codeBlock invisible"> <pre data-enlighter-language="php"  data-enlighter-indent="2" data-enlighter-theme="bootstrap4">' . $gblobalUserDatasArray . '</pre></div>';
        $gblobalUserDatasConstantes = '<div data-globals="all-constantes" class="codeBlock invisible"> <pre data-enlighter-language="php"  data-enlighter-indent="2" data-enlighter-theme="bootstrap4">' . $gblobalUserDatasConstantes . '</pre></div>';
        self::$datas["extra"]["globalMenus"] = $globalMenus;
        self::$datas["extra"]["gblobalUserMenuVariables"] = $gblobalUserMenu;
        self::$datas["extra"]["gblobalUserMenuConstantes"] = $gblobalUserMenuConstantes;
        self::$datas["extra"]["gblobalUserDatas"] = $gblobalUserDatas;
        self::$datas["extra"]["gblobalUserDatasConstantes"] = $gblobalUserDatasConstantes;
        self::$datas["extra"]["globalDatas"] = $globalDatas;
    }

    public function getFileContent()
    {
        // Get file content around the error
        $fileContent = "";
        $handle = fopen(self::$datas["errorFile"], "r");
        $fileOffset = -1;
        if ($handle) {
            $currentLine = 1;

            while (($line = fgets($handle))) {

                if ($currentLine >= intval(self::$datas["errorLine"]) - 15 && $currentLine <= intval(self::$datas["errorLine"]) + 15) {
                    $fileOffset = $fileOffset == -1 ? $currentLine : $fileOffset;
                    /*
                        I added three ellipsis because the code colorator trims the empty lines 
                        and it shifts the target line of the error
                    */
                    if (empty(trim($fileContent)) && empty(trim($line))) {
                        $line .= ". . .\n";
                    }
                    $fileContent .= $line;
                }

                $currentLine++;
            }

            fclose($handle);
        } else {
            $fileOffset = 0;
        }

        self::$datas["extra"]["fileOffset"] = $fileOffset;
        self::$datas["extra"]["fileContent"] = $fileContent;
    }

    public function getFileName()
    {
        $filename = self::$datas["errorFile"];
        $fileNameOnLine = $filename . ":" . self::$datas["errorLine"];


        // File name and Error line concatenation without exceeding 25 character
        if (strlen($fileNameOnLine) >= 45) {
            $fileNameOnLine =  "..." . substr($filename, strlen($filename) - (41 - strlen(self::$datas["errorLine"])), strlen($filename) - 1) . ":" . self::$datas["errorLine"];
        }

        self::$datas["extra"]["fileNameOnLine"] = $fileNameOnLine;
    }

    public function sanitizePath(string $path): string
    {
        $pathCopy = preg_replace('/[\/]/', DIRECTORY_SEPARATOR, $path); // Removing slash (/)
        $pathCopy = preg_replace('/\\\\/', DIRECTORY_SEPARATOR, $pathCopy); // Removing backSlash (\)
        return $pathCopy;
    }

    public function formatVariableType($variables)
    {
        $formattedVariables = "";
        $variableTyype = strtolower(strval(gettype($variables)));

        switch ($variableTyype) {
            case "boolean":
                $formattedVariables = $variables ? "true" : "false";
                break;
            case "integer":
            case "double":
            case "resource":
                $formattedVariables = $variables;
                break;
            case "string":
                $formattedVariables = '"' . str_replace('"', '\"', $variables) . '"';
                break;
            case "array":
            case "object":
                $formattedVariables = json_encode($variables, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

                break;
            case "null":
                $formattedVariables = "NULL";
                break;
        }
        return "$formattedVariables;";
    }
}
