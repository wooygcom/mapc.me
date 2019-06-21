<?php
$config['dbadapter'] = 'mysql';
$config['dbhost'] = '127.0.0.1';
$config['dbname'] = 'test';
$config['dbuser'] = 'root';
$config['dbpass'] = 'testtest';

$config['title']       = '사이트제목';
$config['site_url']    = $_SERVER['REQUEST_URI'];
$config['description'] = 'site description';
$config['type']        = 'website';
$config['og_image']    = 'http://sample/images/img.png';
$config['og_image_type']   = 'image/png';
$config['og_image_width']  = '1024';
$config['og_image_height'] = '768';
$config['author']   = '우연근';
$config['keywords'] = '키워드, 키워드2';
$config['favicon']  = 'favicon.ico';

$config['upload_dir'] = '';
$config['layout'] = 'core';

//

return $config;

// this is it
