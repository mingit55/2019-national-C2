<?php
function classLoader($namespace){
    $filepath = SRC. "/". $namespace. ".php";
    if( is_file($filepath) ){
        require $filepath;
    }
}

spl_autoload_register("classLoader");