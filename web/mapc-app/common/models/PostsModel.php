<?php
namespace Mapc\Common;

// #TODO class Users extends Model (common/models/BareModel.php)
/**
 * User Model
 * @version 0.1
 */
class Posts {

	private $db;

	public $posts;

	public $uuid;
	public $post_uid;
	public $lang;
	public $key;
	public $value;
	public $desc;
	public $etc;

	public function __construct($args = []) {
		$this->db = $args['db'];
		$posts = $this->db->getRedBean()->dispense('mc_mapc_post');
	}

	public function create() {}
	public function search() {}
	public function update() {}
	public function show() {
		$sql = 'SELECT * FROM `mc_user_info` WHERE 1';
		$this->users = $this->db->getAll($sql);

		return $this->users;
	}
	public function destroy() {}

} // class

// this is it
