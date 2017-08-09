<?php
class DB
{
	var $DB_HOST;
	var $DB_PORT;
	var $DB_NAME;
	var $DB_USER;
	var $DB_PASSWORD;
	
	var $conn;
	var $SQL;
	var $errorMsg;
	var $successMsg;
	
	function displayError($stop=1)
	{
		echo "<p><font color='#FF0000'>".$this->errorMsg."</font></p>";
		if($stop==1)
			exit();
	}
		
	function dbconnect()
	{
	
		$this->conn_string = "host=".$this->DB_HOST." port=".$this->DB_PORT." dbname=".$this->DB_NAME." user=".$this->DB_USER." password=".$this->DB_PASSWORD;
		$this->conn = pg_connect($this->conn_string);


		if(!$this->conn)
		{
			$this->errorMsg = pg_last_error($this->conn);
			$this->displayError();
		}
				
	}
		
	function __construct()
	{
		$this->errorMsg = "";
		$this->successMsg = "";

		$this->DB_HOST = DBHOST;
		$this->DB_PORT= DBPORT;
		$this->DB_NAME = DBNAME;
		$this->DB_USER = DBUSER;
		$this->DB_PASSWORD = DBPASSWORD;

		$this->conn = NULL;
		$this->SQL = "";
		$this->dbconnect();		
	}
	

	
	public function setQuery($query)
	{
		$this->SQL = $query;
	}
	
	public function select()
	{
		if($this->SQL == "")
			return false;
		
		$rs = pg_query($this->conn,$this->SQL);
		if($rs=== false)
		{
			$this->SQL = "";
			$errorMsg = pg_last_error($this->conn);
			$this->displayError();
		}
		
		$records = array();
		while($row = pg_fetch_assoc($rs))
		{
			$records[] = $row;
		}
		
		$this->SQL = "";
		pg_free_result($rs);
		return $records;	
	}
	
	
	public function update()
	{
		if($this->SQL == "")
			return false;

		$rs = pg_query($this->conn,$this->SQL);
		if($rs=== false)
		{
			$this->SQL = "";
			$errorMsg = pg_last_error($this->conn);
			$this->displayError();
		}

		$this->SQL = "";
		return pg_affected_rows($rs);

	}

	public function execute()
	{
		if($this->SQL == "")
			return false;
		$rs = pg_query($this->conn,$this->SQL);
		if($rs=== false)
		{
			$this->SQL = "";
			$errorMsg = pg_last_error($this->conn);
			$this->displayError();
		}
		
		$this->SQL = "";
		return pg_affected_rows();
		
	}
	
	public function insert()
	{
		if($this->SQL == "")
			return false;
		
		$rs = pg_query($this->conn,$this->SQL);
		if($rs=== false)
		{
			$this->SQL = "";
			$this->errorMsg = pg_last_error($this->conn);
			$this->displayError();
		}
		
		$this->SQL = "";
		//return pg_insert_id(); SELECT currval('customer_id_seq')
	}
	
	public function close()
	{
		$this->errorMsg = "";
		$this->successMsg = "";

		$this->DB_HOST = "";
		$this->DB_NAME = "";
		$this->DB_USER = "";
		$this->DB_PASSWORD = "";

		if($this->conn)
			pg_close($this->conn);
			
		$this->SQL = "";
	}
	
}



?>