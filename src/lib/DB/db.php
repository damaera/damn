<?php

/**
* 
*/
class DB
{
	public $query;
	protected $table, $status = 0;
	protected $params = array();

	function __construct($table) {
		$this->table = $table;
	}

	protected function connectDB()
	{
		$dbhost=DB_HOST;
		$dbuser=DB_USER;
		$dbpass=DB_PASS;
		$dbname=DB_NAME;
		$dbtype=DB_TYPE;
		$dbh = new PDO("$dbtype:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbh;
	}

	public function raw($str = "", $params=array()){
		$this->query = $str;
		$this->params = $params;
		return $this;
	}
	public function select($str = "*"){
		if ($this->status == 0) {
			$this->status = 1;
			$this->query = "SELECT $str FROM $this->table";
		}
		return $this;
	}

	public function where($str = "", $params = array()){
		if ($this->status == 0) {
			$this->query = "SELECT * FROM $this->table WHERE $str";
		}
		else if ($this->status == 1) {
			$this->query .= " WHERE $str";
		}
		$this->params = $params;
		return $this;
	}

	public function distinct(){
		if ($this->status == 1) {
			$query = $this->query;
			$this->query = str_replace("SELECT", "SELECT DISTINCT", $query);
		}
		return $this;
	}

	public function order($str){
		if ($this->status == 1) {
			$this->query .= " ORDER BY $str";
		}
		return $this;
	}

	public function find($id){
		$table = $this->table;

		$db = $this->connectDB();
		$stmt = $db->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");	
		$res = $stmt->fetchAll(PDO::FETCH_OBJ);

		$primary = $res[0]->Column_name;

		return $this->where("$primary = ?", array($id));

	}

	public function fetch($opt = 'array') {
		try {

			$query = $this->query;
			$params = $this->params;

			$db = $this->connectDB();
			$stmt = $db->prepare($query);

			$stmt->execute($params);
			$db = null;
			if ($opt == 'array') {
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			else if ($opt == 'object') {
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			}
		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public function insert($values = array()){
		$keys = "";
		$ques = "";
		$i = 0;
		$params = array();
		foreach ($values as $key => $value) {
			$params[$i] = $value;
			if ($i == 0) {
				$keys .= $key;
				$ques .= "?";
			}
			else{
				$keys .= ' , '. $key;
				$ques .= " , ?";
			}
			$i++;
		}
		
		$this->params = $params;
		$this->query = "INSERT INTO $this->table($keys) VALUES ($ques)";

		return $this;
	}

	public function update($id, $values = array()){
		$table = $this->table;

		$db = $this->connectDB();
		$stmt = $db->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");	
		$res = $stmt->fetchAll(PDO::FETCH_OBJ);

		$primary = $res[0]->Column_name;

		$keys = "";
		$i = 0;
		$params = array();
		foreach ($values as $key => $value) {
			$params[$i] = $value;
			if ($i == 0) {
				$keys .= $key." = ?";
			}
			else{
				$keys .= ' , '. $key." = ?";
			}
			$i++;
		}
		$params[$i] = $id;

		$this->params = $params;
		print_r($params);
		$this->query = "UPDATE $this->table SET $keys WHERE $primary = ?";

		return $this;

	}

	public function delete($id){
		$table = $this->table;

		$db = $this->connectDB();
		$stmt = $db->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");	
		$res = $stmt->fetchAll(PDO::FETCH_OBJ);

		$primary = $res[0]->Column_name;
		
		$this->query = "DELETE FROM $this->table WHERE $primary = ?";
		$this->params = array($id);

		return $this;

	}

	public function execute($query = "", $params = array()) {
		try {

			if ($query == "") {
				$query = $this->query;
				$params = $this->params;
			}

			$db = $this->connectDB();
			$stmt = $db->prepare($query);
			$db = null;
			$stmt->execute($params);
		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

}