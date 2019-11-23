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
        $this->table = $args['table'];
        $this->vars = $this->db->getRedBean()->dispense($this->table);

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

    /**
     * @args
        $args['searchField']
        $args['searchValue']
     */
    public function search($args = []) {

        $sql = 'SELECT * FROM $this->table WHERE ' . $args['searchField'] . ' like :searchValue';
        $result = $this->db->getAll($sql, [':searchValue' => '%'.$args['searchValue'].'%']);

        return $result;

    }

} // class

// this is it
