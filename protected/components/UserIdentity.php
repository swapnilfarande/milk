<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	public $first_name;
	public $last_name;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

		$record = User::model()->findByAttributes(array('email'=>$this->username, 
			'password'=>md5($this->password)
		));		
		if($record === null) {
			$this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
		} else {
			var_dump('sss');
			$this->_id=$record->id;
            $this->setState('first_name', $record->first_name);
            $this->setState('last_name', $record->last_name);
            $this->errorCode=self::ERROR_NONE;			
		}
			
		return !$this->errorCode;
		
	}
	public function getId()
	{
	    return $this->_id;
	}	
}