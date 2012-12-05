<?php
/*
* bcforum テンプレート
**********************/
$bcBaser->css('/bcforum/css/bcforum.style') ?>
<div id="edit">
	<h2>フォーラム掲示板</h2>

<?php if ($bcForm->value('BcforumPost.reply') != 0): ?>
<h3><?php echo $bcForm->value('BcforumPost.title') ?></h3>
<?php else: ?>
<h3>トピック編集</h3>
<?php endif ?>
<div class="attention">※は必須項目です。</div>
<?php echo $bcForm->create(array('action' => 'edit', $id)); ?>
<?php echo $bcForm->hidden('BcforumPost.id') ?>
<?php echo $bcForm->hidden('BcforumPost.reply') ?>
<?php echo $bcForm->hidden('BcforumPost.title') ?>
<table class="row-table-01">
<?php if ($bcForm->value('BcforumPost.reply') == 0): ?>
	<tr>
		<th>タイトル<span class="attention">※</span></th>
		<td>
			<?php echo $bcForm->text('BcforumPost.title', array('style' => 'width:98%')) ?>
			<?php echo $bcForm->error('BcforumPost.title') ?>
		</td>
	</tr>
<?php endif ?>
	<tr>
		<th>投稿者<span class="attention">※</span></th>
		<td>
			<?php echo $bcForm->text('BcforumPost.name', array('style' => 'width:200px')) ?><span class="attention">野球部での通り名,○○回生,卒業年度など可</span>
			<?php echo $bcForm->error('BcforumPost.name') ?>
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
		<th>パスワード<span class="attention">※</span></th>
		<td>
			<?php echo $bcForm->password('BcforumPost.new_password') ?>
			<?php echo $bcForm->error('BcforumPost.new_password') ?>
		</td>
	</tr>
</table>

<div class="utility clearfix">
	<?php echo $bcForm->submit('保存', array('class' => 'button')) ?>
<?php if ($bcForm->value('BcforumPost.reply') != 0): ?>
	<?php echo $bcForm->submit('削除', array('class' => 'button', 'name' => 'delete')) ?>
<?php endif ?>
</div>

<?php echo $bcForm->end() ?>
</div>