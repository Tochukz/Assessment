<?php
/**
 * The file powers the CLI of the application.
 * Start by mapping a command to the class method under the commands section ot settings.json file.
 * When you run the command like this: php console.php mycommand, the method defined is executed.
 */
require_once('bootstrap.php');

if($argc <= 1){
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
    return $obj->$method();
}else{
    echo "The command ".$argv[1]." is not defined\n";
}