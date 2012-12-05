<?php echo $bcForm->create('BcforumPost'); ?>
<?php echo $bcForm->hidden('BcforumPost.id') ?>
<table class="form-table">
	<tr>
		<th>ID</th>
		<td><?php echo $bcForm->value('BcforumPost.id') ?></td>
	</tr>
	<tr>
		<th>タイトル</th>
		<td><?php echo $bcForm->text('BcforumPost.title', array('style' => 'width:600px')) ?></td>
	</tr>
	<tr>
		<th>内容</th>
		<td><?php echo $bcForm->textarea('BcforumPost.contents', array('cols' => '70', 'rows' => '6', 'style' => 'width:98%')) ?></td>
	</tr>
	<tr>
		<th>名前</th>
		<td><?php echo $bcForm->text('BcforumPost.name', array('style' => 'width:300px')) ?></td>
	</tr>
	<tr>
		<th>メールアドレス</th>
		<td><?php echo $bcForm->text('BcforumPost.email', array('style' => 'width:300px')) ?></td>
	</tr>
</table>

<div class="submit">
	<?php echo $bcForm->submit('保存', array('class' => 'button')) ?>
</div>

<?php echo $bcForm->end() ?>