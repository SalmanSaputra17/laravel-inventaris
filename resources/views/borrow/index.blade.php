@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('home') }}" class="btn btn-success btn-sm btn-round"><i
                    class="material-icons">arrow_back</i> Back to dashboard</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <a href="{{ route('borrow.create') }}" class="btn btn-success btn-round btn-sm pull-right">Borrow
                        Something</a>
                    <h4 class="card-title mt-2">Borrows List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Borrow Date</td>
                                    <td>Return Date</td>
                                    <td>Borrow At</td>
                                    <td>Confirmed By</td>
                                    <td>Borrow Status</td>
                                    <td colspan="4" class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($borrows as $row)
                                <tr @if($row->borrow_status == "Uncomplete") 
                                    style="background-color: #444;"
                                @endif>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row->borrow_date }}</td>
                                    <td>{{ $row->return_date }}</td>
                                    <td>{{ $row->created_at }} | {{ $row->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if($row->user_id != NULL)
                                        {{ $row->user->name }}
                                        @endif
                                    </td>
                                    <td>{{ $row->borrow_status }}</td>
                                    <td>
                                        <form action="{{ route('borrow.edit', $row) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-block btn-sm"
                                                @if($row->borrow_status == "Approved" || $row->borrow_status ==
                                                "Denied")
                                                disabled
                                                @endif><i class="material-icons">edit</i></button>
                                        </form>
                                    </td>
                                    <!-- <td>
                                        <form action="{{ route('borrow.destroy', $row) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-block btn-sm"
                                                onclick="return confirm('Apakah yakin ingin menghapus data ?')"
                                                @if($row->borrow_status == "Approved" || $row->borrow_status ==
                                                "Denied")
                                                disabled
                                                @endif><i class="material-icons">delete</i></button>
                                        </form>
                                    </td> -->
                                    @if((Auth::check() && Auth::user()->level_id == 1) || (Auth::check() &&
                                    Auth::user()->level_id == 2))
                                    <td>
                                        <form action="{{ route('borrow.show', $row) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-block btn-sm"
                                                @if($row->borrow_status == "Denied")
                                                disabled
                                                @endif><i class="material-icons">list</i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('borrow.confirm', $row) }}" method="post">
                                            @csrf
                                            {{ method_field('PATCH') }}

                                            <input type="hidden" name="confirm" id="confirm" value="1">
                                            <button type="submit" class="btn btn-success btn-block btn-sm"
                                                @if($row->borrow_status == "Approved" || $row->borrow_status ==
                                                "Denied")
                                                disabled
                                                @endif><i class="material-icons">check</i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('borrow.confirm', $row) }}" method="post">
                                            @csrf
                                            {{ method_field('PATCH') }}

                                            <input type="hidden" name="confirm" id="confirm" value="0">
                                            <button type="submit" class="btn btn-danger btn-block btn-sm"
                                                @if($row->borrow_status == "Approved" || $row->borrow_status ==
                                                "Denied")
                                                disabled
                                                @endif><i class="material-icons">close</i></button>
                                        </form>
                                    </td>
                                    @endif
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
