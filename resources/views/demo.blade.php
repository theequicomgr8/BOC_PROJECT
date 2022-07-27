<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="col-xl-6">
	<form method="post" action="/demo" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label>Image Upload </label>
			<input type="file" name="pic" class="form-control">
		</div>
		<input type="submit" class="btn btn-info btn-sm">
	</form>
</div>
</body>
</html>