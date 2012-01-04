<?php

require_once('DbUtil/Abstract.php');

class Phactory_DbUtilFactory {
	
	private function __construct(){ }
	
	public static function getDbUtil()
	{
		$db_type = Phactory::getConnection()->getAttribute(PDO::ATTR_DRIVER_NAME);
		switch ($db_type)
		{
			case 'mysql':
                require_once('DbUtil/MysqlUtil.php');
				return new Phactory_DbUtil_MysqlUtil();
				break;
			case 'sqlite':
                require_once('DbUtil/SqliteUtil.php');
				return new Phactory_DbUtil_SqliteUtil();
                break;
            case 'pgsql':
                require_once('DbUtil/PgsqlUtil.php');
                return new Phactory_DbUtil_PgsqlUtil();
				break;
			default:
				throw new Exception("DB type '$db_type' not found");
				break;
		}
	}

}
