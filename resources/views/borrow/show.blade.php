@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('borrow.index') }}" class="btn btn-success btn-sm btn-round"><i
                    class="material-icons">arrow_back</i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Input Inventary for Borrow</h4>
                </div>
                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('detail_borrow.store') }}">
                        @csrf

                        <input type="hidden" name="borrow_id" id="borrow_id" value="{{ $borrow->id }}">
                        <div class="form-group">
                            <label class="label-floating" for="inventary_id">Inventary</label>

                            <select name="inventary_id" id="inventary_id" class="form-control">
                                <option disabled selected>--choose inventary--</option>
                                @foreach($inventaries as $row)
                                <option style="color: #000;" value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('inventary_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('inventary_id') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="bmd-label-floating" for="mount">Mount</label>
                            <input type="number" name="mount" id="mount" class="form-control">

                            @if ($errors->has('mount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mount') }}</strong>
                            </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success btn-round btn-block" @if($borrow->borrow_status ==
                            "Approved" || $borrow->borrow_status == "Uncomplete")
                            disabled
                            @endif>Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Inventaries List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Condition</th>
                                    <th>Borrowed By</th>
                                    <th>Mount</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($invenList as $row)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->condition }}</td>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->mount }}</td>
                                    @if((Auth::check() && Auth::user()->level_id == 1) || (Auth::check() &&
                                    Auth::user()->level_id == 2))
                                    <td>
                                        <button type="submit" class="btn btn-info btn-block btn-sm" data-toggle="modal"
                                            data-target="#exampleModal{{ $row->borrow_id }}" @if($borrow->borrow_status == "Booking")
                                                disabled
                                            @endif><i
                                                class="material-icons">settings_backup_restore</i></button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $row->borrow_id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel{{ $row->borrow_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel{{ $row->borrow_id }}">Return</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('detail_borrow.return', $row->id) }}"
                                                            method="post">
                                                            @csrf

                                                            <input type="hidden" name="borrow_id" id="borrow_id"
                                                                value="{{ $row->borrow_id }}">
                                                            
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Return Mount</label>
                                                                <input type="number" name="mount" id="mount" class="form-control text-primary">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Broken Mount</label>
                                                                <input type="number" name="broken_mount" id="broken_mount" class="form-control text-primary">

                                                                <p class="text-warning">If there is no broken thing, just empty the field above.</p>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    <td>
                                        <form action="{{ route('detail_borrow.destroy', $row->id) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}

                                            <input type="hidden" name="borrow_id" id="borrow_id"
                                                value="{{ $row->borrow_id }}">
                                            <button type="submit" class="btn btn-danger btn-block btn-sm"
                                                onclick="return confirm('Apakah yakin ingin menghapus data ?')" @if($borrow->borrow_status == "Approved")
                                                disabled
                                            @endif><i
                                                    class="material-icons">delete</i></button>
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
