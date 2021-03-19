<?php
	define('MYSQL_FETCHAS_OBJ', 1);
	define('MYSQL_FETCHAS_ASS', 2);
	define('MYSQL_FETCHAS_NUM', 3);
	error_reporting(E_ERROR);

	require_once(realpath(dirname(__FILE__) . '/config.php'));

	class MySQL
	{		
		private $connection;

		private $res_id;

		private $result;
		
		private $sql;

		public function __construct($dbp = '', $hostp = '', $userp = '', $pwdp = '')
		{	
			$this->sql = '';
			if(!$this->connection)
				$this->connect($dbp, $hostp, $userp, $pwdp);
		}
		

		function error()
		{
			if(!$this->connection)
				$result_ = '-1: No connection to database';
			else
				$result_ = @mysqli_errno($this->connection) . ': ' . @mysqli_error($this->connection);
			
			if($result_ == '0: ')
				$result_ = '';
			
			return $result_;
		}


		function connect($dbp = '', $hostp = '', $userp = '', $pwdp = '')
		{
			global $cfg_mysql;
			
			$this->disconnect();
			
			if($dbp == '')
				$db = $cfg_mysql['db'];
			else
				$db = $dbp;
			if($hostp == '')
				$host = $cfg_mysql['host'];
			else
				$host = $hostp;
			if($userp == '')
				$user = $cfg_mysql['user'];
			else
				$user = $userp;
			if($pwdp == '')
				$pwd = $cfg_mysql['password'];	
			else
				$pwd = $pwdp;
						
			$this->connection = mysqli_connect($host, $user, $pwd);

			if($this->connection)
			{
				if(!empty($db))
				{
					$dbselect = @mysqli_select_db($this->connection, $db);

					if(!$dbselect)
					{
						@mysqli_close($this->connection);
						$this->connection = $dbselect;
					}
				}
			}
		}			

	  function clean_user_input($dirty)
      {
    		if (get_magic_quotes_gpc())
        		{
            		$clean = mysqli_real_escape_string(stripslashes($dirty));
        		}
    		else
        		{
            		$clean = mysqli_real_escape_string($dirty);
        		}
    		return $clean;
	   }
		
	   
	  function escape_string($string)
      	{
    	return @mysqli_real_escape_string($string);
	  	}

		function query($sql, $type = MYSQL_FETCHAS_ASS)
		{
			$this->sql = $sql;
			if($this->res_id !== true && $this->res_id > 0) 
				@mysqli_free_result($this->res_id);
								
			unset($this->res_id);

			$this->res_id = mysqli_query($this->connection, $sql);

			if($this->res_id === true)
				return true;
				
			else if(!$this->res_id)
				return false; 
				
			else 
			{
				unset($this->result);
				$this->result = array();
					
				if($type == MYSQL_FETCHAS_OBJ)
					while($row = @mysqli_fetch_object($this->res_id))
						array_push($this->result, $row);				
				
				else if($type == MYSQL_FETCHAS_ASS)
					while($row = @mysqli_fetch_array($this->res_id, MYSQLI_ASSOC))
						array_push($this->result, $row);
				
				else if($type == MYSQL_FETCHAS_NUM)
					while($row = @mysqli_fetch_array($this->res_id, MYSQLI_NUM))
						array_push($this->result, $row);
				
				if(!$this->result)
					return true;
				return $this->result; 
			}						
		}

		function affected_rows()
		{
			if($this->connection)
				return(@mysqli_affected_rows($this->connection));
			else
				return false;
		}		
		
		function fetched_rows()
		{
			if($this->res_id)
				return(@mysqli_num_rows($this->res_id));
			else
				return false;
		}		

		function disconnect()
		{
			unset($this->result);
			if($this->connection)
			{
				if($this->res_id)
					@mysqli_free_result($this->res_id);
				unset($this->connection);
				return @mysqli_close($this->connection);
			}
			else
				return false;
		}

		function get_result()
		{
			if($this->result)
				return $this->result;
			else
				return false;
		}
		
		function free_result()
		{
			if($this->connection && $this->res_id)
			{
				@mysqli_free_result($this->res_id);
				unset($this->res_id);
				unset($this->result);
				return true;
			}
			else
				return false;
		}
		
		function last_id()
		{
			if($this->connection)
			{
				$data = $this->query('SELECT LAST_INSERT_ID() AS last_id');
				return $data[0]['last_id'];
			}
			else
				return false;
		}

		function get_sql()
		{
			return $this->sql;
		}
	}
