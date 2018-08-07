<?php

/**
 * Created by PhpStorm.
 * User: panxp
 * Date: 2018-08-06
 * Time: 16:29
 */

namespace App\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Table;

class UsersTable extends Table
{

    public function initialize(array $config)
    {

        $connection = ConnectionManager::get('mysql');
        $this->setConnection($connection);
    }

    public function test()
    {

        echo __LINE__;
        exit;
    }
//    public static function defaultConnectionName()
//    {
//        return 'mysql';
//    }
}