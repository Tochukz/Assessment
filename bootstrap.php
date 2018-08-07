<?php
require_once('autoload.php');

/**
 * Loading all the helper functions defined in the files under the Helpers directory.
 * This will make the functions accessable throughout the application.
 */
function loadHelpers()
{
    $helperDir = __DIR__."/Helpers";
    $dirHandle = opendir($helperDir);    
    while($fileOrDir = readdir($dirHandle)){
        if(!is_dir($fileOrDir)){        
            $fileDir = $helperDir.'/'.$fileOrDir;
            require_once($fileDir);
        }
    }

}

loadHelpers();

// echo $_SERVER['REQUEST_METHOD'];
// exit;
require_once('routes.php');

App\Route::mapRoute();