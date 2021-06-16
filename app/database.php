<?php
class Database {

    protected static $_pdo;

    public static function get_pdo()
    {
      	
        if (empty(static::$_pdo))
        {
            $config =
              [
                'host'   => '127.0.0.1',
              	'port'	 =>	'3306',
                'dbname' => 'calendar64',
                'user'   => 'calendar64',
                'passw'  => 'miNvIlaW',
            ];

            static::$_pdo = new PDO('mysql:host=' . $config['host'] .';dbname=' . $config['dbname'],
                $config['user'], 
                $config['passw'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
				static::$_pdo->exec('SET NAMES "utf8";');
        return static::$_pdo;
    }

}