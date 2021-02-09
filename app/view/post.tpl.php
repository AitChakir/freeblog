<div class="row">
	<div class="col-md-6 offset-md-3">
		<article style=" margin-top: 20px; text-align: center">
			<div>
			<h3><?=htmlentities($post->title)?></h3>
			<p><?=htmlentities($post->message)?> <br>
			<small>
				Created by <?=htmlentities($post->email)?> | at
				<?=htmlentities($post->datecreated)?>  
			</small></p>
			<form style="display: inline-block;" action="/post/<?= $post->id?>/update" method="GET">
				<div  class="form-group">
					<input type="submit" class="btn btn-success btn-sm" value="UPDATE">
				</div>
			</form>
			<form style="display: inline-block;" action="/post/<?= $post->id?>/delete" method="post">
				<div  class="form-group">
					<input type="submit" onclick="return confirm('DELETE USER?')" class="btn btn-danger btn-sm" value="DELETE">
				</div>
			</form>
			</div>
		</article>
	</div>
</div><br>

	<div>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<form action="/post/<?= $post->id ?>/comment" method="POST">
					<div class="form-group">
						<textarea class="form-control" placeholder="Please comment this post" name="message" id="message"></textarea>
					</div>

					<div class="form-group text-md-center" style="margin-top: 10px ">
						<input type="submit" align="right" class="btn btn-info btn-sm" value="Send comment">
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<h6><b>Comments:</b></h6>
				<div style="background-color: #E5E7E9; padding: 10px; border-radius: 10px; font-size: 13px;">
					
						<?php 
							if (!empty($comments)):
								foreach ($comments as $comment):?>
									<span class="commentstyle">
										. <?=$comment['text']?><br>
										<hr>
									</span>
								<?php endforeach ?>
				</div>
				<div>
					<?php else: ?>
						<span><b>THERE IS NO COMMENT FOR THIS POST</b></span>
					<?php endif ?>
				</div>	
			</div>
		</div>
		
	</div>

