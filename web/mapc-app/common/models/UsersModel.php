<?php
namespace Mapc\Common;

// #TODO class Users extends Model (common/models/BareModel.php)
/**
 * User Model
 * @version 0.1
 */
class Users {

	private $db;

	public $users;

	public $uuid;
	public $name;
	public $email;
	public $group;
	public $role;
	public $etc;

	public function __construct($args = []) {
		$this->db = $args['db'];
		$users = $this->db->getRedBean()->dispense('mc_user_info');
	}

	public function create() {}
	public function update() {}
	public function show() {
		$sql = 'SELECT * FROM `mc_user_info` WHERE 1';
		$this->users = $this->db->getAll($sql);

		return $this->users;
	}
	public function destroy() {}

	public function signin() {
		$this->uuid  = 'TESTTESTTEST';
		$this->name  = '손님';
		$this->email = 'guest@ooooo.ooooo';
		$this->group = 'group1';
		$this->role  = 'guest';
	}
	public function signout() {}

} // class

// this is it
