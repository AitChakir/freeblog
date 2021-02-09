<div class="row">
	<div class="col-md-6 offset-md-3">
		<h2 align="center">NEW POST</h2>
		<form action="/post/save" method="POST">
			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" type="email" name="email" id="email" required="">
			</div>
			<div class="form-group">
				<label for="title">Title</label>
				<input class="form-control" type="title" name="title" id="title" required="">
			</div>
			<div class="form-group">
				<label for="message">Message</label>
				<textarea class="form-control" rows="6" name="message" id="message"></textarea>

			<div class="form-group " style="margin-top: 10px ">
				<input style="width: 543px"  type="submit" class="btn btn-info btn-sm btn-width" value="NEW POST">
				
			</div>
		</form>
	</div>
</div>