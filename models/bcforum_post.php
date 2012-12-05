<?php
/**
 * [ADMIN] BcforumPostモデル
 *
 */
class BcforumPost extends BaserPluginAppModel {
	var $name = 'BcforumPost';
	var $plugin = 'Bcforum';

/**
 * バリデーション
 *
 * @var array
 * @access public
 */
	var $validate = array(
			'title'		=> array(
				array(
					'rule'			=>	array('notEmpty'),
					'message'		=>	'タイトルを入力してください。'),
				array(
					'rule'			=>	array('maxLength', 40),
					'message'		=>	'タイトルは40文字以内で入力してください。')
			),
			'name'		=> array(
				array(
					'rule'			=>	array('notEmpty'),
					'message'		=>	'お名前を入力してください。'),
				array(
					'rule'			=>	array('maxLength', 20),
					'message'		=>	'お名前は20文字以内で入力してください。')
			),
			'contents'	=> array(
				'rule'				=>	array('notEmpty'),
				'message'			=>	'コメントを入力してください。'
			),
			'email'		=> array(
				'email' => array(
					'rule'			=> array('email'),
					'message'		=> 'Eメールの形式が不正です。',
					'allowEmpty'	=> true),
				'maxLength' => array(
					'rule'			=> array('maxLength', 255),
					'message'		=> 'Eメールは255文字以内で入力してください。')
			),
			'password'	=> array(
				array(
					'rule'			=>	array('alphaNumeric'),
					'message'		=>	'4文字以上の半角英数で入力してください。'),
				array(
					'rule'			=>	array('minLength', 4),
					'message'		=>	'4文字以上の半角英数で入力してください。')
			)
	);
}
