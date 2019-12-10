<?php
namespace Mapc\test;

use OAuth2\Storage\Pdo;

class DoLoginPdo extends Pdo {
    public function __construct($connection, $config = array()) {
        parent::__construct($connection, $config);
        $this->config['user_table'] = 'users';
    }
}