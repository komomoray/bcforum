<?php
/*
* bcforum テンプレート
**********************/
$bcBaser->css('/bcforum/css/bcforum.style') ?>

<table cellpadding="0" cellspacing="0" class="list-table">
	<tr>
		<th width="60px"></th>
		<th width="150px">タイトル</th>
		<th>本文</th>
		<th width="120px">名前</th>
		<th width="120px">メールアドレス</th>
		<th width="120px">投稿日</th>
	</tr>
	<tr>
			<td><?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_edit.png', array('width' => 24, 'height' => 24, 'alt' => '編集', 'class' => 'btn')), array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'edit', $data['BcforumPost']['id']), array('title' => '編集')) ?>
			<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_delete.png', array('width' => 24, 'height' => 24, 'alt' => '削除', 'class' => 'btn')), array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'delete', $data['BcforumPost']['id']), array('title' => '削除', 'class' => 'btn-delete')) ?></td>
		<td><?php echo $data['BcforumPost']['title'] ?></td>
		<td><?php $bcBaser->link($data['BcforumPost']['contents'], array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'edit', $data['BcforumPost']['id'])) ?></td>
		<td><?php echo $data['BcforumPost']['name'] ?></td>
		<td><?php echo $data['BcforumPost']['email'] ?></td>
		<td><?php echo str_replace('-', '/', substr($data['BcforumPost']['created'], 0, 16)) ?></td>
	</tr>
</table>

<br /><br />
<h2>返信一覧</h2>
<table cellpadding="0" cellspacing="0" class="list-table">
	<tr>
		<th width="60px"></th>
		<th>投稿内容</th>
		<th width="120px">名前</th>
		<th width="120px">メールアドレス</th>
		<th width="120px">投稿日</th>
	</tr>
	<?php foreach ($replies as $reply): ?>
	<tr>
			<td><?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_edit.png', array('width' => 24, 'height' => 24, 'alt' => '編集', 'class' => 'btn')), array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'edit', $reply['BcforumPost']['id']), array('title' => '編集')) ?>
			<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_delete.png', array('width' => 24, 'height' => 24, 'alt' => '削除', 'class' => 'btn')), array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'delete', $reply['BcforumPost']['id']), array('title' => '削除', 'class' => 'btn-delete')) ?></td>
		<td><?php $bcBaser->link($reply['BcforumPost']['contents'], array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'edit', $reply['BcforumPost']['id'])) ?></td>
		<td><?php echo $reply['BcforumPost']['name'] ?></td>
		<td><?php echo $reply['BcforumPost']['email'] ?></td>
		<td><?php echo str_replace('-', '/', substr($reply['BcforumPost']['created'], 0, 16)) ?></td>
	</tr>
	<?php endforeach ?>

</table>
<br /><br />
