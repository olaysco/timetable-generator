@if (session('status'))
	<div class="alert alert-success fade-in">
		<a class="close" data-dismiss="alert" aria-label="close">&times;</a>

		<p>{{ session('status') }}</p>
	</div>
@endif

@if ($errors->any())
	<div class="alert alert-danger fade-in">
		<a class="close" data-dismiss="alert" aria-label="close">&times;</a>

		<p>Whoops! There were some errors. Please fix them:</p>

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
