<?php
/**
 * Created by PhpStorm.
 * User: kojiflowers
 * Date: 2/22/17
 * Time: 7:26 AM
 */


define('BUILDER_PATH','builder');

spl_autoload_register(function($className)
{

    $directories = array('builder');
    $namespace=str_replace("\\","/",__NAMESPACE__);
    $className=str_replace("\\","/",$className);

    foreach($directories as $directory){
        $class= $directory.'/'.$className.".php";
        if(file_exists($class)){
            include_once($class);
        }
    }
});