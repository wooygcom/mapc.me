<?php
namespace Mapc\Common;

use \RedBeanPHP\R;

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

        $this->table = $args['table'];
        $this->vars  = R::xdispense($this->table);

    }

    public function create() {

        $this->id = R::store($this->vars);

        return $this->id;
        
    }

    public function retrieve($uuid) {

        $result1 = R::getRow("select id from " . $this->table . " where uuid = '" . $uuid . "'");
        $result2 = R::load($this->table, $result1['id']);

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

        $sql   = 'SELECT * FROM ' . $this->table;
        if(isset($args['searchField']) && isset($args['searchValue'])) {

            $sign = $args['sign'] ? $args['sign'] : ' = ';
            $sql .= ' WHERE ' . $args['searchField'] . ' ' . $sign . ' :searchValue';

        }

        $sql .= $args['order'] ? ' order by ' . $args['order'] : null;

        $result = R::getAll($sql, [':searchValue' => $args['searchValue']]);

        return $result;

    }

    public function searchByMeta($args) {

        $sql = '
             SELECT *
              FROM ' . $args['table'] . ' main
              LEFT JOIN ' . $args['table'] . 'meta sub ON
                   (main.uuid = sub.parent_uuid)
             WHERE sub.key = :searchField
               AND sub.value = :searchValue
            ';

        $condit = [
            ':searchField' => $args['searchField'],
            ':searchValue' => $args['searchValue']
            ];
        $sql .= $args['order'] ? ' order by ' . $args['order'] : null;

        $result = R::getAll($sql, $condit);

        return $result;

    }

} // class

// this is it
