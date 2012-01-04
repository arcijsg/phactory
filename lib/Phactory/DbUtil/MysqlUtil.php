<?php

class Phactory_DbUtil_MysqlUtil extends Phactory_DbUtil_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->_quoteChar = '`';
    }

    public function getPrimaryKey($table) {
        $table = $this->quoteIdentifier($table);
        $stmt = $this->_pdo->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
        $result = $stmt->fetch();
        return $result['Column_name'];
    }

    public function getColumns($table) {
        $table = $this->quoteIdentifier($table);
        $stmt = $this->_pdo->query("DESCRIBE $table");
        $columns = array();
        while($row = $stmt->fetch()) {
            $columns[] = $row['Field'];
        }
        return $columns;
    }

    public function disableForeignKeys() {
        $this->_pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    }

    public function enableForeignKeys() {
        $this->_pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    }
}
