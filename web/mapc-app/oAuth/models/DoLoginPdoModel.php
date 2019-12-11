<?php
namespace Mapc\oAuth;

use OAuth2\Storage\Pdo;

class DoLoginPdo extends Pdo {
    public function __construct($connection, $config = array()) {
        parent::__construct($connection, $config);
        $this->config['user_table'] = 'mc_user_info';
        $this->config['client_table'] = 'mc_user_info';
    }
}