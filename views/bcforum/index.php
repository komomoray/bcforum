<?php
/*
* bcforum テンプレート
**********************/
$bcBaser->css('/bcforum/css/bcforum.style') ?>
<div id="index">
	<h2>フォーラム掲示板</h2>
	<h3>フォーラムトピックス一覧</h3>
<div id="newTopicBtn">
<span><?php $bcBaser->link('新規トピック作成', array('plugin' => 'bcforum', 'controller' => 'bcforum', 'action' => 'add')) ?></span>
</div>

<table class="row-table-01">
	<tr>
		<th>タイトル</th>
		<th width="120px">投稿者</th>
		<th width="120px">最終投稿日</th>
	</tr>
	<?php $i = 0; ?>
	<?php foreach ($datas as $data): ?>
	<tr>
		<td><?php $bcBaser->link($data['BcforumPost']['title'], array('plugin' => 'bcforum', 'controller' => 'bcforum', 'action' => 'view', $data['BcforumPost']['id'])) ?>(<?php echo $data['BcforumPost']['count']; ?>)</td>
		<td><?php echo $data['BcforumPost']['name'] ?></td>
		<td class="last-post-day"><span class="postDate"><?php echo str_replace('-', '/', substr($data['BcforumPost']['modified'], 0, 16)) ?></span></td>
	</tr>
		<?php $i++; ?>
	<?php endforeach ?>

</table>
<?php
  echo $paginator->prev('前へ');
  echo $paginator->numbers();
  echo $paginator->next('次へ');
?>
</div>