<?php
require_once('autoload.php');
require_once('routes.php');
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