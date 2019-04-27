@if(session('success'))
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-12">
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			</div>
		</div>
	</div>
@endif

@if(session('warning'))
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-12">
				<div class="alert alert-warning">
					{{ session('warning') }}
				</div>
			</div>
		</div>
	</div>
@endif

@if(session('info'))
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-12">
				<div class="alert alert-info">
					{{ session('info') }}
				</div>
			</div>
		</div>
	</div>
@endif

@if(session('danger'))
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-12">
				<div class="alert alert-danger">
					{{ session('danger') }}
				</div>
			</div>
		</div>
	</div>
@endif
