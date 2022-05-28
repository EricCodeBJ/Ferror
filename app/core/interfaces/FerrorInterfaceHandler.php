<?php

namespace interfaces;

interface FerrorInterfaceHandler
{
    public function getErrorMessage();

    public function getErrorCode();

    public function getErrorFile();

    public function getErrorLine();
}
