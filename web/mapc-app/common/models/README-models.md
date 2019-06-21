Models
==================================================

Basic
--------------------------------------------------
```
<?php
namespace Mapc\Common;

/**
 * Bare Model
 * @version 0.1
 */
class Bare {
    public $uuid;

    public function __construct() {}
    public function create() {}
    public function read() {}
    public function update() {}
    public function delete() {

} // class

// this is it
```


Construct
--------------------------------------------------
    public function __construct($args = []) {
        $this->db = $args['db'];
        $user = $this->db->getRedBean()->dispense('TABLE');
    }
