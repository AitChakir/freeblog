<div class="row">
	<div class="col-md-6 offset-md-3">
		<h1 align="center">UPDATE ACCOUNT</h1>
		<form action="/post/<?=$post->id?>/store" method="POST">
			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" value="<?=$post->email?>" type="email" name="email" id="email" required="">
			</div>
			<div class="form-group">
				<label for="title">Title</label>
				<input class="form-control" value="<?=$post->title?>" type="title" name="title" id="title" required="">
			</div>
			<div class="form-group">
				<label for="message">Message</label>
				<textarea class="form-control" rows="6" name="message" id="message"><?=$post->message?></textarea>

			<div class="form-group text-md-center" style="margin-top: 10px ">
				<input type="submit" class="btn btn-info" value="UPDATE">
				
			</div>
		</form>
	</div>
</div>