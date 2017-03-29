<?php

require("includes/autoload.php");

/*
set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});*/

try
{
    $ds = new DataSource("test","sercan02","173.236.78.206","adhoc");
    
    

}
catch (Exception $e)
{
    var_dump($e->getMessage());
}

