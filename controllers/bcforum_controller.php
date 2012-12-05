<?php
class BcforumController extends BaserPluginAppController {
	var $name = "Bcforum";
	var $uses = array('Bcforum.BcforumPost');	//モデル宣言 (プラグイン名.モデル名)
	var $components = array('BcAuth','Cookie','BcAuthConfigure');	//認証がかかる
	
/**
 * ぱんくずナビ
 *
 * @var array
 * @access public
 */
	var $crumbs = array(
		array('name' => 'フォーラム掲示板', 'url' => array('plugin' => 'bcforum', 'controller' => 'bcforum', 'action' => 'index'))
	);
	
/**
 * beforeFilter
 */
	function beforeFilter() {
		parent::beforeFilter();
		if (!preg_match('/^admin_/', $this->action)) {
			$this->BcAuth->allow($this->action);
		}
	}

	function index() {
		$this->pageTitle = 'フォーラムトピックス一覧';
		$conditions = array('BcforumPost.reply' => 0);
		$this->paginate = array('conditions' => $conditions, 'limit' => 30, 'order' => array('BcforumPost.modified' => 'desc'));
		$this->set('datas', $this->paginate('BcforumPost'));
	}
	
	function view($id) {
		// idの指定がない場合
		if (!$id) {
			$this->Session->setFlash('トピックを指定してください。');
			$this->redirect(array('action' => 'index'));
		} else {
			$this->set('id', $id);
			if ($this->data) {
				// 送信データをDBに保存
				if (empty($this->data['BcforumPost']['password'])) {
					$this->data['BcforumPost']['password'] = '0000';
				}
				$this->BcforumPost->set($this->data);
				if ($this->BcforumPost->save()) {
					// 親トピックidを取得して、count(返信数)をインクリメント
					$topic_id = intval($this->data['BcforumPost']['reply']);
					$topic = $this->BcforumPost->read(null, $topic_id);
					$topic['BcforumPost']['count'] = $topic['BcforumPost']['count'] + 1;
					$this->BcforumPost->set($topic);
					if($this->BcforumPost->save()) {
						$this->Session->setFlash('返信しました');
					} else {
						$this->Session->setFlash('保存に失敗しました');
					}
					$this->redirect(array('action' => 'view', $topic_id));
				} else {
					$this->data['BcforumPost']['password'] = '';
					$this->Session->setFlash('入力内容を確認してください');
				}
			}
			
			$data = $this->BcforumPost->read(null, $id);
			$data['BcforumPost']['contents'] = $this->autoLinker($data['BcforumPost']['contents']);
			$this->pageTitle = $data['BcforumPost']['title'];
			$this->set('data', $data);
			// 返信一覧用
			$replies = $this->BcforumPost->findAllByReply($id);
			//var_dump($replies);
			$i = 0;
			foreach ($replies as $reply) {
				$replies[$i]['BcforumPost']['contents'] = $this->autoLinker($reply['BcforumPost']['contents']);
				$i++;
			}
			$this->set('replies', $replies);
		}
	}
	
	function add() {
		$this->pageTitle = '新規トピック作成追加';
		if ($this->data) {
			// 送信データをDBに保存
			if (empty($this->data['BcforumPost']['password'])) {
				$this->data['BcforumPost']['password'] = '0000';
			}
			$this->BcforumPost->set($this->data);
			if ($this->BcforumPost->save()) {
				$this->Session->setFlash('トピックを作成しました');
				$this->redirect('index');
			} else {
				$this->data['BcforumPost']['password'] = '';
				$this->Session->setFlash('入力内容を確認してください');
			}
		}
	}

/*	function reply() {
		if ($this->data) {
			// 送信データをDBに保存
			if (empty($this->data['BcforumPost']['password'])) {
				$this->data['BcforumPost']['password'] = '0000';
			}
			$this->BcforumPost->set($this->data);
			if ($this->BcforumPost->save()) {
				// 親トピックidを取得して、count(返信数)をインクリメント
				$topic_id = intval($this->data['BcforumPost']['reply']);
				$topic = $this->BcforumPost->read(null, $topic_id);
				$topic['BcforumPost']['count'] = $topic['BcforumPost']['count'] + 1;
				$this->BcforumPost->set($topic);
				if($this->BcforumPost->save()) {
					$this->Session->setFlash('返信しました');
				} else {
					$this->Session->setFlash('保存に失敗しました');
				}
				$this->redirect(array('action' => 'view', $topic_id));
			} else {
				$this->data['BcforumPost']['password'] = '';
				$this->Session->setFlash('入力内容を確認してください');
				$this->redirect(array('action' => 'view', $this->data['BcforumPost']['reply']));
			}
		}
	}*/
	
