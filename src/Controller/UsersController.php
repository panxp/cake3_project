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

class UsersController extends AppController
{
    /**
     * view-return row
     */
    public function view()
    {
        $user = $this->Users->get(10);
        $this->set(['result' => $user]);
    }

    /**
     * return list
     */
    public function index()
    {
        $cond = ['user_id <' => 50];

        $items = $this->Users->find('all', array(
            'conditions' => $cond,
            'fields' => array('user_id','nickname','phone'),
            'page' => $this->Param->page(),
            'limit' => $this->Param->limit(),
            'order' => array('user_id' => 'desc')
        ));
        $total = $this->Users->find('all', ['conditions' => $cond])->count();
        $this->set(['total' => $total, 'items' => $items]);

    }

    /**
     *
     * add pedding do...
     * @return mixed
     */
    public function add()
    {
        $article = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Users->patchEntity($article, $this->request->getData());
            $article->user_id = 1;
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);
    }
}