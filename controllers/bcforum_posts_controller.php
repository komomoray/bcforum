<?php
class BcforumPostsController extends BaserPluginAppController {
	var $name = "BcforumPosts";
	var $uses = array('Bcforum.BcforumPost');	//モデル宣言 (プラグイン名.モデル名)
	var $components = array('BcAuth','Cookie','BcAuthConfigure','RequestHandler');	//認証がかかる,ajax
	
/**
 * ぱんくずナビ
 *
 * @var string
 * @access public
 */
	var $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
		array('name' => 'フォーラム掲示板管理', 'url' => array('controller' => 'bcforum_posts', 'action' => 'index'))
	);

/**
 * beforeFilter
 */	
	function beforeFilter() {
		parent::beforeFilter();
		if (!preg_match('/^admin_/', $this->action)) {
			$this->BcAuth->allow($this->action);
		}
		//$this->BcAuth->allow('index', 'view');
	}
	
	function admin_index() {

		$this->pageTitle = '記事一覧';
		$this->subMenuElements = array('bcforum_posts_index');	
		$keywords = '';

		$conditions = array('BcforumPost.reply' => 0);
		$this->paginate = array('conditions' => $conditions, 'limit' => 30, 'order' => array('BcforumPost.modified' => 'desc'));
		$datas = $this->paginate('BcforumPost');
		
		
		$reply_array = array();
		
		$replies = $this->BcforumPost->find('all');
		foreach ($replies as $reply) {
			if ($reply['BcforumPost']['reply'] != 0) {
				array_push($reply_array, $reply['BcforumPost']['id']);
			}
		}
		//var_dump($reply_array);
		//$replies = $this->BcforumPost->read(null, $id);
		
		$this->set(compact('datas', 'strs', 'keywords'));

		$this->search = 'bcforum_posts_index';

	}
	
	function admin_search() {

		$this->pageTitle = '検索結果一覧';
		$this->subMenuElements = array('bcforum_posts_index');	

		// 画面情報設定
		$default = array('named' => array('num' => $this->siteConfigs['admin_list_num']));
		$this->setViewConditions('BcforumPost', array('default' => $default, 'type' => 'get'));

		if(!empty($this->params['url']['search'])) {
			$keywords = $this->params['url']['search'];
			$strs = $this->_parseQuery($keywords);
		} else {
			$keywords = '';
		}
		
		// 検索条件を生成
		$conditions = $this->_createAdminIndexConditions($this->data);
		$this->paginate = array(
				'conditions' => $conditions,
				'fields' => array(),
				'order' =>'BcforumPost.created',
				'limit' => $this->passedArgs['num']
		);
		$datas = $this->paginate('BcforumPost');
		$this->set(compact('datas', 'strs', 'keywords'));

		$this->search = 'bcforum_posts_index';

	}

/**
 * 管理画面固定ページ一覧の検索条件を取得する
 *
 * @param array $data
 * @return array
 * @access protected
 */
	function _createAdminIndexConditions($data){

		// 条件を初期化
		$conditions = array();
		$search = '';

		if(isset($data['BcforumPost']['search'])) {
			$search = $data['BcforumPost']['search'];
		}

		// 不要な条件を削除
		unset($data['_Token']);
		unset($data['BcforumPost']['search']);

		// 条件指定のないフィールドを削除
		foreach($data['BcforumPost'] as $key => $value) {
			if($value === '') {
				unset($data['BcforumPost'][$key]);
			}
		}

		if($data['BcforumPost']) {
			$conditions = $this->postConditions($data);
		}

		if(isset($data['BcforumPost'])){
			$data = $data['BcforumPost'];
		}

		if($search) {
			$strs = $this->_parseQuery($search);
			foreach ($strs as $str) {
				$conditions['or'][] = array('BcforumPost.name LIKE' => '%' . $str . '%');
				$conditions['or'][] = array('BcforumPost.title LIKE' => '%' . $str . '%');
				$conditions['or'][] = array('BcforumPost.contents LIKE' => '%' . $str . '%');
			}
		}

		if($conditions) {
			return $conditions;
		} else {
			return array();
		}
		
	}
	
	function _parseQuery($query) {
		$query = preg_replace('/(\s|　)/',' ',$query);
		if(strpos($query, ' ') !== false) {
			$query = array_filter(explode(' ', $query));
		} else {
			$query = array($query);
		}
		return h($query);
	}
	
	function admin_edit($id) {
		$this->pageTitle = '記事編集';
		$this->subMenuElements = array('bcforum_posts_index');
		if (!$this->data) {
			$this->data = $this->BcforumPost->read(null, $id);
		} else {
			$this->BcforumPost->set($this->data);
			if ($this->BcforumPost->save()) {
				$this->Session->setFlash('保存しました');
				$this->redirect('index');
			} else {
				$this->Session->setFlash('失敗！');
			}
			
		}
	}
	
	function admin_delete($id) {
		if($this->BcforumPost->delete($id)) {
			$this->Session->setFlash('削除しました');
			$this->redirect('index');
		} else {
			$this->Session->setFlash('失敗！');
			$this->redirect(’index’);
		}
	}

	function admin_view($id) {
		$this->subMenuElements = array('bcforum_posts_index');

		if (!$id) {
			$this->Session->setFlash('投稿を指定してください。');
			$this->redirect(array('action' => 'index'));
		} else {
			$data = $this->BcforumPost->read(null, $id);
			$this->pageTitle = $data['BcforumPost']['title'];
			$this->set('data', $data);
			// 返信一覧用
			$replies = $this->BcforumPost->findAllByReply($id);
			$this->set('replies', $replies);
		}
	}
		
/**
 * ajax
 *
 * @return array
 * @access protected
 */
 	function admin_ajax_view() {
		// デバッグ情報出力を抑制
		Configure::write('debug', 0);
		// ajax用のレイアウトを使用
		//$this->layout = "ajax";
		// ajaxによる呼び出し？
		if($this->RequestHandler->isAjax()) {
			// POST情報は$this->params['form']で取得
			$id = $this->params['form']['id'];
			// DBからリプライ取得
			$replies = "test";
			// 表示用のデータをviewに渡す
			$this->set('t', $replies);
	    }

 	}
 
 
}