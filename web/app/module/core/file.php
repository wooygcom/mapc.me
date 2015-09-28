<?php

include(INIT_PATH . 'init.core.php');

{ // MODEL : HEAD

    $file = $_GET['file'];
    $hash = $_GET['hash'];

    $file_real = DATA_PATH . $file;

} // MODEL : TAIL

{ // VIEW : HEAD

    $finfo = new finfo(FILEINFO_MIME);
    $type  = $finfo->file($file_real);

    $fp = fopen($file_real);

    // send the right headers
    header('Content-Type:' . $type);
    header('Content-Length:' . filesize($file_real));

    // dump the file and stop the script
    readfile($file_real);
    exit;

    fclose($fp);

} // VIEW : TAIL

// end of file
