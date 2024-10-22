<?php
  declare (strict_types = 1);

  class DBManager {
    private $iv_db_connection = null;
    private $iv_message = "";

    public function __construct (string $p_hostname, string $p_dbname, string $p_username, string $p_password, array $p_options) {
      $this->connect ($p_hostname, $p_dbname, $p_username, $p_password, $p_options);
    }

    public function __destruct () {
      $this->disconnect ();
    }

    public function connect (string $p_hostname, string $p_dbname, string $p_username, string $p_password, array $p_options): void {
      if (!is_null ($this->iv_db_connection)) {
        $this->iv_message = "Already connected";
        return;
      }
      try {
        $this->iv_db_connection = new PDO ("mysql:host=" . $p_hostname . ";dbname=" . $p_dbname . ";charset=UTF8", $p_username, $p_password, $p_options);
        $this->iv_message = "";
      } catch (PDOException $e) {
        $this->iv_db_connection = null;
        $this->iv_message = $e->getMessage();
        throw ($e);
      }
    }

    public function disconnect (): void {
      if (is_null ($this->iv_db_connection)) {
        $this->iv_message = "Already disconnected";
        return;
      }
      $this->iv_db_connection = null;
    }

    private function execute (string $p_sql_query, array $p_parameters): PDOStatement {
      try {
        $v_stmt = $this->iv_db_connection->prepare ($p_sql_query);
      } catch (PDOException $e) {
        $this->iv_message = $e->getMessage();
        throw ($e);
      }
      foreach ($p_parameters as $v_parameter) {
        $v_stmt->bindValue ($v_parameter [0], $v_parameter [1], $v_parameter [2]);
      }
      try {
        $v_stmt->execute ();
      } catch (PDOException $e) {
        $this->iv_message = $e->getMessage();
        throw ($e);
      }
      return $v_stmt;
    }
    
    public function executeQuery (string $p_sql_query, array $p_parameters = array ()): void {
      $this->execute ($p_sql_query, $p_parameters);
    }

    public function getQueryResult (string $p_sql_query, array $p_parameters = array ()): array {
      $v_stmt = $this->execute ($p_sql_query, $p_parameters);
      if (is_null ($v_stmt)) return array ();
      try {
        return $v_stmt->fetchAll (PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        $this->iv_message = $e->getMessage();
        throw ($e);
      }
    }

    public function getMessage (): string {
      return $this->iv_message;
    }

    public function isConnected (): bool {
      return !is_null ($this->iv_db_connection);
    }
  }
?>