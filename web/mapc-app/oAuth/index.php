<?php
{ // BLOCK:get_controller:20150825:컨트롤러 불러오기

    /**
     *
     * Get Controller
     *
     */
    include(__DIR__ . DS . 'controllers' . DS . $ROUTES['module'] . 'Controller.php');

} // BLOCK

{ // BLOCK:publish:20150825:출력처리

    /**
     *
     * Get VIEW file and publish
     *
     */
    include(__DIR__ . DS . 'views' . DS . $ROUTES['module'] . 'View.php');

} // BLOCK

// end of file
