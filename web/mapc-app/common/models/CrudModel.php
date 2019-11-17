<?php
namespace Mapc\Common;

/**
 * Cure Bare Model
 * @version 0.1
 */
class Crud {

	public $db;

	public $table;
    public $id;
    public $vars;

    public function __construct($args = []) {

        $this->db = $args['db'];
        $this->db->fancyDebug(true);
        $this->vars = $this->db->getRedBean()->dispense($args['table']);
        $this->table = $args['table'];

    }

    public function create() {

        $this->id = $this->db->store($this->vars);

        return $this->id;
        
    }

    public function retrieve($id) {

    	$result = $this->db->load($this->table, $id);

    	return $result;

    }

    public function update() {}
    public function delete() {}

} // class

// this is it
