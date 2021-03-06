<?php

App::uses('AppController', 'Controller');

class PostsController extends AppController{
    public $uses = array('Post', 'Category', 'User');
    public $helpers = array('Image');

    public function index(){
        $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
    }

    public function add(){
        //get all category
        $category = $this->Category->getAllCategory();
        if(!$this->Session->read('user')){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }
        $user = $this->Session->read('user');
        if($user['User']['group'] === 0){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }

        $this->layout = 'backend';
        $path_img = WWW_ROOT.'img/upload/';

        if($this->request->is('post') || $this->request->is('put')){
            $data = $this->request->data;

            if(!empty($data['Post']['url']))
                $url = $data['Post']['url'];

            if (!empty($data['Post']['url']))
                $filename = time() . $url['name'];

            if (!empty($data['Post']['url'])) {
                $data['Post']['url'] = $filename;
                if (!empty($url['name'])) {
                    // Check type of file upload
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime = finfo_file($finfo, $url['tmp_name']);
                    finfo_close($finfo);
                    if (!in_array($mime, Configure::read('FILE_TYPE_UPLOAD'))) {
                        $this->Session->setFlash(Configure::read('TYPE_FILE_ERROR'), 'error');
                        $this->redirect(array('action'=>'add'));
                    }
                }
            }
            $data['Post']['user_id'] = $user['User']['id'];
            $data['Post']['date'] = date('Y-m-d H:i:s');
            $data['Post']['approved'] = 0;
            $this->Post->create();
            if($this->Post->save($data)){
                $uploadfile = $path_img.$filename;
                if(move_uploaded_file($url['tmp_name'], $uploadfile)){
                    $this->Session->setFlash('Upload successfull', 'success');
                    $this->redirect(array('action'=>'index'));
                }else{
                    $this->Session->setFlash('Upload error!', 'error');
                }
            }
        }
        $this->set('category', $category);
        $this->render('admin_detail');
    }

    public function admin_index() {
        if(!$this->Session->read('user')){
            $this->redirect(array('controller'=>'Homes','action'=>'index'));
        }

        $user = $this->Session->read('user');
        if($user['User']['group'] == 0){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }
        $list_user = $this->User->getAllUser();
        $category = $this->Category->getAllCategory();

        $this->layout = 'backend';

        $this->paginate = array(
            'conditions' => array(
                'delete_flg' => 0,
            ),
            'limit' => 20,
            'order' => array('Post.id' => 'desc')
        );
        $this->set('list_user', $list_user);
        $this->set('category', $category);
        $this->set('posts', $this->paginate());
    }

    public function admin_add() {
        //get all category
        $category = $this->Category->getAllCategory();

        if(!$this->Session->read('user')){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }
        $user = $this->Session->read('user');
        if($user['User']['group'] == 0){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }

        $this->layout = 'backend';
        $path_img = WWW_ROOT.'img/upload/';

        if($this->request->is('post') || $this->request->is('put')){
            $data = $this->request->data;

            if(!empty($data['Post']['url']))
                $url = $data['Post']['url'];

            if (!empty($data['Post']['url']))
                $filename = time() . $url['name'];

            if (!empty($data['Post']['url'])) {
                $data['Post']['url'] = $filename;
                if (!empty($url['name'])) {
                    // Check type of file upload
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime = finfo_file($finfo, $url['tmp_name']);
                    finfo_close($finfo);
                    if (!in_array($mime, Configure::read('FILE_TYPE_UPLOAD'))) {
                        $this->Session->setFlash(Configure::read('TYPE_FILE_ERROR'), 'error');
                        $this->redirect(array('action'=>'add'));
                    }
                }
            }
            $data['Post']['user_id'] = $user['User']['id'];
            $data['Post']['date'] = date('Y-m-d H:i:s');
            $data['Post']['approved'] = 0;
            $this->Post->create();
            if($this->Post->save($data)){
                $uploadfile = $path_img.$filename;
                if(move_uploaded_file($url['tmp_name'], $uploadfile)){
                    $this->Session->setFlash('Upload successfull', 'success');
                    $this->redirect(array('action'=>'index'));
                }else{
                    $this->Session->setFlash('Upload error!', 'error');
                }
            }
        }
        $this->set('category', $category);
        $this->render('admin_detail');
    }

