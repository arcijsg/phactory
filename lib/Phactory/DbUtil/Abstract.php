<?php

abstract class Phactory_DbUtil_Abstract
{
    protected $_pdo;
    /**
     * @var string quote character for table and column names. Override in
     *      DB-specific descendant classes
     */
    protected $_quoteChar = '`'; // MySQL and SqlLite uses that

    public function __construct() {
        $this->_pdo = Phactory::getConnection();
    }

    abstract public function getPrimaryKey($table);
    abstract public function getColumns($table);

    // Not available in all RDBMS - default - do nothing
    public function disableForeignKeys() {}
    public function enableForeignKeys() {}

    /**
     * @param string $identifier name of table, column, etc
     * @return string quoted identifier
     */
    public function quoteIdentifier($identifier)
    {
        $quote = $this->getQuoteChar();
        return $quote.$identifier.$quote;
    }

    public function getQuoteChar()
    {
        return $this->_quoteChar;
    }
}
