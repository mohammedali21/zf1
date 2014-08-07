
<?php 

class Core_Model_User implements Zend_Acl_Role_Interface
{
	private $id;
	private $login;
	private $password;
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $login
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * @return the $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @param field_type $login
	 */
	public function setLogin($login) {
		$this->login = $login;
		return $this;
	}

	/**
	 * @param field_type $password
	 */
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}
	
	public function getRoleId(){
		return $this->login;
	}

	
	
	
	
	
}