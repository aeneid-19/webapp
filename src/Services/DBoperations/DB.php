<?php
declare(strict_types=1);

namespace mvc_eins\Services\DBoperations;
use PDO;
use PDOException;

/**
 * Class DB
 * @package mvc_eins\Services\DBconnect
 */
class DB
{
	private static ?DB $_instance = null;
	private bool $_query;
	private array $_result;
	private string $_lastInsertID;
	private bool $_error = false;
	private int $_count = 0;
	private PDO $_pdo;

	private function __construct()
	{
		$configINI = parse_ini_file(__DIR__ . '/../DBconfig/db_config.ini');
		try {
			$this->_pdo = new PDO('mysql:host=' . $configINI['host'] . ';dbname=' . $configINI['dbname'],
				'' . $configINI['username'] . '', '' . $configINI['passwd'] . '');
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	 * @return DB
	 */
	public static function getInstance() : DB
	{
		if (self::$_instance === null) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	/**
	 * @param string     $sql
	 * @param array|null $params
	 * @return $this
	 */
	public function query(string $sql, array $params = null) : self
	{
		$this->_error = false;
		if ($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if (\count($params)) {
				foreach ($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}

			if ($this->_query->execute()) {
				$this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
				$this->_lastInsertID = $this->_pdo->lastInsertId();
			} else {
				$this->_error = true;
			}
		}
		return $this;
	}

	/**
	 * @param string     $table
	 * @param array|null $params
	 * @return bool
	 */
	protected function _read(string $table, array $params = null) : bool
	{
		$conditionString = '';
		$bind = [];
		$order = '';
		$limit = '';

		// conditions
		if (isset($params['conditions'])) {
			if (\is_array($params['conditions'])) {
				foreach ($params['conditions'] as $condition) {
					$conditionString .= ' ' . $condition . ' AND';
				}
				$conditionString = trim($conditionString);
				$conditionString = rtrim($conditionString, ' AND');
			} else {
				$conditionString = $params['conditions'];
			}
			if ($conditionString !== '') {
				$conditionString = ' WHERE ' . $conditionString;
			}
		}

		// bind
		if (\array_key_exists('bind', $params)) {
			$bind = $params['bind'];
		}

		// order
		if (\array_key_exists('order', $params)) {
			$order = ' ORDER BY ' . $params['order'];
		}

		// limit
		if (\array_key_exists('limit', $params)) {
			$limit = ' LIMIT ' . $params['limit'];
		}
		$sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
		if ($this->query($sql, $bind)) {
			//dnd($sql);
			return !($this->_result && !count($this->_result));
		}
		return false;
	}

	public function find(string $table, array $params = null)
	{
		if ($this->_read($table, $params)) {
			return $this->results();
		}
		return false;
	}

	public function findFirst(string $table, array $params = null)
	{
		if ($this->_read($table, $params)) {
			return $this->first();
		}
		return false;
	}

	/**
	 * This DB Wrapper method prevents SQL injection by converting
	 * all of the values of the INSERT statement to strings.
	 * @param string     $table
	 * @param array|null $fields
	 * @return bool
	 */
	public function insert(string $table, array $fields = null)
	{
		$fieldString = '';
		$valueString = '';
		$values = [];

		foreach ($fields as $field => $value) {
			$fieldString .= '`' . $field . '`,';
			$valueString .= '?,';
			$values[] = $value;
		}
		//dnd($values);
		$fieldString = rtrim($fieldString, ',');
		$valueString = rtrim($valueString, ',');
		$sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
		//dnd($sql);
		if (!$this->query($sql, $values)->error()) {
			return true;
		}
		return false;
	}

	/**
	 * @param string     $table
	 * @param string     $id
	 * @param array|null $fields
	 * @return bool
	 */
	public function update(string $table, string $id, array $fields = null) : bool
	{
		$fieldString = '';
		$values = [];
		foreach ($fields as $field => $value) {
			$fieldString .= ' ' . $field . ' = ?,';
			$values[] = $value;
		}
		$fieldString = trim($fieldString);
		$fieldString = rtrim($fieldString, ',');
		$sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
		if (!$this->query($sql, $values)->error()) {
			return true;
		}
		return false;
	}

	/**
	 * @param $table
	 * @param $id
	 * @return bool
	 */
	public function delete(string $table, string $id) : bool
	{
		$sql = "DELETE FROM {$table} WHERE  id = {$id}";
		if (!$this->query($sql)->error()) {
			return true;
		}
		return false;
	}

	public function results()
	{
		return $this->_result;
	}

	/**
	 * @return array
	 */
	public function first() : array
	{
		return (!empty($this->_result)) ? $this->_result[0] : [];
	}

	/**
	 * @return int
	 */
	public function count()
	{
		return $this->_count;
	}

	/**
	 * @return null
	 */
	public function lastID()
	{
		return $this->_lastInsertID;
	}

	/**
	 * @param $table
	 * @return mixed
	 */
	public function get_columns(string $table)
	{
		return $this->query("SHOW COLUMNS FROM {$table}")->results();
	}

	/**
	 * @return bool
	 */
	public function error() : bool
	{
		return $this->_error;
	}
}