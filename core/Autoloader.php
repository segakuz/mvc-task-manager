<?php

spl_autoload_register(function ($class_name) 
{
	$directories = [
        'backend/views/',
        'backend/models/',
        'backend/controllers/',           
        'core/',           
        ];
    foreach($directories as $directory) 
    {
        if(file_exists($directory.$class_name . '.php')) 
        {
            require_once($directory.$class_name . '.php');
        } else {
            //echo "Класс ".$class_name ." не найден.";
        }          
    }
});