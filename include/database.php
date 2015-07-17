<?php

class Database
{

	function __construct()
	{
		$this->dbHost = '';
		$this->dbUser = '';
		$this->dbPass = '';
		$this->db = '';
	}

	function query($query)
	{
		//echo $query."\r\n";
		$dbhandle = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass) or die("Unable to connect to MySQL.".mysql_error());
		$table = mysql_select_db($this->db, $dbhandle) or die("Unable to connect to MySQL.".mysql_error());
		$result = mysql_query($query, $dbhandle) or die(mysql_error());
		return $result;
	}
}

?>
