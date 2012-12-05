<?php
/*
* bcforum テンプレート
**********************/
$bcBaser->css('/bcforum/css/bcforum.style') ?>
<div id="view">
	<h2>フォーラム掲示板</h2>
<h3><?php echo $data['BcforumPost']['title'] ?></h3>
<div id="editBtn">
	<span><?php $bcBaser->link('編集', array('plugin' => 'bcforum', 'controller' => 'bcforum', 'action' => 'edit', $data['BcforumPost']['id'])) ?></span>
</div>
<div class="parentTopic">
	<p class="topicMetaData"><span class="midashi">投稿者</span><span class="postName"><?php echo $data['BcforumPost']['name'] ?></span><span class="midashi">投稿日</span><span class="postDate"><?php echo str_replace('-', '/', substr($data['BcforumPost']['created'], 0, 16)) ?></span></p>
	<p class="topoicBody"><?php echo $data['BcforumPost']['contents'] ?></p>
</div>


<h4>返信一覧</h4>
<table class="replyTable">
	<?php foreach ($replies as $reply): ?>
	<tr>
		<td><span class="postName"><?php echo $reply['BcforumPost']['name'] ?></span><span class="postBody"><?php echo $reply['BcforumPost']['contents'] ?></span><span class="postDate"><?php echo str_replace('-', '/', substr($reply['BcforumPost']['created'], 0, 16)) ?></span></td>
		<td width="42px"><div class="editReply"><?php $bcBaser->link('編集', array('plugin' => 'bcforum', 'controller' => 'bcforum', 'action' => 'edit', $reply['BcforumPost']['id'])) ?></div></td>
	</tr>
	<?php endforeach ?>

</table>


<h4>返信フォーム</h4>
<div class="attention">※は必須項目です。</div>
<?php echo $bcForm->create(array('url' => '/bcforum/view/'.$id)); ?>
<?php echo $bcForm->hidden('BcforumPost.title', array('value' => 'Re: '.$data['BcforumPost']['title'])) ?>
<?php echo $bcForm->hidden('BcforumPost.reply', array('value' => $data['BcforumPost']['id'])) ?>
<table class="row-table-01">

	<tr>
		<th>投稿者<span class="attention">※</span></th>
		<td>
			<?php echo $bcForm->text('BcforumPost.name', array('style' => 'width:200px')) ?><span class="attention">野球部での通り名,○○回生,卒業年度など可</span>
			<?php echo $bcForm->error('BcforumPost.name') ?>
		</td>
	</tr>
	<tr>
		<th>Email</th>
		<td>
			<?php echo $bcForm->text('BcforumPost.email', array('style' => 'width:300px')) ?><span class="attention">表示はされません</span>
			<?php echo $bcForm->error('BcforumPost.email') ?>
		</td>
	</tr>
	<tr>
		<th>コメント<span class="attention">※</span></th>
		<td>
			<?php echo $bcForm->textarea('BcforumPost.contents', array('cols' => '50', 'rows' => '6', 'style' => 'width:98%')) ?>
			<?php echo $bcForm->error('BcforumPost.contents') ?>
		</td>
	</tr>
	<tr>
		<th>パスワード</th>
		<td>
			<?php echo $bcForm->password('BcforumPost.password') ?><span class="attention">編集、削除するときに必要になります(4文字以上の英数)</span>
			<?php echo $bcForm->error('BcforumPost.password') ?>
		</td>
	</tr>
</table>

<div class="utility clearfix">
	<?php echo $bcForm->submit('送信', array('class' => 'button')) ?>
</div>
<?php echo $bcForm->end() ?>
</div>