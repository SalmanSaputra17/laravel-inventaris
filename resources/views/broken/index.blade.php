@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('home') }}" class="btn btn-success btn-sm btn-round"><i class="material-icons">arrow_back</i> Back to dahsboard</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title mt-2">Brokens List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Name | Code</td>
                                    <td>Register Date</td>
                                    <td>Mount</td>
                                    <td colspan="2">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($brokens as $row)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row->name }} | {{ $row->inventary_code }}</td>
                                    <td>{{ $row->register_date }}</td>
                                    <td>{{ $row->mount }}</td>
                                    <td>
                                        <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{ $row->id }}"><i class="material-icons">done_all</i></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Change to well condition.</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('broken.update', $row->id) }}" method="post">
                                                            @csrf
                                                            {{ method_field('PATCH') }}
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Mount</label>
                                                                <input type="number" name="mount" id="mount" class="form-control text-primary">
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
                                </tr>
                                <?php $i++;?>
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