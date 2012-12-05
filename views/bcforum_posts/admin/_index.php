<div style="text-align:center;">
<?php echo $bcForm->create('BcforumPost', array('controller' => 'bcforum_posts', 'action' => 'index', 'type' => 'get')); ?>
<?php echo $bcForm->input('BcforumPost.search', array('value' => $keywords)) ?>
</div>
<div class="submit">
	<?php echo $bcForm->submit('検索', array('class' => 'button')) ?>
</div>

<?php echo $bcForm->end() ?>

<?php
  echo $paginator->options(array('url' =>  am($this->passedArgs, array('?' => array('search' => $keywords)))));
  echo $paginator->prev('前へ');
  echo $paginator->numbers();
  echo $paginator->next('次へ');
?>
<?php if (!empty($strs)): ?>
検索キーワード：
<?php foreach ($strs as $str): ?>
	<?php echo $str ?>
<?php endforeach ?>
<?php endif ?>


<table class="list-table">
	<tr>
		<th width="60px"></th>
		<th width="60px"></th>
		<th width="200px">タイトル</th>
		<th>内容</th>
		<th width="120px">名前</th>
	</tr>
	<?php foreach ($datas as $data): ?>
	<tr>
		<td><?php $bcBaser->link('編集', array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'edit', $data['BcforumPost']['id'])) ?></td>
		<td><?php $bcBaser->link('削除', array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'delete', $data['BcforumPost']['id'])) ?></td>
		<td><?php echo $data['BcforumPost']['title'] ?></td>
		<td><?php echo $data['BcforumPost']['contents'] ?></td>
		<td><?php echo $data['BcforumPost']['name'] ?></td>
	</tr>
	<?php endforeach ?>

</table>
<?php
  echo $paginator->options(array('url' =>  am($this->passedArgs, array('?' => array('search' => $keywords)))));
  echo $paginator->prev('前へ');
  echo $paginator->numbers();
  echo $paginator->next('次へ');
?>