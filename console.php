<?php
/**
 * This file powers the CLI of the framework.
 * Start by mapping a command to a class method under the commands section ot settings.json file.
 * When you run the command like this: php console.php mycommand, the method defined will be executed.
 */
require_once('bootstrap.php');

if($argc <= 1){
    echo 'No argument passed\n';
    return false;
}

$commands = getCommands();

/*Find the class mapped by the command and execute the method */
if(array_key_exists($argv[1], $commands)){
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