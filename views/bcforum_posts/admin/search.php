<?php $bcBaser->element('pagination') ?>

<table cellpadding="0" cellspacing="0" class="list-table" id="ListTable">
	<tr>
		<th width="60px"></th>
		<th width="200px">タイトル</th>
		<th>内容</th>
		<th width="120px">名前</th>
		<th width="150px">メールアドレス</th>
		<th width="120px">投稿日時</th>
	</tr>
	<?php if($datas) : ?>
		<?php foreach ($datas as $data): ?>
			<?php if ($data['BcforumPost']['reply'] == 0): ?>
				<?php $id = $data['BcforumPost']['id'] ?>
			<?php else: ?>
				<?php $id = $data['BcforumPost']['reply'] ?>
			<?php endif ?>
		<tr>
			<td><?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_edit.png', array('width' => 24, 'height' => 24, 'alt' => '編集', 'class' => 'btn')), array('plugin' => 'bcforum', 'plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'edit', $data['BcforumPost']['id']), array('title' => '編集')) ?>
			<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_delete.png', array('width' => 24, 'height' => 24, 'alt' => '削除', 'class' => 'btn')), array('plugin' => 'bcforum', 'plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'delete', $data['BcforumPost']['id']), array('title' => '削除', 'class' => 'btn-delete')) ?></td>
			<td><?php $bcBaser->link($data['BcforumPost']['title'], array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'view', $id)) ?></td>
			<td><?php echo $data['BcforumPost']['contents'] ?></td>
			<td><?php echo $data['BcforumPost']['name'] ?></td>
			<td><?php echo $data['BcforumPost']['email'] ?></td>
			<td><?php echo str_replace('-', '/', substr($data['BcforumPost']['created'], 0, 16)) ?></td>
		</tr>
		<?php endforeach ?>
	<?php else : ?>
		<tr>
			<td colspan="5"><p class="no-data">データがありません。</p></td>
		</tr>
	<?php endif ?>
</table>

<?php $bcBaser->element('list_num') ?>
