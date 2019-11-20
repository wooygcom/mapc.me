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
    public $id;
    public $vars;

    public function __construct($args = []) {

        $this->db = $args['db'];

        $this->vars = $this->db->getRedBean()->dispense('TABLE');

    }

    public function create() {

        $this->id = $this->db->store($this->vars);

        return $this->id;
        
    }

    public function retrieve() {}
    public function update() {}
    public function delete() {}

} // class

// this is it
```
