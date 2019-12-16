<?php
spl_autoload_register(function($className) {

    $classArray = explode("\\", $className);
    $fileName   = APP_PATH . $classArray[1] . DS . 'models' . DS . $classArray[2] . 'Model.php';

    if($classArray[0] == 'Mapc' && file_exists($fileName)) {
        include_once $fileName;
    }

});

// this is it
