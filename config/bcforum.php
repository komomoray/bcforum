<?php
/**
 * [ADMIN] 掲示板プラグイン
 *
 */
/**
 * システムナビ
 */
$config['BcApp.adminNavi.bcforum'] = array(
		'name'		=> '掲示板プラグイン',
		'contents'	=> array(
			array('name' => 'スレッド一覧', 
				'url' => array('admin' => true, 'plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'index'))
	)
);
