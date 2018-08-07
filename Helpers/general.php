<?php
function view($templateChain, $array = null){
    if($array != null){
        foreach($array as $key=>$value){          
            $$key = $value;
        }
    }
    $template = str_replace('.', '/', $templateChain);
    require_once(__DIR__.'/../Views/'.$template.'.php');
}