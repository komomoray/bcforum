<?php
/*
* bcforum テンプレート
**********************/
$bcBaser->css('/bcforum/css/bcforum.style') ?>

<div id="add">
	<h2>フォーラム掲示板</h2>
	<h3>新規トピック作成</h3>
	<div class="attention">※は必須項目です。</div>
<?php echo $bcForm->create(array('action' => 'add')); ?>
<table class="row-table-01">
	<tr>
		<th>タイトル<span class="attention">※</span></th>
		<td>
			<?php echo $bcForm->text('BcforumPost.title', array('style' => 'width:98%')) ?>
			<?php echo $bcForm->error('BcforumPost.title') ?>
		</td>
	</tr>
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
		<th>Email</th>
		<td>
			<?php echo $bcForm->text('BcforumPost.email', array('style' => 'width:300px')) ?><span class="attention">表示はされません</span>
			<?php echo $bcForm->error('BcforumPost.email') ?>
		</td>
	</tr>
	<tr>
		<th>パスワード</th>
		<td>
			<?php echo $bcForm->password('BcforumPost.password') ?><span class="attention">編集するときに必要になります(4文字以上の英数)</span>
			<?php echo $bcForm->error('BcforumPost.password') ?>
		</td>
	</tr>
</table>

<div class="utility clearfix">
	<?php echo $bcForm->submit('保存', array('class' => 'button')) ?>
</div>

<?php echo $bcForm->end() ?>
</div>