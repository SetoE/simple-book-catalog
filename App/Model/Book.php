<?php

namespace App\Model;

use App\Lib\Config;
use PDO;
use PhpDao\Connection;
use PhpDao\Model;

class Book extends Model
{
    protected $table = 'books';

    /**
     * DB Connection code
     * 
     * can be moved to a base model to make all next models and this model extend there and have an auto connect
     */
    public function __construct()
    {
        $db = Config::get('db');

        $pdo = new PDO(
            "mysql:host={$db['host']};port={$db['port']};dbname={$db['database']}",
            $db['user'],
            $db['password']
        );
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        $connection = new Connection($pdo);

        Model::setConnection($connection);
    }
}
