<?php

/**
 * Accessesses the database connection credential by reading the setting.conf file.
 * returns an associative array with the connection credetions.
 * 
 * @return array
 */
function getDbCredentials()
{    
    $settings = __DIR__."/../settings.json";
    $settingsArray = json_decode(file_get_contents($settings), true);
    return $settingsArray;
}


