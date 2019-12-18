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

    public function query($query) {

        R::exec($query);

    }

    public function create() {

        $this->id = R::store($this->vars);

        return $this->id;
        
    }

    public function retrieve($uuid, $type='uuid') {

        // type이 UUID면 테이블에서 UUID값을 가지고 ID가져옴
        if($type == 'uuid') {
            $result1 = R::getRow("select id from " . $this->table . " where uuid = '" . $uuid . "'");
            $uuid = $result1['id'];
        }
        $result2 = R::load($this->table, $uuid);

    	return $result2;

    }

    public function update() {}

    public function delete() {

        R::trash($this->vars);

    }

    /**
     * @args
        $args['searchField']
        $args['searchValue']
        $args['sign']
        $args['order']
     */
    public function search($args = []) {

        $sql   = 'SELECT * FROM ' . $this->table;
        if(isset($args['where'])) {
            $sql .= ' WHERE ' . $args['where'];
        }
        // 아래 if문은 삭제 예정, $arg['search']값을 받는게 더 좋을 듯...
        elseif(isset($args['searchField']) && isset($args['searchValue'])) {
            $sign = $args['sign'] ? $args['sign'] : ' = ';
            $sql .= ' WHERE ' . $args['searchField'] . ' ' . $sign . ' :searchValue';
        }

        $sql .= $args['order'] ? ' order by ' . $args['order'] : null;
        $sql .= $args['limit'] ? ' limit ' . $args['limit'] : null;

        $result = R::getAll($sql, [':searchValue' => $args['searchValue']]);

        return $result;

    }

    public function searchByMeta($args) {

        $sql = '
             SELECT *
              FROM ' . $args['table'] . ' main
              LEFT JOIN ' . $args['table'] . 'meta sub ON
                   (main.uuid = sub.parent_uuid)
            ';

        if($args['where']) {
            $sql .= ' where ' . $args['where'];
        } elseif($args['searchField']) {
            $sql .= "
                 WHERE sub.key = :searchField
                   AND sub.value = :searchValue
                ";
            $condit = [
                ':searchField' => $args['searchField'],
                ':searchValue' => $args['searchValue']
                ];
        }
        $sql .= $args['order'] ? ' order by ' . $args['order'] : null;

        $result = R::getAll($sql, $condit);

        return $result;

    }

} // class

// this is it
