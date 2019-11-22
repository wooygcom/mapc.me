<?php
namespace Mapc\Common;

use Mapc\Common\Crud;

/**
 * User Model
 * @version 0.1
 */
class Users extends Crud {

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
