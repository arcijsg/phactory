<?php

class Phactory_DbUtil_PgsqlUtil extends Phactory_DbUtil_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->_quoteChar = '"';
    }

    public function getPrimaryKey($table)
    {
        $sql = "SELECT pg_attribute.attname as column_name
                  FROM pg_index, pg_class, pg_attribute
                 WHERE
                       pg_class.oid = '".$table."'::regclass
                   AND indrelid = pg_class.oid
                   AND pg_attribute.attrelid = pg_class.oid
                   AND pg_attribute.attnum = ANY(pg_index.indkey)
                   AND indisprimary";
        $stmt = $this->_pdo->query($sql);

        $result = $stmt->fetch();
        return $result['column_name'];
    }

    public function getColumns($table) {
        $stmt = $this->_pdo->query("SELECT column_name
                                      FROM INFORMATION_SCHEMA.COLUMNS
                                     WHERE table_name = '".$table."'");
        $columns = array();
        while($row = $stmt->fetch()) {
            $columns[] = $row['column_name'];
        }
        return $columns;
    }

}
