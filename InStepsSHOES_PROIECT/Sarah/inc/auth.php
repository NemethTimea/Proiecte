<?php

	require_once(realpath(dirname(__FILE__) . '/mysqli.php'));
	class BaseAuth
	{
		private $status = false;
		private $nume = '';

		function BaseAuth()
		{
			$this->_auth();
		}

		function _auth($user = '', $pwd = '')
		{
				if($user == '' && $pwd == '')
				{
					if(!isset($_SESSION['auth']))
						$this->status = false;
					else
					{
						$this->status = $_SESSION['auth']['status'];
					}
				}
				else
				{
					$db = new MySQL();
					$query = sprintf("SELECT * FROM utilizatori WHERE fnev='%s' AND kod='%s'",$user,$pwd);
					$data = $db->query($query);
					$n_data = $db->fetched_rows();

					if($n_data && $data[0]['fnev'] == $user && $data[0]['kod'] == $pwd ) //double check
					{
                        $this->nume = $data[0]['keresztnev'];
                        $this->status = true;

						$_SESSION['auth']['status'] = $this->status;
						$_SESSION['auth']['nume'] = $this->nume;
						$_SESSION['auth']['uname'] = $user;
					}
					else
					{
						$this->status = false;
					}				
					$db->disconnect();
				}
				return $this->status;
		}

		function login($user, $pwd)
		{
			$this->_destroy();
			$this->_auth($user, $pwd);
		}

		function _destroy()
		{
			unset($_SESSION['auth']);
			$this->status = false;
		}

		function logout($where = '')
		{
			$this->_destroy();
			if($where != '')
				header('Location: ' . $where);
		}
}
