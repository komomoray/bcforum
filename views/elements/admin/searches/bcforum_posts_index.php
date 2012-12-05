<?php
/**
 * [ADMIN] 掲示板プラグイン
 *
 */
?>
<?php echo $bcForm->create('BcforumPost', array('controller' => 'bcforum_posts', 'action' => 'search', 'type' => 'get')); ?>
<p>
	<span>
		<?php echo $bcForm->label('Content.type', '全体検索') ?>
		<?php echo $bcForm->input('BcforumPost.search', array('value' => $keywords)) ?>
	</span>	
</p>
<div class="button">
	<?php echo $bcForm->submit('検索', array('class' => 'button', 'div' => false)) ?>
</div>
<?php echo $bcForm->end() ?>
<p><?php if (!empty($strs)): ?>
	<?php foreach ($strs as $str): ?>
		<?php echo $str.'&nbsp;' ?>
	<?php endforeach ?>
	&nbsp;での検索結果を表示
<?php endif ?>
</p>
