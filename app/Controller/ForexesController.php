<?php

App::uses('AppController', 'Controller');

class ForexesController extends AppController{
    public $uses = array('Post', 'Category');
    public $helpers = array('Image');

    public function index(){
    	$this->paginate = array(
            'conditions' => array(
            	'category_id' => FOREX,
                'approved' => 1,
            ),
            'limit' => LIMIT_PAGING,
            'order' => array('Post.id' => 'desc')
        );

        $news_newsest = $this->Post->find('first', array(
            'conditions' => array(
                'category_id' => FOREX,
                'approved' => 1,
            ),
            'order' => array('Post.id' => 'desc')
        ));

        $news_col = $this->Post->find('all', array(
            'conditions' => array(
                'category_id' => FOREX,
                'approved' => 1,
            ),
            'order' => array('Post.id' => 'desc')
        ));

        $column3 = $this->Post->find('all', array(
            'conditions' => array(
                // 'category_id' => NEWS,
                'approved' => 1,
            ),
            'limit' => LIMIT_COLUMN2,
            'order' => array('Post.id' => 'desc')
        ));

        $this->set('column3', $column3);
        $this->set('news_col', $news_col);
        $this->set('newsest', $news_newsest);
        $this->set('forexes', $this->paginate());
    }

    public function view($id, $title = null) {
        $news_col = $this->Post->find('all', array(
            'conditions' => array(
                'category_id' => FOREX,
                'approved' => 1,
            ),
            'limit' => 10,
            'order' => array('Post.id' => 'desc')
        ));

        $this->Post->id = $id;
        if(!$this->Post->exists()){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }
    	$news = $this->Post->findById($id);
        $user = array();
        if(!empty($news)){
            App::import('Model', 'User');
            $this->User = new User();
            $user = $this->User->getUsername($news['Post']['user_id']);
        }
    	$this->set('title_for_layout', $this->Post->convertToEn($news['Post']['title']));
    	$this->set('news', $news);
        $this->set('news_col', $news_col);
        $this->set('user', $user);
	}
}