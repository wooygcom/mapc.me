<?php
spl_autoload_register(function($className) {

    $classArray = explode("\\", strtolower($className));
    $fileName   = APP_PATH . $classArray[1] . DS . 'models' . DS . $classArray[2] . 'Model.php';
    if($classArray[0] == 'mapc' && file_exists($fileName)) {
        include_once $fileName;
    } else {
        echo 'Error:' . $className;
        exit;
    }

});

// this is it
