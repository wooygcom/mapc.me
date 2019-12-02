<?php
namespace Mapc\Common;

/**
 * Curd Model
 * @version 0.1
 */
class Crud {

	public $db;
	public $table;

    public $id;
    public $vars;

    public function __construct($args = []) {

        $this->db    = $args['db'];
        $this->table = $args['table'];
        $this->vars  = $this->db->getRedBean()->dispense($this->table);

    }

    public function create() {

        $this->id = $this->db->store($this->vars);

        return $this->id;
        
    }

    public function retrieve($uuid) {

        $result1 = $this->db->getRow("select id from " . $this->table . " where uuid = '" . $uuid . "'");
        $result2 = $this->db->load($this->table, $result1['id']);

    	return $result2;

    }

    public function update() {}
    public function delete() {}

    /**
     * @args
        $args['searchField']
        $args['searchValue']
     */
    public function search($args = []) {

        $sign = $args['sign'] ? $args['sign'] : ' = ';
        $sql  = 'SELECT * FROM ' . $this->table . ' WHERE ' . $args['searchField'] . $sign . ' :searchValue';
        $sql .= $args['order'] ? ' order by ' . $args['order'] : null;

        $result = $this->db->getAll($sql, [':searchValue' => $args['searchValue']]);

        return $result;

    }

} // class

// this is it
