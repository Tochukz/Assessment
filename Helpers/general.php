<?php

/**
 * Returns a specified template for display.
 * The elements of the array passed to the template becomes individual variables accessable in the template.
 * 
 * @param string $templateChain
 * @param array $array
 * @return void
 */
function view($templateChain, $array = null){
    if($array != null){
        foreach($array as $key=>$value){          
            $$key = $value;
        }
    }
    $template = str_replace('.', '/', $templateChain);
    require_once(__DIR__.'/../Views/'.$template.'.php');
}

/**
 * Build an array of all the files in a given directory.
 * 
 * @param string $dirName
 * @return array
 */
function getAllFiles($dirName){
    $files = [];
    try{
        $dirHandle = opendir( __DIR__.'/../'.$dirName);
        while($fileOrDir = readdir($dirHandle)){
            if(is_dir($fileOrDir)){
                continue;
            }
            $files[] = $dirName.'/'.$fileOrDir;
        }
        closedir($dirHandle);
    }catch(\Exception $ex){
       echo $ex->getMessage();
       exit;
    }
    return $files;
}

/**
 * Build an array of all the class defined in a given diretory
 * It is assumed that your class name and the name of the file holding the class is the same e.g User and User.php.
 * 
 * @param string $dirName
 * @return array
 */
function getAllClasses(string $dirName){
    $files = getAllFiles($dirName);
    $classes = array_map(function($file){
        return str_replace("/", "\\", substr($file, 0, strlen($file)-4));
    }, $files);
    return $classes;
}

/**
 * Returns the settings.json file content as an array
 * @return array
 */
function getSettings()
{
    $settings = __DIR__."/../settings.json";
    $settingsArray = json_decode(file_get_contents($settings), true);
    return $settingsArray;
}

/**
 * Accessesses the database connection credential by reading the setting.conf file.
 * returns an associative array with the connection credetions.
 * 
 * @return array
 */
function getDbCredentials()
{    
    return getSettings()['database'];
}

/**
 * Returns an array of the commands registered in the settings.json file.
 * 
 * @return array
 */
function getCommands()
{
    return getSettings()['commands'];
}
