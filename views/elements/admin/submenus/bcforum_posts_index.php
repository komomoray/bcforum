<tr>
	<th>フォーラム掲示板メニュー</th>
	<td>
		<ul class="cleafix">
			<li>
				<?php $bcBaser->link('スレッド一覧を表示する', array('plugin' => 'bcforum', 'controller' => 'bcforum_posts', 'action' => 'index')) ?>
			</li>
			<li>
				<?php $bcBaser->link('公開ページ確認', '/' . 'bcforum' . '/index') ?>
			</li>
		</ul>
	</td>
</tr>