<?php $bcBaser->element('pagination') ?>
<h2>スレッド一覧</h2>
<table cellpadding="0" cellspacing="0" class="list-table" id="ListTable">
	<tr>
		<th width="80px"></th>
		<th width="200px">タイトル</th>
		<th>内容</th>
		<th width="60px">返信数</th>
		<th width="120px">名前</th>
		<th width="130px">投稿日時</th>
	</tr>
	<?php if($datas) : ?>
		<?php foreach ($datas as $data): ?>
		<tr id="<?php echo $data['BcforumPost']['id'] ?>">
			<!--<td>
				<?php echo $form->create(null, array('type'=>'post', 'default'=>false)); ?>
				<?php echo $form->hidden($data['BcforumPost']['id'], array('label'=>'', 'class'=>'topicId')); ?>
				<?php echo $form->submit('Submit', array('class'=>'submitButton')); ?>
				<?php echo $form->end(); ?>
			</td>-->
			<td>
			<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_manage_on.png', array('width' => 24, 'height' => 24, 'alt' => '管理', 'class' => 'btn')), array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'view', $data['BcforumPost']['id']), array('title' => '管理')) ?>
			<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_edit.png', array('width' => 24, 'height' => 24, 'alt' => '編集', 'class' => 'btn')), array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'edit', $data['BcforumPost']['id']), array('title' => '編集')) ?>
			<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_delete.png', array('width' => 24, 'height' => 24, 'alt' => '削除', 'class' => 'btn')), array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'delete', $data['BcforumPost']['id']), array('title' => '削除', 'class' => 'btn-delete')) ?></td>
			<td><?php $bcBaser->link($data['BcforumPost']['title'], array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'view', $data['BcforumPost']['id'])) ?></td>
			<td><?php echo $data['BcforumPost']['contents'] ?></td>
			<td><?php echo $data['BcforumPost']['count'] ?></td>
			<td><?php echo $data['BcforumPost']['name'] ?></td>
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

<script language="JavaScript">
$(function() {
    $(".submitButton").click(function() {
      $.post('/bcform_posts/ajax_view', {
        id: $(this).prev().val()
      }, function(rs) {
        $(this).parent().parent().append(rs);
      });
    });
});
</script>