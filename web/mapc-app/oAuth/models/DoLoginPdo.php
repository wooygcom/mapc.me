<?php
namespace Mapc\oAuth;

class DoLoginPdo extends OAuth2\Storage\Pdo {
    public function __construct($connection, $config = array()) {
        parent::__construct($connection, $config);
        $this->config['user_table'] = 'users';
    }
}