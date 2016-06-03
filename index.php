<?php
spl_autoload_register(function($name) {
    foreach (array("$name.php", "BusinessLogic/$name.php", "Controllers/$name.php", "Models/$name.php")
    as $file)
        if(file_exists($file)) {
            require_once($file);
            return;
        }
    
}); //autoload classes
Controller::handleRequest();