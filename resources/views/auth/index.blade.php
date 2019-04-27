@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
			<a href="{{ route('home') }}" class="btn btn-success btn-sm btn-round"><i class="material-icons">arrow_back</i> Back to dashboard</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-primary">
					<a href="{{ route('user.create') }}" class="btn btn-success btn-round btn-sm pull-right">Add User</a>
					<h4 class="card-title mt-2">Users List</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<td>No.</td>
									<td>Name</td>
									<td>Email</td>
									<td>Level</td>
									<td colspan="3">Action</td>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								@foreach($users as $row)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $row->name }}</td>
									<td>{{ $row->email }}</td>
									<td>{{ $row->getLevel->level_name }}</td>
									<td>
										<button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#exampleModalCenter{{ $row->id }}">Change Password</button>

										<div class="modal fade" id="exampleModalCenter{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLongTitle">Reset and change user password.</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="{{ route('user.change', $row) }}" method="post">
															@csrf
															{{ method_field('PATCH') }}

															<div class="form-group">
																<label class="bmd-label-floating">Email</label>
																<input type="email" name="email" id="email" class="form-control text-primary" value="{{ $row->email }}" readonly>
																@if ($errors->has('email'))
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $errors->first('email') }}</strong>
																</span>
																@endif
															</div>
															<div class="form-group">
																<label class="bmd-label-floating">New Password</label>
																<input type="password" name="password" id="password" class="form-control text-primary">
																@if ($errors->has('password'))
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $errors->first('password') }}</strong>
																</span>
																@endif
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary">Save changes</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</td>
									<td>
										<form action="{{ route('user.edit', $row) }}" method="get">
											@csrf
											<button type="submit" class="btn btn-warning btn-sm btn-block">Edit</button>
										</form>
									</td>
									<td>
										<form action="{{ route('user.destroy', $row) }}" method="post">
											@csrf
											{{ method_field('DELETE') }}
											<button type="submit" class="btn btn-danger btn-sm btn-block"
											onclick="return confirm('Apakah yakin ingin menghapus data ?')">Delete</button>
										</form>
									</td>
								</tr>
								<?php $i++; ?>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection