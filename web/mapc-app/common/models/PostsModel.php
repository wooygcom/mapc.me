<?php
namespace Mapc\Common;

use Mapc\Common\Bare;

/**
 * Posts Model
 * @version 0.1
 */
class Posts extends Bare {

	private $db;
	private $dbObj;

	public $posts;

	public $uuid;
	public $post_uid;
	public $lang;
    public $title;
    public $content;

	public $key;
	public $value;
	public $desc;
	public $etc;

	public function __construct($args = []) {

		$this->db        = $args['db']->getRedBean();
		$this->table     = $args['table'];
		$this->tableMeta = $args['tableMeta'];
		$this->dbObj     = $this->db->dispense($this->table);
		$temp->title = 'asdf';
		$temp->content = 'asdfaaa';
var_dump($temp);
		var_dump($this->dbObj->store($temp));

		return $this->dbObj;

	}

    public function create($var) {

    	$this->dbObj->store($var);
    	var_dump($this->dbObj);

    }

    public function read() {

		$sql = ' SELECT * FROM ' . $this->table;

		//$this->posts = $this->db->getAll($sql);

		return $this->posts;

    }

    public function update() {}

	public function delete() {}

	public function createExtensions(array $args = []) {

		foreach($args as $arg) {

			$this->createExtension($arg);

		}

	}

	public function createExtension(array $args = []) {}

    public function readExtensions(array $args = []) {}

	public function updateExtension(array $args = []) {}

	public function deleteExtension($key = '') {}

} // class

// this is it
