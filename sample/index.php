<?php

use Mido\libs\CustomError;

require_once "CustomError.php";

CustomError::active(CustomError::DEBUG_MODE_ON);

$info = [];

$info[] = "a";

echo $info[1];
