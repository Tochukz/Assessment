<?php
/**
 * This file defines the CLI of the framework.
 * Start by mapping a command to a class method under the commands section ot settings.json file.
 * When you run the command like this: php console.php mycommand, the method defined will be executed.
 */

if($argc < 2){
    echo "No argument passed\n";
    exit;
}
require_once('autoload.php');

//getCommands() is a helper function that get all the cli commands registered in the setting.json file
$commands = getCommands();

/*Find the class mapped by the command and execute the method */
if(isset($argv[2]) && stristr($argv[2], 'help')) {
    echo  getHelp($argv[1]);
}elseif(stristr($argv[1], 'help')){
    ksort($commands);
    foreach($commands as $command=>$class){
        echo "Command: ".$command."\n";
        echo getHelp($command);
        echo "--------------------------------------------------\n";
    }   
    exit;
}elseif(array_key_exists($argv[1], $commands)){
    $classMethod = $commands[$argv[1]];
    $classAndMethod = explode("@", $classMethod);
    $class = "Console\\".$classAndMethod[0];
    $method = $classAndMethod[1];
    $obj = new $class();
    $methodArg = $argv[2]?? null;
    return $obj->$method($methodArg);
}else{
    echo "The command ".$argv[1]." is not defined\n";
}

