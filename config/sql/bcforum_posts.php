<?php 
/* SVN FILE: $Id$ */
/* BcforumPosts schema generated on: 2012-07-27 16:07:10 : 1343398750*/
class BcforumPostsSchema extends CakeSchema {
	var $name = 'BcforumPosts';

	var $file = 'bcforum_posts.php';

	var $connection = 'plugin';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $bcforum_posts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 8, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'contents' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'password' => array('type' => 'string', 'null' => true, 'default' => '0000'),
		'reply' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 8),
		'count' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'accept' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 8),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>