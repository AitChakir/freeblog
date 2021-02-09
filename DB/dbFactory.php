<?php

namespace App\DB;
use App\DB\DBPDO;
class DbFactory {
	public static function create(array $options){
		if (!array_key_exists('dsn', $options)) {
			if (!array_key_exists('driver', $options)) {
				throw new Exception("The driver is not seted", 1);
			}

			$dsn = '';

			switch ($options['dsn']) {
				case 'mysql':
				case 'oracle':
				case 'mssql':
					$dsn = $options['driver'].' :host='.$options['host'].';dbname='.$options['db'].';charset='.$options['charset'];
					break;
				case 'sqlite':
					$dsn = 'sqllite'.'dbname= '.$options['db'];
				default:
					throw new Exception("river not seted", 1);
					break;
			}
			$options['dsn'] = $dsn;
		}

		return DBPDO::getInstance($options);
	}
}