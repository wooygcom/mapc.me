<?php
function mapc_file_ext_cut($filename) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    return preg_replace('/\.' . preg_quote($ext, '/') . '$/', '', $filename);
}

// this is it
