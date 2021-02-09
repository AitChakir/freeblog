
<div class="row" align="center">
	<div class="col-md-6 offset-md-3"><?php foreach ($posts as $post): ?>
		<article>
			<p>
			<h3><a href="/post/<?=$post->id?>"><?=htmlentities($post->title) ?></a></h3>
			<?=htmlentities($post->message)?>
			</p>
		</article>	
		<?php endforeach ?>
	</div>
</div>