    public function admin_edit($id) {
        //get all category
        $category = $this->Category->getAllCategory();

        if(!$this->Session->read('user')){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }
        $user = $this->Session->read('user');
        if($user['User']['group'] == 0){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }

        $this->layout = 'backend';
        $path_img = WWW_ROOT.'img/upload/';

        if($this->request->is('post') || $this->request->is('put')){
            $data = $this->request->data;

            if(!empty($data['Post']['url']))
                $url = $data['Post']['url'];

            if (!empty($data['Post']['url']))
                $filename = time() . $url['name'];

            if (!empty($data['Post']['url'])) {
                $data['Post']['url'] = $filename;
                if (!empty($url['name'])) {
                    // Check type of file upload
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime = finfo_file($finfo, $url['tmp_name']);
                    finfo_close($finfo);
                    if (!in_array($mime, Configure::read('FILE_TYPE_UPLOAD'))) {
                        $this->Session->setFlash(Configure::read('TYPE_FILE_ERROR'), 'error');
                        $this->redirect(array('action'=>'add'));
                    }
                }
            }
            $data['Post']['user_id'] = $user['User']['id'];
            $data['Post']['date'] = date('Y-m-d H:i:s');
            $data['Post']['approved'] = 0;
            $this->Post->id = $id;
            $this->Post->set($data);
            if($this->Post->save($data)){
                $uploadfile = $path_img.$filename;
                if(move_uploaded_file($url['tmp_name'], $uploadfile)){
                    $this->Session->setFlash('Upload successfull', 'success');
                    $this->redirect(array('action'=>'index'));
                }else{
                    $this->Session->setFlash('Upload error!', 'error');
                }
            }
        }

        $this->request->data = $this->Post->findById($id);

        $this->set('category', $category);
        $this->render('admin_detail');
    }

    public function admin_approved($id) {
        $this->layout = 'backend';

        if(!$this->Session->read('user')){
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }
        $user = $this->Session->read('user');
        if($user['User']['group'] == 0){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }

        if($this->Post->updateAll(array('Post.approved' => 1), array('Post.id'=>$id))){
            $this->Session->setFlash('Approved post!', 'success');
            $this->redirect(array('controller'=>'Posts', 'action' => 'index'));
        }
    }

    public function admin_unapproved($id) {
        $this->layout = 'backend';

        if(!$this->Session->read('user')){
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }
        $user = $this->Session->read('user');
        if($user['User']['group'] == 0){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }

        $post = $this->Post->findById($id);

        if(empty($post)){
            $this->redirect(array('controller' => 'Posts', 'action' => 'index'));
        }
        if($this->Post->updateAll(array('Post.approved' => 0), array('Post.id'=>$id))){
            $this->Session->setFlash('Unapproved post!', 'success');
            $this->redirect(array('controller'=>'Posts', 'action' => 'index'));
        }
    }

    public function admin_delete($id) {
        $this->layout = 'backend';

        if(!$this->Session->read('user')){
            $this->redirect(array('controller' => 'users', 'action' => 'logout'));
        }
        $user = $this->Session->read('user');
        if($user['User']['group'] == 0){
            $this->redirect(array('controller'=>'Homes', 'action'=>'index'));
        }

        $post = $this->Post->findById($id);

        if(empty($post)){
            $this->redirect(array('controller' => 'Posts', 'action' => 'index'));
        }
        if($this->Post->updateAll(array('Post.delete_flg' => 1), array('Post.id'=>$id))){
            $this->Session->setFlash('Delete post successfull!', 'success');
            $this->redirect(array('controller'=>'Posts', 'action' => 'index'));
        }
    }

    public function search(){
        $news_col = $this->Post->find('all', array(
            'conditions' => array(
                'category_id' => NEWS,
                'approved' => 1,
            ),
            'limit' => LIMIT_COLUMN2,
            'order' => array('Post.id' => 'desc')
        ));
        if($this->request->is('post') || $this->request->is('put')){
            $data = $this->request->data;
            if(!empty($data['Post']['search'])){
                $result = $this->Post->find('all', array(
                    'conditions' => array(
                        'Post.title LIKE' => '%'.$data['Post']['search'].'%'
                    )
                ));
                $this->set('result', $result);
            }
        }
        $this->set('news_col', $news_col);
    }

}