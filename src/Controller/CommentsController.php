<?php
/**
 * Created by PhpStorm.
 * User: panxp
 * Date: 2018-08-06
 * Time: 16:48
 */

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use APP\Model\Table\UsersTable;

class CommentsController extends AppController
{


    public $layout = "test";

    public function index()
    {

        $a = $this->Comments->find('all', ['conditions' => ['_id' => '5b22379641ad811a9ac3254e']]);

        echo '<pre>';
        print_r($a);exit;



        exit;
    }



}