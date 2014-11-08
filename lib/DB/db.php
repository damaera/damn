<?php

/**
 * @author damaera [damaera@live.com]
 *
 *
 * 
 * Class Damn DB query builder
 */
class DB
{	
	/**
	 * raw query sql
	 * @var string
	 */
	public $query;

	/**
	 * $table_name from model
	 * @var string
	 */
	protected $table;
	/**
	 * status for switching query
	 * @var integer
	 */
	protected $status = 0;

	/**
	 * bound PDO, for replacing '?' in query
	 * @var array
	 */
	protected $params = array();

	/**
	 * Getting data from model->table_name
	 * @param [type] $table [description]
	 */
	function __construct($table) {
		$this->table = $table;
	}

	/**
	 * Connect DB with PDO, 
	 * 	 * get data from app/config.php
	 * @return PDO object
	 */
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

	/**
	 * usage:
	 * model('namaModel')->data->raw('SELECT * FROM model WHERE id = ?', array(1))->fetch();
	 * 
	 * @param  string $str    sql query with bind param '?' pdo
	 * @param  array  $params parameter pdo for replacing '?'
	 * @return this, chaining method
	 */
	public function raw($str = "", $params = array()){
		$this->query = $str;
		$this->params = $params;
		return $this;
	}

	/**
	 * set SELECT query,
	 * 
	 * usage :
	 * model('nameModel')->data->select();
	 * 
	 * output :
	 * SELECT * FROM tableName
	 * @param  string $str
	 * @return this, chaining method
	 */
	public function select($str = "*"){
		if ($this->status == 0) {
			$this->status = 1;
			$this->query = "SELECT $str FROM $this->table";
		}
		return $this;
	}

	/**
	 * [where description]
	 * @param  string $str    [description]
	 * @param  array  $params [description]
	 * @return [type]         [description]
	 */
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

	/**
	 * [join description]
	 * @param  string $type  LEFT / INNER / RIGHT / LEFT_OUTER etc
	 * @param  string $table other table join
	 * @param  string $on    on "tabel1.id = tabel2.id"
	 * @return this, chaining method
	 */
	public function join($type = 'INNER', $table = '', $on = '')	{
		if ($table != '') {
			$this->query .= " $type JOIN $table ON $on";
		}
		return $this;
	}

	/**
	 * ORDER BY
	 * @param  string $str column name + asc / desc
	 * @return this, chaining method
	 */
	public function order_by($str){
		if ($this->status == 1) {
			$this->query .= " ORDER BY $str";
		}
		return $this;
	}

	/**
	 * find by primary key
	 * if more than one primary key, using first primary key
	 * 
	 * 
	 * @param  value $id = primary key value
	 * @return this, chaining method
	 */
	public function find($id){
		$table = $this->table;

		$db = $this->connectDB();
		$stmt = $db->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");	
		$res = $stmt->fetchAll(PDO::FETCH_OBJ);

		$primary = $res[0]->Column_name;

		return $this->where("$primary = ?", array($id));

	}

	/**
	 * [insert description]
	 *
	 * 
	 * @param  array  $values [description]
	 * array(
	 *     'columnName1' => 'valueInsert1',
	 *     'columnName2' => 'valueInsert2'
	 * )
	 * @return this, chaining method
	 */
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
		$this->query = "INSERT INTO $this->table ($keys) VALUES ($ques)";

		return $this;
	}

	/**
	 * [update description]
	 *
	 *
	 * update by first primary key
	 * 
	 * @param  value $id
	 * @param  array  $values 
	 * array(
	 *     'columnName1' => 'valueInsert1',
	 *     'columnName2' => 'valueInsert2'
	 * )
	 * @return this, chaining method
	 */
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
		
		$this->query = "UPDATE $this->table SET $keys WHERE $primary = ?";

		return $this;

	}

	/**
	 * [delete description]
	 *
	 * delete by first primary key
	 * 
	 * @param  value $id
	 * @return this, chaining method
	 */
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
	/**
	 * [fetch description]
	 *
	 * returning data for SELECT query
	 * 
	 * end of chaining method
	 * 
	 * @param  string $opt array / object
	 * @return array / object
	 */
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
			if (PHASE == 'development') {
				echo "
				<style>
					.dmnErr{
						padding : 50px;
						font-family : Helvetica, Arial, sans-serif;
						line-height : 1.8em;
						color: #333;
					}
					.damnMsg{
						font-size: 2em;
						line-height: 2.2em;
						font-weight : bold;

					}
				</style>
				";
				echo '<div class="dmnErr">';
				echo '<div class="damnMsg">' . $e->getMessage(). "</div>";
				echo '<div class="damnFl">File : '. $e->getFile(). "</div>";
				echo '<div class="damnLn"> Line : ' . $e->getLine(). "</div>";
				echo '<pre class="damnTrc">';
				echo "<h2>Trace:</h2>" . $e->getTraceAsString(). "<br>"; 
				echo "</pre>";
				echo '</div>';
			}
		}
	}

	/**
	 * [execute description]
	 *
	 * executing without returning data, used by INSERT, UPDATE, DELETE query
	 *
	 * end of chaining method
	 * 
	 */
	public function execute() {
		try {
			$query = $this->query;
			$params = $this->params;

			$db = $this->connectDB();
			$stmt = $db->prepare($query);
			$db = null;
			$stmt->execute($params);
		} catch(PDOException $e) {
			if (PHASE == 'development') {
				echo "
				<style>
					.dmnErr{
						padding : 50px;
						font-family : Helvetica, Arial, sans-serif;
						line-height : 1.8em;
						color: #333;
					}
					.damnMsg{
						font-size: 2em;
						line-height: 2.2em;
						font-weight : bold;

					}
				</style>
				";
				echo '<div class="dmnErr">';
				echo '<div class="damnMsg">' . $e->getMessage(). "</div>";
				echo '<div class="damnFl">File : '. $e->getFile(). "</div>";
				echo '<div class="damnLn"> Line : ' . $e->getLine(). "</div>";
				echo '<pre class="damnTrc">';
				echo "<h2>Trace:</h2>" . $e->getTraceAsString(). "<br>"; 
				echo "</pre>";
				echo '</div>';
			}
		}
	}

}