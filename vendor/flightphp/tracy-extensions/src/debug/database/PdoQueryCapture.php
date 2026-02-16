<?php
declare(strict_types=1);

namespace flight\debug\database;

use PDO;
use PDOStatement;

class PdoQueryCapture extends \flight\database\PdoWrapper {

	/** @var array $query_data */
	public static array $query_data = [];

	/** @var array $prepared_query_data */
	public static array $prepared_query_data = [];

	/**
	 * Construct
	 *
	 * @param string      $dsn      dsn
	 * @param string|null $username username
	 * @param string|null $password password
	 * @param array       $options  options
	 */
	public function __construct(string $dsn, ?string $username = null, ?string $password = null, array $options = [], bool $trackApmQueries = false) {
		parent::__construct($dsn, $username, $password, $options, $trackApmQueries);
		$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, [PdoQueryCaptureStatement::class, [$this]]);
	}

	/**
	 * Executes an SQL statement, returning a result set as a PDOStatement object
	 *
	 * @param string   $query           query to run
	 * @param int|null $fetchMode       how the results will be returned
	 * @param mixed    ...$fetch_mode_args additional fetch mode arguments
	 * @return PDOStatement|false
	 */
	public function query(string $query, int|null $fetchMode = null, mixed ...$fetch_mode_args): PDOStatement|false
	{
		$start_time = microtime(true);
		if ($fetchMode !== null && count($fetch_mode_args) > 0) {
			$result = parent::query($query, $fetchMode, ...$fetch_mode_args);
		} elseif ($fetchMode !== null) {
			$result = parent::query($query, $fetchMode);
		} else {
			$result = parent::query($query);
		}
		$end_time = microtime(true);
		$execution_time = $end_time - $start_time;
		self::$query_data[uniqid("", true)] = [
			'query' => $query,
			'execution_time' => $execution_time,
			'params' => [],
			'backtrace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS),
			'rows' => ($result instanceof PDOStatement) ? $result->rowCount() : 0
		];
		return $result;
	}

	/**
	 * Execute an SQL statement and return the number of affected rows
	 *
	 * @param string $statement SQL Statement to run
	 * @return int|false
	 */
	public function exec(string $statement): int|false
	{
		$start_time = microtime(true);
		$result = parent::exec($statement);
		$end_time = microtime(true);
		$execution_time = $end_time - $start_time;
		self::$query_data[uniqid("", true)] = [
			'query' => $statement,
			'execution_time' => $execution_time,
			'params' => [],
			'backtrace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS),
			'rows' => ($result !== false) ? (int) $result : 0
		];
		return $result;
	}

	/**
	 * Prepares a statement for execution and returns a statement object
	 *
	 * @param string $query   query
	 * @param array  $options This array holds one or more key=>value pairs to set attribute values for the PDOStatement object that this method returns. You would most commonly use this to set the PDO::ATTR_CURSOR value to PDO::CURSOR_SCROLL to request a scrollable cursor. Some drivers have driver specific options that may be set at prepare-time.
	 * @return PdoQueryCaptureStatement|false
	 */
	public function prepare($query, $options = []): PdoQueryCaptureStatement|false
	{
		$start_time = microtime(true);
		$statement = parent::prepare($query, $options);
		$end_time = microtime(true);
		$execution_time = $end_time - $start_time;
		if ($statement === false) {
			return false;
		}
		self::$query_data[$statement->unique_value] = [
			'query' => $query,
			'prepare_time' => $execution_time,
			'execution_time' => 0,
			'params' => [],
			'backtrace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS),
			'rows' => 0
		];
		return $statement;
	}

}