	function edit($id) {
		
		$this->pageTitle = '投稿内容編集';
		// idの指定がない場合
		if(!$id) {
			$this->Session->setFlash('投稿を指定してください。');
			$this->redirect(array('action' => 'index'));
		} else {
			$this->set('id', $id);
			if (!$this->data) {
			# フォームにDBデータを表示
				$this->data = $this->BcforumPost->read(null, $id);
			} else {
				$data = $this->BcforumPost->read(null, $this->data['BcforumPost']['id']);
				if ($this->data['BcforumPost']['new_password'] == $data['BcforumPost']['password']) {
					if (!empty($this->params['form']['delete'])) {
						$this->_delete($id);
						$this->Session->setFlash('削除しました！');
						$this->redirect('view/'.$data['BcforumPost']['reply']);
					} else {
						// 送信データをDBに保存
						$this->BcforumPost->set($this->data);
						if ($this->BcforumPost->save()) {
							$this->Session->setFlash('保存しました');
							if ($data['BcforumPost']['reply'] != 0) {
								$this->redirect(array('action' => 'view/', $data['BcforumPost']['reply']));
							} else {
								$this->redirect(array('action' => 'view/', $data['BcforumPost']['id']));
							}
						} else {
							// 入力済みのデータを戻す
							$this->Session->setFlash('入力内容を確認してください');
							$this->data = $this->data;
							$this->data['BcforumPost']['password'] = '';
						}
					}
				} else {
					$this->Session->setFlash('パスワードが違います');
					// 入力済みのデータを戻す
					$this->data = $this->data;
					$this->data['BcforumPost']['password'] = '';
				}
			}
		}
	}
		
	function _delete($id) {
		$data = $this->BcforumPost->read(null, $id);
		if($this->BcforumPost->delete($id)) {
			
			// 親トピックidを取得して、count(返信数)をデクリメント
			$topic_id = intval($data['BcforumPost']['reply']);
			$topic = $this->BcforumPost->read(null, $topic_id);
			$topic['BcforumPost']['count'] = $topic['BcforumPost']['count'] - 1;
			$this->BcforumPost->set($topic);
			if($this->BcforumPost->save()) {
				$this->Session->setFlash('保存しました');
			} else {
				$this->Session->setFlash('保存に失敗しました');
			}
							
			$this->Session->setFlash('削除しました');
			$this->redirect('view/'.$data['BcforumPost']['reply']);
		} else {
			$this->Session->setFlash('削除に失敗しました');
			$this->redirect('index');
		}
	}

    function autoLinker($str) {
        $pat_sub = preg_quote('-._~%:/?#[]@!$&\'()*+,;=', '/'); // 正規表現向けのエスケープ処理
        $pat  = '/((http|https):\/\/[0-9a-z' . $pat_sub . ']+)/i'; // 正規表現パターン
        $rep  = '<a href="\\1">\\1</a>'; // \\1が正規表現にマッチした文字列に置き換わります
 
        $str = preg_replace ($pat, $rep, $str); // 実処理
        return $str;
    }
}