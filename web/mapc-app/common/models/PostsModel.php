<?php
namespace Mapc\Common;

use Mapc\Common\Bare;
use \RedBeanPHP\R as Rb;

/**
 * Posts Model
 * @version 0.1
 */
class Posts extends Bare {

	protected $db;
	protected $dbObj;

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

		$this->db        = $args['db'];
		$this->table     = $args['table'];
		$this->tableMeta = $args['tableMeta'];
		$this->dbObj     = $this->db->getRedBean()->dispense($this->table);

		return $this->dbObj;

	}

	/**
	 * @param $vars['postsVar']
	 * @param $vars['postsExtVar']
	 * `id`, `post_uid`, `post_lang`, `post_title`, `post_content`, `post_origin_type`, `post_origin_server`, `post_origin_url`, `post_write_date`, `post_edit_date_latest`, `post_status`, `post_user_uid`, `post_etc`
	 */
    public function create($vars = []) {

    }

    public function read() {

		$sql = ' SELECT * FROM ' . $this->table;

		//$this->posts = $this->db->getAll($sql);

		return $this->posts;

    }

    public function update() {}

	public function delete() {}

	public function createMeta(array $args = []) {}

    public function readMeta(array $args = []) {}

	public function updateMeta(array $args = []) {}

	public function deleteMeta($key = '') {}

} // class

// this is it
