@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('home') }}" class="btn btn-success btn-sm btn-round"><i class="material-icons">arrow_back</i> Back to dashboard</a>
        </div>
    </div>
    <div class="row mt-3 mb-0">
        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">subject</i>
                  </div>
                  <p class="card-category">Inventary Types</p>
                  <h3 class="card-title">{{ $types }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">list</i>
                    <a href="{{ route('type.index') }}" class="warning-link">See inventary type...</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">meeting_room</i>
                  </div>
                  <p class="card-category">Inventary Rooms</p>
                  <h3 class="card-title">{{ $rooms }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-info">list</i>
                    <a href="{{ route('room.index') }}" class="info-link">See inventary room...</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">add_box</i>
                  </div>
                  <p class="card-category">Inventary Supplies</p>
                  <h3 class="card-title">{{ $supplies }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-success">list</i>
                    <a href="{{ route('supply.index') }}" class="success-link">See inventary supply...</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <a href="{{ route('inventary.create') }}" class="btn btn-success btn-round btn-sm pull-right">Add Inventary</a>
                    <h4 class="card-title mt-2">Inventaries List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Name</td>
                                    <td>Condition</td>
                                    <td>Mount</td>
                                    <td>Type</td>
                                    <td>Room</td>
                                    <td>Operator</td>
                                    <td>Register Date</td>
                                    <td>Information</td>
                                    <td colspan="2">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($inventaries as $row)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        @if($row->condition == "Well")
                                            <div class="btn btn-success btn-round btn-sm">{{ $row->condition }}</div>
                                        @else
                                            <div class="btn btn-danger btn-round btn-sm">{{ $row->condition }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $row->mount }}</td>
                                    <td>{{ $row->type->type_name }}</td>
                                    <td>{{ $row->room->room_name }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->register_date }}</td>
                                    <td>{{ $row->explanation }}</td>
                                    <td>
                                        <form action="{{ route('inventary.edit', $row) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm btn-block"><i class="material-icons">edit</i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('inventary.destroy', $row) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm btn-block"
                                                onclick="return confirm('Apakah yakin ingin menghapus data ?')"><i class="material-icons">delete</i></button>
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
